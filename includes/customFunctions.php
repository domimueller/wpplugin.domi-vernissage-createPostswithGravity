<?php


function custom_create_Post_attachment($gravityFormsEntry, $post_to_update, $entry) {
    
    

    /* #### Transform the image urls ### */
    // delete "[" and "]" that are no needed         
    $image_urls = substr($gravityFormsEntry, 2);
    $image_urls = substr($image_urls, 0, -2);

    // replace unnecassary characters
    $image_urls = str_replace('\\', '', $image_urls);
    $image_urls = str_replace('"', '', $image_urls);
    
    // build array
    $image_urls = explode(',', $image_urls); 


    foreach ($image_urls as $image_url):
        $image = pathinfo($image_url);//Extracting information into array. 
        $image_name = $image['basename'];
        $unique_file_name = wp_unique_filename($image['basename'], $image_name);
        $filename = basename($unique_file_name);   
        
        $image_data = file_get_contents($image_url);
        $uploadsPath = GFFormsModel::get_file_upload_path( $entry['form_id'], $filename)['path'];

        // alternative way o determine path but without time information
        //$uploadsPath2 = GFFormsModel::get_upload_path( $entry['form_id']) . '/' . $filename;

        file_put_contents($uploadsPath, $image_data);   
        $wp_filetype = wp_check_filetype( $image_url, null );

        $attachment = [
            'post_mime_type' => $wp_filetype['type'],
            'post_parent'    => $post_to_update->ID,
            'post_title'     => sanitize_file_name(preg_replace( '/\.[^.]+$/', '', $filename )),
            'post_content'   => '',
            'post_status'    => 'inherit',
        ];

        $attachment_id = wp_insert_attachment( $attachment, $uploadsPath);
        require_once ABSPATH . 'wp-admin/includes/image.php';


        $attach_data = wp_generate_attachment_metadata($attachment_id, $uploadsPath);
        
        // Assign metadata to attachment
        wp_update_attachment_metadata($attachment_id, $attach_data);
    endforeach;        




}
?>  

