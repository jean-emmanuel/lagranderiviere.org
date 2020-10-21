<?php
/**
 * Gestion du formulaire de d'édition de adherent
 *
 * @plugin     Amap
 * @copyright  2020
 * @author     Jean-Emmanuel Doucet
 * @licence    GNU/GPL v3
 * @package    SPIP\Amap\Formulaires
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/actions');
include_spip('inc/editer');


/**
 * Identifier le formulaire en faisant abstraction des paramètres qui ne représentent pas l'objet edité
 *
 * @param int|string $id_adherent
 *     Identifiant du adherent. 'new' pour un nouveau adherent.
 * @param int $id_amap
 *     Identifiant de l'objet parent (si connu)
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un adherent source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du adherent, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return string
 *     Hash du formulaire
 */
function formulaires_editer_adherent_identifier_dist($id_adherent = 'new', $id_amap = 0, $retour = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	return serialize(array(intval($id_adherent)));
}

/**
 * Chargement du formulaire d'édition de adherent
 *
 * Déclarer les champs postés et y intégrer les valeurs par défaut
 *
 * @uses formulaires_editer_objet_charger()
 *
 * @param int|string $id_adherent
 *     Identifiant du adherent. 'new' pour un nouveau adherent.
 * @param int $id_amap
 *     Identifiant de l'objet parent (si connu)
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un adherent source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du adherent, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Environnement du formulaire
 */
function formulaires_editer_adherent_charger_dist($id_adherent = 'new', $id_amap = 0, $retour = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$valeurs = formulaires_editer_objet_charger('adherent', $id_adherent, $id_amap, $lier_trad, $retour, $config_fonc, $row, $hidden);
	if (!$valeurs['id_amap']) {
		$valeurs['id_amap'] = $id_amap;
	}
	return $valeurs;
}

/**
 * Vérifications du formulaire d'édition de adherent
 *
 * Vérifier les champs postés et signaler d'éventuelles erreurs
 *
 * @uses formulaires_editer_objet_verifier()
 *
 * @param int|string $id_adherent
 *     Identifiant du adherent. 'new' pour un nouveau adherent.
 * @param int $id_amap
 *     Identifiant de l'objet parent (si connu)
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un adherent source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du adherent, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Tableau des erreurs
 */
function formulaires_editer_adherent_verifier_dist($id_adherent = 'new', $id_amap = 0, $retour = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$erreurs = array();

	$verifier = charger_fonction('verifier', 'inc');

	foreach (array('date_debut') AS $champ) {
		$normaliser = null;
		if ($erreur = $verifier(_request($champ), 'date', array('normaliser'=>'datetime'), $normaliser)) {
			$erreurs[$champ] = $erreur;
		// si une valeur de normalisation a ete transmis, la prendre.
		} elseif (!is_null($normaliser)) {
			set_request($champ, $normaliser);
		// si pas de normalisation ET pas de date soumise, il ne faut pas tenter d'enregistrer ''
		} else {
			set_request($champ, null);
		}
	}

	$erreurs += formulaires_editer_objet_verifier('adherent', $id_adherent, array('nom', 'adresse', 'mail', 'telephone', 'taille_panier', 'mode_paiement', 'date_debut', 'contrat_ok', 'paiement_ok', 'id_amap'));

	return $erreurs;
}

/**
 * Traitement du formulaire d'édition de adherent
 *
 * Traiter les champs postés
 *
 * @uses formulaires_editer_objet_traiter()
 *
 * @param int|string $id_adherent
 *     Identifiant du adherent. 'new' pour un nouveau adherent.
 * @param int $id_amap
 *     Identifiant de l'objet parent (si connu)
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un adherent source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du adherent, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Retours des traitements
 */
function formulaires_editer_adherent_traiter_dist($id_adherent = 'new', $id_amap = 0, $retour = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$retours = formulaires_editer_objet_traiter('adherent', $id_adherent, $id_amap, $lier_trad, $retour, $config_fonc, $row, $hidden);
	return $retours;
}
