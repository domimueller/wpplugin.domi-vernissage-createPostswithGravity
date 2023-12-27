<?php

    /* Configuration*/


function custom_set_gform_Configuration($entry){
  
    $configuration_data = array();

    // From ID of Inserat bearbeiten
    $configuration_data['INSERAT_BEARBEITEN_FORM_ID'] = 4;

    /* GLOBAL VARIABLES */
    $configuration_data['INSERATE_ERFASSEN_FORM_ID'] = 1;
    $configuration_data['INSERATE_AFTER_BEARBEITEN_STATUS'] = 'DRAFT';

    //Map gfrom entry IDs to Variable Names
    $configuration_data['insertion_moreImages'] = $entry[71];

return $configuration_data;
}
?>  

