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
			'nom_referent'       => 'text NOT NULL DEFAULT ""',
			'telephone_referent' => 'text NOT NULL DEFAULT ""',
			'mail_referent'      => 'text NOT NULL DEFAULT ""',
			'livraison'          => 'text NOT NULL DEFAULT ""',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_amap',
		),
		'titre' => 'nom AS titre, "" AS lang',
		 #'date' => '',
		'champs_editables'  => array('nom', 'adresse', 'nom_referent', 'telephone_referent', 'mail_referent', 'livraison'),
		'champs_versionnes' => array('nom', 'adresse', 'nom_referent', 'telephone_referent', 'mail_referent', 'livraison'),
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
			'taille_panier'      => 'text NOT NULL DEFAULT ""',
			'demi_panier'        => 'tinytext NOT NULL DEFAULT ""',
			'notes'              => 'text NOT NULL DEFAULT ""',
			'date_debut'         => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_adherent',
			'KEY id_amap'        => 'id_amap',
		),
		'titre' => 'nom AS titre, "" AS lang',
		 #'date' => '',
		'champs_editables'  => array('nom', 'adresse', 'mail', 'telephone', 'taille_panier', 'demi_panier', 'notes', 'date_debut', 'id_amap'),
		'champs_versionnes' => array('nom', 'adresse', 'mail', 'telephone', 'taille_panier', 'demi_panier', 'notes', 'date_debut', 'id_amap'),
		'rechercher_champs' => array(),
		'tables_jointures'  => array(),


	);

	return $tables;
}
