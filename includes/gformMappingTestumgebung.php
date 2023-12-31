<?php

    /* Configuration*/


function custom_set_gform_Mapping_Testumgebung(){
  
    $configuration_data = array();

    // From ID of Inserat bearbeiten
    $configuration_data['INSERAT_BEARBEITEN_FORM_ID'] = 4;

    /* GLOBAL VARIABLES */
    $configuration_data['INSERATE_ERFASSEN_FORM_ID'] = 1;
    $configuration_data['INSERATE_AFTER_BEARBEITEN_STATUS'] = 'DRAFT';

    $configuration_data['insertion_titelbild_gformID'] = 72;
    $configuration_data['insertion_moreImages_gformID'] = 71;
    $configuration_data['insertion_updateDateTime'] = 'date_updated';

return $configuration_data;
}
?>  

