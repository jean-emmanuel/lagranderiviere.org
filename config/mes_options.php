<?php

    define('_NO_CACHE', -1); 

    $GLOBALS['spip_pipeline']['affichage_final'] .= "|retirer_saisies";
    function retirer_saisies($flux){

        return preg_replace('/<!--!inserer_saisie_editer-->/', '', $flux);

    }
?>
