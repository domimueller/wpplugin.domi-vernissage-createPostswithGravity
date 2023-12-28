<?php



add_action( 'gform_after_submission_1', 'custom_create_post_content', 10, 2 );
function custom_create_post_content( $entry, $form ) {

    // get data from gravity forms    
    $configuration_data = custom_set_gform_Configuration($entry);
    $new_post = get_post($entry['post_id']);

    /* #### Post Thumbnail ### */        
    $entry_more_images =  $configuration_data['insertion_moreImages'];
    $entry_titelbild =  $configuration_data['insertion_titelbild'];
    
    // the fourth parameter is to define wheter the image should be set as titelbild
    custom_create_Post_attachment($entry_titelbild, $new_post, $entry, true);
    custom_create_Post_attachment($entry_more_images, $new_post, $entry, false);
    
}
?>  
