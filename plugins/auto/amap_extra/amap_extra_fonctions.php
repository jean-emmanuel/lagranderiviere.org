<?php
/**
 * Fonctions utiles au plugin Amap Extra
 *
 * @plugin     Amap Extra
 * @copyright  2020
 * @author     Jean-Emmanuel Doucet
 * @licence    GNU/GPL v3
 * @package    SPIP\Amap Extra\Fonctions
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

require_once 'ovh.php';

function action_supprimer_adherent($arg=null) {
    if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$arg = intval($arg);

	// cas suppression
	if ($arg) {

        $ovh = connect_ovh();
		$id_amap = sql_getfetsel(
            'id_amap',
            'spip_adherents',
            'id_adherent=' . sql_quote($arg)
        );
        $mailinglist = sql_getfetsel(
            'nom_mailinglist',
            'spip_amaps',
            'id_amap=' . sql_quote($id_amap)
        );
        $ancien_mail = sql_getfetsel(
            'mail',
            'spip_adherents',
            'id_adherent=' . sql_quote($arg)
        );
        $error = 0;
		if ($ancien_mail != lire_config('amap_extra/ovh_fakemail') and $mailinglist != '') {
			try {
				$ovh->delete('/email/domain/' . lire_config('amap_extra/ovh_domain') . '/mailingList/' . $mailinglist . '/subscriber/' . $ancien_mail);
			} catch (GuzzleHttp\Exception\ClientException $e) {
				spip_log('OVH: suppression d\'adherent échouée', 'ovh' . _LOG_ERREUR);
				spip_log($e->getResponse()->getBody()->getContents(), 'ovh' . _LOG_ERREUR);
				$error = 1;
			}
		}

        // if (!$error) {
            sql_delete('spip_adherents',  'id_adherent=' . sql_quote($arg));
        // }

    }
	else {
		spip_log("action_supprimer_adherent_dist $arg pas compris", 'ovh' . _LOG_ERREUR);
	}


}

function amap_extra_valid_mail($str) {
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}


function autoriser_ecrire($faire, $type, $id, $qui, $opt) {
	// espace privé -> réservé à l'admin
 	return $qui['statut'] == '0minirezo';

}
