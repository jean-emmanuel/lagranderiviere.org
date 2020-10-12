<?php

    $GLOBALS['flag_preserver'] = true;

    $exporter_csv = charger_fonction('exporter_csv', 'inc/', true);

    function export_csv($titre, $resource, $delim = ', ', $entetes = null, $envoyer = true) {
        return inc_exporter_csv_dist($titre, $resource, $delim, $entetes, $envoyer);
    }



?>
