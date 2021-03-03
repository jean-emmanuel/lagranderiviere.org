<?php

    $GLOBALS['flag_preserver'] = true;

    $exporter_csv = charger_fonction('exporter_csv', 'inc/', true);
    // function export_csv($titre, $resource, $delim = ', ', $array_entetes = null, $envoyer = true) {
    //     // return 'nope';
    //     return $exporter_csv($titre, $resource, $delim, $array_entetes, $envoyer);
    // }


    include_spip('inc/charsets');
    include_spip('inc/filtres');
    include_spip('inc/texte');

    require_once find_in_path('lib/Spout/Autoloader/autoload.php');
    use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
    use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
    use Box\Spout\Common\Entity\Style\Color;

    function export_csv($titre, $resource, $delim = ',', $entetes = null, $envoyer = true) {
    	$filename = preg_replace(',[^-_\w]+,', '_', translitteration(textebrut(typo($titre))));

    	if ($delim == ',') {
            $writer = WriterEntityFactory::createODSWriter();
    		$extension = 'ods';
    	} else {
            $writer = WriterEntityFactory::createXLSXWriter();
    		$extension = 'xlsx';
    	}

        $writer->openToBrowser("$filename.$extension");

    	if ($entetes and is_array($entetes) and count($entetes)) {
    		$writer->addRow(WriterEntityFactory::createRowFromArray($entetes));
    	}

    	while ($row = is_array($resource) ? array_shift($resource) : sql_fetch($resource)) {
    		$writer->addRow(WriterEntityFactory::createRowFromArray($row));
    	}

        $writer->close();
        die;

    }

    // function export_csv($titre, $resource, $delim = ', ', $entetes = null, $envoyer = true) {
    //     // return inc_exporter_csv_dist($titre, $resource, $delim, $entetes, $envoyer);
    //     $filename = preg_replace(',[^-_\w]+,', '_', translitteration(textebrut(typo($titre))));
    //
    //     if ($delim == 'TAB') {
    //         $delim = "\t";
    //     }
    //     if (!in_array($delim, array(',', ';', "\t"))) {
    //         $delim = ',';
    //     }
    //
    //     $charset = $GLOBALS['meta']['charset'];
    //     $importer_charset = null;
    //     if ($delim == ',') {
    //         $extension = 'csv';
    //     } else {
    //         $extension = 'xls';
    //         # Excel n'accepte pas l'utf-8 ni les entites html... on transcode tout ce qu'on peut
    //         $importer_charset = $charset = 'iso-8859-1';
    //     }
    //     $filename = "$filename.$extension";
    //
    //     if ($entetes and is_array($entetes) and count($entetes)) {
    //         $output = exporter_csv_ligne($entetes, $delim, $importer_charset);
    //     }
    //
    //     // on passe par un fichier temporaire qui permet de ne pas saturer la memoire
    //     // avec les gros exports
    //     $fichier = sous_repertoire(_DIR_CACHE, 'export') . $filename;
    //     $fp = fopen($fichier, 'w');
    //     $length = fwrite($fp, $output);
    //
    //     while ($row = is_array($resource) ? array_shift($resource) : sql_fetch($resource)) {
    //         $output = exporter_csv_ligne($row, $delim, $importer_charset);
    //         $length += fwrite($fp, $output);
    //     }
    //     fclose($fp);
    //
    //     if ($envoyer) {
    //         if ($delim == ',') {
    //             header('Content-type: application/csv');
    //             header("Content-Transfer-Encoding: UTF-8");
    //         } else {
    //             header('Content-type: application/vnd.ms-excel');
    //             // header("Content-Transfer-Encoding: iso-8859-1");
    //         }
    //         // header("Content-Type: text/comma-separated-values; charset=$charset");
    //
    //         header("Content-Disposition: attachment; filename=$filename");
    //         //non supporte
    //         //Header("Content-Type: text/plain; charset=$charset");
    //         // header("Content-Length: $length");
    //         // spip fix -> true file size
    //         // header('Content-Length: ' . filesize($fichier));
    //         ob_clean();
    //         flush();
    //         readfile($fichier);
    //     }
    //
    //     return $fichier;
    // }


    function nosaisie($flux) {
        return preg_replace('/<!--!inserer_saisie_editer-->/', '', $flux);
    }

    function filtre_minify_css($css) {
        $css = preg_replace('/\n/', '', $css);
        $css = preg_replace('/\s+/', ' ', $css);
        // $css = preg_replace('/\/\*.*\*/', '', $css);
        $css = preg_replace('/;?\}/', "}", $css);
        $css = preg_replace('/\s*\{\s*/', "{", $css);
        $css = preg_replace('/\s*,\s*/', ",", $css);
        $css = preg_replace('/\s*;\s*/', ";", $css);
        $css = preg_replace('/:\s+/', ":", $css);
        return $css;
    }

    function panier_moyen_equivalent($taille) {
        if ($taille == 'petit') {
            return 0.78;
        } else if ($taille == 'grand') {
            return 1.41;
        } else {
            return 1.0;
        }
    }


    function duree($date_debut,$date_fin) {
      $d_debut = mktime(
                  substr($date_debut,11,2),
                  substr($date_debut,14,2),
                  substr($date_debut,17,2),
                  substr($date_debut,5,2),
                  substr($date_debut,8,2),
                  substr($date_debut,0,4));

      $d_fin = mktime(
                  substr($date_fin,11,2),
                  substr($date_fin,14,2),
                  substr($date_fin,17,2),
                  substr($date_fin,5,2),
                  substr($date_fin,8,2),
                  substr($date_fin,0,4));

      $diff_seconds  = $d_fin - $d_debut;

      if ($diff_seconds<0) return "";

      $diff_years    = floor($diff_seconds/31536000);
      $diff_seconds -= $diff_years   * 31536000;
      $diff_weeks    = floor($diff_seconds/604800);
      $diff_seconds -= $diff_weeks   * 604800;
      $diff_days     = floor($diff_seconds/86400);


      return $diff_days + $diff_weeks * 7 + $diff_years * 365;

    }

?>
