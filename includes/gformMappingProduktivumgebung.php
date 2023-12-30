<?php

    /* Configuration*/


function custom_set_gform_Mapping_Testumgebung($entry){
  
    $configuration_data = array();

    // From ID of Inserat bearbeiten
    $configuration_data['INSERAT_BEARBEITEN_FORM_ID'] = 4;

    /* GLOBAL VARIABLES */
    $configuration_data['INSERATE_ERFASSEN_FORM_ID'] = 1;

    //Map gfrom entry IDs to Variable Names
    $configuration_data['insertion_moreImages'] = $entry[71];
    $configuration_data['insertion_titelbild'] = $entry[72];

return $configuration_data;
}
?>  

