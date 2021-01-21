<?php
/**
 * Utilisations de pipelines par Amap Extra
 *
 * @plugin     Amap Extra
 * @copyright  2020
 * @author     Jean-Emmanuel Doucet
 * @licence    GNU/GPL v3
 * @package    SPIP\Amap Extra\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



require_once 'ovh.php';


function amap_extra_formulaire_verifier($flux){

	if ($flux['args']['form'] == 'editer_adherent') {

		if (!amap_extra_valid_mail(_request('mail'))) {
			# adresse mail valide ?
			$flux['data']['mail'] = 'Cette adresse email n\'est pas valide.';
		} else if (intval(_request('id_adherent')) == 0) {
			#Un adherent existe deja avec cette adresse ?
			if (sql_countsel('spip_adherents', 'mail=' . sql_quote(_request('mail')) . ' AND id_amap=' . sql_quote(_request('id_amap'))) > 0) {
				$flux['data']['mail'] = _T('erreur_email_deja_existant');
			}
		} else {
			#Un adherent existe deja avec cette adresse ? et n'est pas l'adherent courant.
			if ((sql_countsel(
				'spip_adherents',
				'mail=' . sql_quote(_request('mail'))  . 'AND id_amap=' . sql_quote(_request('id_amap'))
				) > 0) and (_request('id_adherent') != ($id_adherant_ancien = sql_getfetsel(
					'id_adherent',
					'spip_adherents',
					'mail=' . sql_quote(_request('mail')) . 'AND id_amap=' . sql_quote(_request('id_amap'))
			)))) {
				$flux['data']['mail'] = _T('erreur_email_deja_existant');
			}
		}

		if (!$flux['data']['mail'] && (intval(_request('id_adherent')) == 0
			|| _request('mail') != sql_getfetsel(
				'mail',
				'spip_adherents',
				'id_adherent=' . sql_quote(_request('id_adherent'))
			)
			|| _request('id_amap') != sql_getfetsel(
				'id_amap',
				'spip_adherents',
				'id_adherent=' . sql_quote(_request('id_adherent'))
			)
		)) {
			// si mail ok mais API ovh non joignable -> retourner une erreur
			$mailinglist = sql_getfetsel(
				'nom_mailinglist',
				'spip_amaps',
				'id_amap=' . sql_quote(_request('id_amap'))
			);
			$ovh = connect_ovh();
			try {
				$ovh->get('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/mailingList/' . $mailinglist);
			} catch ( GuzzleHttp\Exception\ClientException $e ) {
				spip_log('OVH: erreur serveur', 'ovh' . _LOG_ERREUR);
				if ($e->getResponse()->getStatusCode() == 404) {
					$flux['data']['mail'] = 'Le serveur de gestion des mail n\'est pas configuré correctement.';
				} else {
					$flux['data']['mail'] = 'Le serveur de gestion des mail ne répond pas.';
				}
			}
		}


	} else if ($flux['args']['form'] == 'editer_amap') {

		if (!amap_extra_valid_mail(_request('mail_referent'))) {
			# adresse mail valide ?
			$flux['data']['mail_referent'] = 'Cette adresse email n\'est pas valide.';

		} else if (intval(_request('id_amap')) == 0
			|| _request('mail_referent') != sql_getfetsel(
			'mail_referent',
			'spip_amaps',
			'id_amap=' . sql_quote(_request('id_amap')))
			|| _request('nom_mailinglist') != sql_getfetsel(
				'nom_mailinglist',
				'spip_amaps',
				'id_amap=' . sql_quote(_request('id_amap')))
		) {
			// si mail ok mais API ovh non joignable -> retourner une erreur
			$mailinglist = sql_getfetsel(
				'nom_mailinglist',
				'spip_amaps',
				'id_amap=' . sql_quote(_request('id_amap'))
			);
			$ovh = connect_ovh();
			try {
				$redirection = $ovh->get('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/redirection', array(
					'from'=> 'referent-' . _request('nom_mailinglist') . '@' . lire_config('amap_extra/ovh_domain')
				));

				if (sizeof($redirection) == 0) {
					$flux['data']['nom_mailinglist'] = 'La redirection mail referent-' . _request('nom_mailinglist') . '@' . lire_config('amap_extra/ovh_domain') . " n'est pas configurée";
					return $flux;
				}

				$ovh->get('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/mailingList/' . _request('nom_mailinglist'));
			} catch (GuzzleHttp\Exception\ClientException $e) {
				spip_log('OVH: erreur serveur', 'ovh' . _LOG_ERREUR);
				spip_log($e->getResponse()->getBody()->getContents(), 'ovh' . _LOG_ERREUR);
				if ($e->getResponse()->getStatusCode() == 404) {
					$flux['data']['nom_mailinglist'] = 'La mailing-list ' .  _request('nom_mailinglist') . " n'est pas configurée";
				} else {
					$flux['data']['nom_mailinglist'] = 'Le serveur de gestion des mail ne répond pas.';
				}
			}
		}

	}
	return $flux;

}

function amap_extra_pre_edition($flux){

	if ($flux['args']['type'] == 'adherent' && $flux['args']['action'] == 'modifier') {


		$mailinglist = sql_getfetsel(
			'nom_mailinglist',
			'spip_amaps',
			'id_amap=' . sql_quote($flux['data']['id_amap'])
		);
		$id = sql_getfetsel(
			'id_adherent',
			'spip_adherents',
			'id_adherent=' . sql_quote($flux['args']['id_objet'])
		);
		$ovh = connect_ovh();

		if ($id != '' && (
			$flux['data']['mail'] != sql_getfetsel(
				'mail',
				'spip_adherents',
				'id_adherent=' . sql_quote($flux['args']['id_objet'])
			)
			|| $flux['data']['id_amap'] != sql_getfetsel(
				'id_amap',
				'spip_adherents',
				'id_adherent=' . sql_quote($flux['args']['id_objet'])
			)
		)) {
			// adherent existant -> remplacer mail dans la liste
			$ancien_amap = sql_getfetsel(
				'id_amap',
				'spip_adherents',
				'id_adherent=' . sql_quote($flux['args']['id_objet'])
			);
			$ancien_mail = sql_getfetsel(
				'mail',
				'spip_adherents',
				'id_adherent=' . sql_quote($flux['args']['id_objet'])
			);

			if ($ancien_mail != $flux['data']['mail'] || $ancien_amap != $flux['data']['id_amap']) {
				$ancien_mailinglist = sql_getfetsel(
					'nom_mailinglist',
					'spip_amaps',
					'id_amap=' . sql_quote($ancien_amap)
				);
				try {
					$ovh->delete('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/mailingList/' . $ancien_mailinglist . '/subscriber/' . $ancien_mail);
				} catch (GuzzleHttp\Exception\ClientException $e) {
					spip_log('OVH: suppression de mail echouée : ' . $ancien_mail, 'ovh' . _LOG_ERREUR);
					spip_log($e->getResponse()->getBody()->getContents(), 'ovh' . _LOG_ERREUR);
				}
				try {
					$ovh->post('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/mailingList/' . $mailinglist . '/subscriber/', array(
						'email'=>$flux['data']['mail']
					));
				} catch (GuzzleHttp\Exception\ClientException $e) {
					spip_log('OVH: ajout de mail echoué : ' . $flux['data']['mail'], 'ovh' . _LOG_ERREUR);
					spip_log($e->getResponse()->getBody()->getContents(), 'ovh' . _LOG_ERREUR);
					return false;
				}
			}

		} else if ($id == '') {
			// nouvel adherant -> ajouter mail dans la liste
			try {
				$ovh->post('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/mailingList/' . $mailinglist . '/subscriber/', array(
					'email'=>$flux['data']['mail']
				));
			} catch (GuzzleHttp\Exception\ClientException $e) {
				spip_log('OVH: ajout de nouveau mail echoué : ' . $flux['data']['mail'], 'ovh' . _LOG_ERREUR);
				spip_log($e->getResponse()->getBody()->getContents(), 'ovh' . _LOG_ERREUR);
				return false;
			}
		}

	} else if ($flux['args']['type'] == 'amap' && $flux['args']['action'] == 'modifier') {

		$ancien_mail = sql_getfetsel(
			'mail_referent',
			'spip_amaps',
			'id_amap=' . sql_quote($flux['args']['id_objet'])
		);

		if ($ancien_mail == $flux['data']['mail_referent']) return $flux;

		$ovh = connect_ovh();
		try {
			$redirection = $ovh->get('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/redirection', array(
				'from'=> 'referent-' . $flux['data']['nom_mailinglist'] . '@' . lire_config('amap_extra/ovh_domain')
			));
			array_push($redirection, 'no_redir');
			$ovh->post('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/redirection/' . $redirection[0] . '/changeRedirection/', array(
				'to'=>$flux['data']['mail_referent']
			));
		} catch (GuzzleHttp\Exception\ClientException $e) {
			spip_log('OVH: modification de redirection mail referent echouée : ' . $flux['data']['nom_mailinglist'] . ' -> ' . $flux['data']['mail_referent'], 'ovh' . _LOG_ERREUR);
			spip_log($e->getResponse()->getBody()->getContents(), 'ovh' . _LOG_ERREUR);
			return false;
		}

	}

	return $flux;

}
