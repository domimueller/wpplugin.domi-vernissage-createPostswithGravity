<?php


$configuration_data = custom_set_gform_Configuration();
add_action( 'gform_after_submission_' . $configuration_data['INSERATE_ERFASSEN_FORM_ID'], 'custom_create_post_content', 10, 2 );
function custom_create_post_content( $entry, $form ) {

    // get data from gravity forms    
    $configuration_data = custom_set_gform_Configuration();
    $new_post = get_post($entry['post_id']);

    /* #### Post Thumbnail ### */        
    if (isset($entry[$configuration_data['insertion_titelbild_gformID']]) && !empty($entry[$configuration_data['insertion_titelbild_gformID']])):
        $entry_titelbild =  $entry[$configuration_data['insertion_titelbild_gformID']];
    endif;    

    if (isset($entry[$configuration_data['insertion_moreImages_gformID']]) && !empty($entry[$configuration_data['insertion_moreImages_gformID']])):
        $entry_more_images =  $entry[$configuration_data['insertion_moreImages_gformID']];
    endif;    

    

    // the fourth parameter is to define wheter the image should be set as titelbild
    custom_create_Post_attachment($entry_titelbild, $new_post, $entry, true);
    custom_create_Post_attachment($entry_more_images, $new_post, $entry, false);
    
}
?>  
