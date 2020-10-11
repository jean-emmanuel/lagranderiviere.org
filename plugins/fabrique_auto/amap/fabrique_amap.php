<?php

/**
 *  Fichier généré par la Fabrique de plugin v6
 *   le 2020-10-11 15:01:51
 *
 *  Ce fichier de sauvegarde peut servir à recréer
 *  votre plugin avec le plugin «Fabrique» qui a servi à le créer.
 *
 *  Bien évidemment, les modifications apportées ultérieurement
 *  par vos soins dans le code de ce plugin généré
 *  NE SERONT PAS connues du plugin «Fabrique» et ne pourront pas
 *  être recréées par lui !
 *
 *  La «Fabrique» ne pourra que régénerer le code de base du plugin
 *  avec les informations dont il dispose.
 *
**/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$data = array (
  'fabrique' => 
  array (
    'version' => 6,
  ),
  'paquet' => 
  array (
    'prefixe' => 'amap',
    'nom' => 'Amap',
    'slogan' => 'Gestion des adhérents pour les AMAP',
    'description' => '',
    'logo' => 
    array (
      0 => '',
    ),
    'version' => '1.0.0',
    'auteur' => 'Jean-Emmanuel Doucet',
    'auteur_lien' => '',
    'licence' => 'GNU/GPL v3',
    'categorie' => 'divers',
    'etat' => 'dev',
    'compatibilite' => '[3.2.8;3.2.*]',
    'documentation' => '',
    'administrations' => 'on',
    'schema' => '1.0.0',
    'formulaire_config' => '',
    'formulaire_config_titre' => '',
    'fichiers' => 
    array (
      0 => 'autorisations',
      1 => 'fonctions',
      2 => 'options',
      3 => 'pipelines',
    ),
    'inserer' => 
    array (
      'paquet' => '',
      'administrations' => 
      array (
        'maj' => '',
        'desinstallation' => '',
        'fin' => '',
      ),
      'base' => 
      array (
        'tables' => 
        array (
          'fin' => '',
        ),
      ),
    ),
    'scripts' => 
    array (
      'pre_copie' => '',
      'post_creation' => '',
    ),
    'exemples' => '',
  ),
  'objets' => 
  array (
    0 => 
    array (
      'nom' => 'Amaps',
      'nom_singulier' => 'Amap',
      'genre' => 'feminin',
      'logo' => 
      array (
        0 => '',
        32 => '',
        24 => '',
        16 => '',
        12 => '',
      ),
      'logo_variantes' => 'on',
      'table' => 'spip_amaps',
      'cle_primaire' => 'id_amap',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'amap',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'Nom',
          'champ' => 'nom',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'Nom de l\'AMAP',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'Adresse',
          'champ' => 'adresse',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'textarea',
          'explication' => 'Adresse de livraison des paniers',
          'saisie_options' => 'rows=2',
        ),
        2 => 
        array (
          'nom' => 'Nom referent',
          'champ' => 'nom_referent',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'Nom référent de l\'AMAP',
          'saisie_options' => '',
        ),
        3 => 
        array (
          'nom' => 'Telephone référent',
          'champ' => 'telephone_referent',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'Numéro de téléphone du référent',
          'saisie_options' => '',
        ),
        4 => 
        array (
          'nom' => 'Mail référent',
          'champ' => 'mail_referent',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'Courriel du référent',
          'saisie_options' => '',
        ),
        5 => 
        array (
          'nom' => 'Jour/Heure Livraison',
          'champ' => 'livraison',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
      ),
      'champ_titre' => 'nom',
      'champ_date' => '',
      'statut' => '',
      'chaines' => 
      array (
        'titre_objets' => 'Amaps',
        'titre_objet' => 'Amap',
        'info_aucun_objet' => 'Aucune amap',
        'info_1_objet' => 'Une amap',
        'info_nb_objets' => '@nb@ amaps',
        'icone_creer_objet' => 'Créer une amap',
        'icone_modifier_objet' => 'Modifier cette amap',
        'titre_logo_objet' => 'Logo de cette amap',
        'titre_langue_objet' => 'Langue de cette amap',
        'texte_definir_comme_traduction_objet' => 'Cette amap est une traduction de la amap numéro :',
        'titre_\\objets_lies_objet' => 'Liés à cette amap',
        'titre_objets_rubrique' => 'Amap de la rubrique',
        'info_objets_auteur' => 'Les amap de cet auteur',
        'retirer_lien_objet' => 'Retirer cette amap',
        'retirer_tous_liens_objets' => 'Retirer toutes les amap',
        'ajouter_lien_objet' => 'Ajouter cette amap',
        'texte_ajouter_objet' => 'Ajouter une amap',
        'texte_creer_associer_objet' => 'Créer et associer une amap',
        'texte_changer_statut_objet' => 'Cette amap est :',
        'supprimer_objet' => 'Supprimer cette amap',
        'confirmer_supprimer_objet' => 'Confirmez-vous la suppression de cette amap ?',
      ),
      'liaison_directe' => '',
      'table_liens' => '',
      'afficher_liens' => '',
      'roles' => '',
      'auteurs_liens' => 'on',
      'vue_auteurs_liens' => '',
      'fichiers' => 
      array (
        'echafaudages' => 
        array (
          0 => 'prive/squelettes/contenu/objets.html',
          1 => 'prive/objets/infos/objet.html',
          2 => 'prive/squelettes/contenu/objet.html',
        ),
      ),
      'saisies' => 
      array (
        0 => 'objets',
      ),
      'autorisations' => 
      array (
        'objet_creer' => 'administrateur',
        'objet_voir' => '',
        'objet_modifier' => '',
        'objet_supprimer' => '',
        'associerobjet' => '',
      ),
      'boutons' => 
      array (
        0 => 'menu_edition',
        1 => 'outils_rapides',
      ),
    ),
    1 => 
    array (
      'nom' => 'Adhérents',
      'nom_singulier' => 'Adhérent',
      'genre' => 'masculin',
      'logo' => 
      array (
        0 => '',
        32 => '',
        24 => '',
        16 => '',
        12 => '',
      ),
      'logo_variantes' => 'on',
      'table' => 'spip_adherents',
      'cle_primaire' => 'id_adherent',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'adherent',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'Nom / Prénom',
          'champ' => 'nom',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'Nom et prénom de l\'adhérent',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'Adresse',
          'champ' => 'adresse',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'textarea',
          'explication' => 'Adresse postale de l\'adhérent',
          'saisie_options' => 'rows=2',
        ),
        2 => 
        array (
          'nom' => 'Courriel',
          'champ' => 'mail',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'Adresse mail de l\'adhérent',
          'saisie_options' => 'type=email',
        ),
        3 => 
        array (
          'nom' => 'Téléphone',
          'champ' => 'telephone',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'Numéro de téléphone de l\'adhérent',
          'saisie_options' => 'type=telephone',
        ),
        4 => 
        array (
          'nom' => 'Taille du panier',
          'champ' => 'taille_panier',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'selection',
          'explication' => '',
          'saisie_options' => 'datas=[(#ARRAY{petit,petit,moyen,moyen,grand,grand})]
',
        ),
        5 => 
        array (
          'nom' => 'Demi panier',
          'champ' => 'demi_panier',
          'sql' => 'tinytext NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '',
          'saisie' => 'oui_non',
          'explication' => 'Indiquer le co-titulaire dans les notes le cas échéant',
          'saisie_options' => 'datas=[(#ARRAY{0,oui,1,non})]
',
        ),
        6 => 
        array (
          'nom' => 'Notes',
          'champ' => 'notes',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '',
          'saisie' => 'textarea',
          'explication' => '',
          'saisie_options' => 'rows=4',
        ),
        7 => 
        array (
          'nom' => 'Date',
          'champ' => 'date_debut',
          'sql' => 'datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'date',
          'explication' => '',
          'saisie_options' => '',
        ),
      ),
      'champ_titre' => 'nom',
      'champ_date' => '',
      'statut' => '',
      'chaines' => 
      array (
        'titre_objets' => 'Adhérents',
        'titre_objet' => 'Adhérent',
        'info_aucun_objet' => '0 adhérent',
        'info_1_objet' => '1 adhérent',
        'info_nb_objets' => '@nb@ adhérents',
        'icone_creer_objet' => 'Créer un adhérent',
        'icone_modifier_objet' => 'Modifier ce adhérent',
        'titre_logo_objet' => 'Logo de ce adhérent',
        'titre_langue_objet' => 'Langue de ce adhérent',
        'texte_definir_comme_traduction_objet' => 'Ce adhérent est une traduction du adhérent numéro :',
        'titre_\\objets_lies_objet' => 'Liés à ce adhérent',
        'titre_objets_rubrique' => 'Adhérents de la rubrique',
        'info_objets_auteur' => 'Les adhérents de cet auteur',
        'retirer_lien_objet' => 'Retirer ce adhérent',
        'retirer_tous_liens_objets' => 'Retirer tous les adhérents',
        'ajouter_lien_objet' => 'Ajouter ce adhérent',
        'texte_ajouter_objet' => 'Ajouter un adhérent',
        'texte_creer_associer_objet' => 'Créer et associer un adhérent',
        'texte_changer_statut_objet' => 'Ce adhérent est :',
        'supprimer_objet' => 'Supprimer cet adhérent',
        'confirmer_supprimer_objet' => 'Confirmez-vous la suppression de cet adhérent ?',
      ),
      'liaison_directe' => 'spip_amaps',
      'table_liens' => '',
      'afficher_liens' => '',
      'roles' => '',
      'auteurs_liens' => '',
      'vue_auteurs_liens' => '',
      'fichiers' => 
      array (
        'echafaudages' => 
        array (
          0 => 'prive/squelettes/contenu/objets.html',
          1 => 'prive/objets/infos/objet.html',
          2 => 'prive/squelettes/contenu/objet.html',
        ),
        'explicites' => 
        array (
          0 => 'action/supprimer_objet.php',
        ),
      ),
      'autorisations' => 
      array (
        'objet_creer' => '',
        'objet_voir' => '',
        'objet_modifier' => '',
        'objet_supprimer' => '',
        'associerobjet' => '',
      ),
      'boutons' => 
      array (
        0 => 'menu_edition',
        1 => 'outils_rapides',
      ),
    ),
  ),
  'images' => NULL,
);
