<?php
/**
 * Déclarations relatives à la base de données
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
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function amap_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['amaps'] = 'amaps';
	$interfaces['table_des_tables']['adherents'] = 'adherents';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function amap_declarer_tables_objets_sql($tables) {

	$tables['spip_amaps'] = array(
		'type' => 'amap',
		'principale' => 'oui',
		'field'=> array(
			'id_amap'            => 'bigint(21) NOT NULL',
			'nom'                => 'text NOT NULL DEFAULT ""',
			'adresse'            => 'text NOT NULL DEFAULT ""',
			'gps'                => 'text NOT NULL DEFAULT ""',
			'livraison'          => 'text NOT NULL DEFAULT ""',
			'nom_referent'       => 'text NOT NULL DEFAULT ""',
			'telephone_referent' => 'text NOT NULL DEFAULT ""',
			'mail_referent'      => 'text NOT NULL DEFAULT ""',
			'nom_mailinglist'    => 'text NOT NULL DEFAULT ""',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_amap',
		),
		'titre' => 'nom AS titre, "" AS lang',
		 #'date' => '',
		'champs_editables'  => array('nom', 'adresse', 'gps', 'livraison', 'nom_referent', 'telephone_referent', 'mail_referent', 'nom_mailinglist'),
		'champs_versionnes' => array('nom', 'adresse', 'gps', 'livraison', 'nom_referent', 'telephone_referent', 'mail_referent', 'nom_mailinglist'),
		'rechercher_champs' => array(),
		'tables_jointures'  => array(),


	);

	$tables['spip_adherents'] = array(
		'type' => 'adherent',
		'principale' => 'oui',
		'field'=> array(
			'id_adherent'        => 'bigint(21) NOT NULL',
			'id_amap'            => 'bigint(21) NOT NULL DEFAULT 0',
			'nom'                => 'text NOT NULL DEFAULT ""',
			'adresse'            => 'text NOT NULL DEFAULT ""',
			'mail'               => 'text NOT NULL DEFAULT ""',
			'telephone'          => 'text NOT NULL DEFAULT ""',
			'coadherent'         => 'int(11) NOT NULL DEFAULT 0',
			'taille_panier'      => 'text NOT NULL DEFAULT ""',
			'tarif_solidaire'    => 'tinytext NOT NULL DEFAULT ""',
			'mode_paiement'      => 'text NOT NULL DEFAULT ""',
			'date_debut'         => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'nb_cheques'         => 'int(11) NOT NULL DEFAULT 0',
			'montant_cheque_1'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_2'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_2'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_3'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_4'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_5'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_6'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_7'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_8'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_9'   => 'text NOT NULL DEFAULT ""',
			'montant_cheque_10'  => 'text NOT NULL DEFAULT ""',
			'montant_cheque_11'  => 'text NOT NULL DEFAULT ""',
			'montant_cheque_12'  => 'text NOT NULL DEFAULT ""',
			'montant_total'      => 'text NOT NULL DEFAULT ""',
			'contrat_ok'         => 'tinytext NOT NULL DEFAULT ""',
			'paiement_ok'        => 'tinytext NOT NULL DEFAULT ""',
			'notes'              => 'text NOT NULL DEFAULT ""',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_adherent',
			'KEY id_amap'        => 'id_amap',
		),
		'titre' => 'nom AS titre, "" AS lang',
		 #'date' => '',
		'champs_editables'  => array('nom', 'adresse', 'mail', 'telephone', 'coadherent', 'taille_panier', 'tarif_solidaire', 'mode_paiement', 'date_debut', 'nb_cheques', 'montant_cheque_1', 'montant_cheque_2', 'montant_cheque_2', 'montant_cheque_3', 'montant_cheque_4', 'montant_cheque_5', 'montant_cheque_6', 'montant_cheque_7', 'montant_cheque_8', 'montant_cheque_9', 'montant_cheque_10', 'montant_cheque_11', 'montant_cheque_12', 'montant_total', 'contrat_ok', 'paiement_ok', 'notes', 'id_amap'),
		'champs_versionnes' => array('nom', 'adresse', 'mail', 'telephone', 'coadherent', 'taille_panier', 'tarif_solidaire', 'mode_paiement', 'date_debut', 'nb_cheques', 'montant_cheque_1', 'montant_cheque_2', 'montant_cheque_2', 'montant_cheque_3', 'montant_cheque_4', 'montant_cheque_5', 'montant_cheque_6', 'montant_cheque_7', 'montant_cheque_8', 'montant_cheque_9', 'montant_cheque_10', 'montant_cheque_11', 'montant_cheque_12', 'montant_total', 'contrat_ok', 'paiement_ok', 'notes', 'id_amap'),
		'rechercher_champs' => array(),
		'tables_jointures'  => array(),


	);

	return $tables;
}
