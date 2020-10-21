<?php

    $GLOBALS['flag_preserver'] = true;

    $exporter_csv = charger_fonction('exporter_csv', 'inc/', true);

    function export_csv($titre, $resource, $delim = ', ', $entetes = null, $envoyer = true) {
        return inc_exporter_csv_dist($titre, $resource, $delim, $entetes, $envoyer);
    }


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


?>
