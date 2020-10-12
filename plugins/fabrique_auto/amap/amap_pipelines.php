<?php
/**
 * Utilisations de pipelines par Amap
 *
 * @plugin     Amap
 * @copyright  2020
 * @author     Jean-Emmanuel Doucet
 * @licence    GNU/GPL v3
 * @package    SPIP\Amap\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Ajouter les objets sur les vues des parents directs
 *
 * @pipeline affiche_enfants
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
**/
function amap_affiche_enfants($flux) {
	if ($e = trouver_objet_exec($flux['args']['exec']) and $e['edition'] == false) {
		$id_objet = $flux['args']['id_objet'];

		if ($e['type'] == 'amap') {
			$flux['data'] .= recuperer_fond(
				'prive/objets/liste/adherents',
				array(
					'titre' => _T('adherent:titre_adherents'),
					'id_amap' => $id_objet
				)
			);

			if (autoriser('creeradherentdans', 'amaps', $id_objet)) {
				include_spip('inc/presentation');
				$flux['data'] .= icone_verticale(
					_T('adherent:icone_creer_adherent'),
					generer_url_ecrire('adherent_edit', "id_amap=$id_objet"),
					'adherent-24.png',
					'new',
					'right'
				) . "<br class='nettoyeur' />";
			}
		}
	}
	return $flux;
}


/**
 * Ajout de contenu sur certaines pages,
 * notamment des formulaires de liaisons entre objets
 *
 * @pipeline affiche_milieu
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function amap_affiche_milieu($flux) {
	$texte = '';
	$e = trouver_objet_exec($flux['args']['exec']);

	// auteurs sur les amaps
	if (!$e['edition'] and in_array($e['type'], array('amap'))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'auteurs',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}



	if ($texte) {
		if ($p = strpos($flux['data'], '<!--affiche_milieu-->')) {
			$flux['data'] = substr_replace($flux['data'], $texte, $p, 0);
		} else {
			$flux['data'] .= $texte;
		}
	}

	return $flux;
}

/**
 * Afficher le nombre d'éléments dans les parents
 *
 * @pipeline boite_infos
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
**/
function amap_boite_infos($flux) {
	if (isset($flux['args']['type']) and isset($flux['args']['id']) and $id = intval($flux['args']['id'])) {
		$texte = '';
		if ($flux['args']['type'] == 'amap' and $nb = sql_countsel('spip_adherents', array('id_amap=' . $id))) {
			$texte .= '<div>' . singulier_ou_pluriel($nb, 'adherent:info_1_adherent', 'adherent:info_nb_adherents') . "</div>\n";
		}
		if ($texte and $p = strpos($flux['data'], '<!--nb_elements-->')) {
			$flux['data'] = substr_replace($flux['data'], $texte, $p, 0);
		}
	}
	return $flux;
}


/**
 * Compter les enfants d'un objet
 *
 * @pipeline objets_compte_enfants
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
**/
function amap_objet_compte_enfants($flux) {
	if ($flux['args']['objet'] == 'amap' and $id_amap = intval($flux['args']['id_objet'])) {
		$flux['data']['adherents'] = sql_countsel('spip_adherents', 'id_amap= ' . intval($id_amap));
	}

	return $flux;
}
