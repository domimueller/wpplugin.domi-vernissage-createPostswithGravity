<?php


function custom_create_Post_attachment($gravityFormsEntry, $post_to_update, $entry, $istitelbild) {
        

        // build array containing the images
        $image_urls = explode(',', $gravityFormsEntry); 
        


        foreach ($image_urls as $image_url):
            $image_url_formated = custom_format_get_url_from_gform_entry($image_url);
            
            $image = pathinfo($image_url_formated);//Extracting information into array. 
            $image_name = $image['basename'];
            $unique_file_name = wp_unique_filename($image['basename'], $image_name);
            $filename = basename($unique_file_name);   
            
            $image_data = file_get_contents($image_url_formated);
            

        
            // alternative way to determine upload path, but is not including the path for uploading in year/month uploads folder
            //$uploadsPath = GFFormsModel::get_upload_path( $entry['form_id']) . '/' . $filename
            
            
            $uploadsPath = GFFormsModel::get_file_upload_path( $entry['form_id'], $filename)['path'];
            $uploadsPath = custom_format_get_upload_path_from_gform_entry($uploadsPath);

            file_put_contents($uploadsPath, $image_data);   
            $wp_filetype = wp_check_filetype( $image_url_formated, null );

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

            if ($istitelbild == true):
                set_post_thumbnail($post_to_update, $attachment_id);
            endif;      
        endforeach;

}

function custom_format_get_url_from_gform_entry($image_url) {

    /* #### Transform the image urls based on the gravity forms field ### */

    // remove unnessacery backslashes
    $image_url = str_replace('\\', '', $image_url);
    $image_url = str_replace('"', '', $image_url);
    
    $format = custom_getFormat_from_File($image_url);       

    switch ($format):
        case '.jpg':
            $image_url = substr($image_url, 0, strpos($image_url, ".jpg") +4);
            break;
        case '.png':
            $image_url = substr($image_url, 0, strpos($image_url, ".png") +4);
            break;
        case '.jpeg':
            $image_url = substr($image_url, 0, strpos($image_url, ".jpeg") +5 );
            break;
        case '.gif':
            $image_url = substr($image_url, 0, strpos($image_url, ".gif") +4);
            break;                
        default:
            $image_url = $image_url;
    
    endswitch;


    $image_url_formated = substr($image_url, strpos($image_url, "http") ); 
    
    return $image_url_formated;

}

function custom_format_get_upload_path_from_gform_entry($uploadsPath) {
    /* #### Gravity Forms tells us wrong file upload paths. We have to fix this. ### */
    /* f.e. image is being uploaded to: /Applications/MAMP/htdocs/vernissage/wp-content/uploads/gravity_forms/1-33a4fbe0f95b1044ab539ad43e03d434/titis.jpg"

    gravity forms gives us the following path: /Applications/MAMP/htdocs/vernissage/wp-content/uploads/gravity_forms/1-33a4fbe0f95b1044ab539ad43e03d434/titis.jpg" */
 
    $format = custom_getFormat_from_File($uploadsPath);       
    
    $uploadsPath = substr($uploadsPath, 0, strpos($uploadsPath, $format) -1);
    $uploadsPath = $uploadsPath . $format;

    return $uploadsPath;
}

function custom_getFormat_from_File($uploadsPath) {
    /* determine supported format from file */

    $format = '';
    (strpos($uploadsPath, ".jpg") == false) ?: $format ='.jpg';
    (strpos($uploadsPath, ".png") == false) ?: $format ='.png';
    (strpos($uploadsPath, ".jpeg") == false) ?: $format ='.jpeg';
    (strpos($uploadsPath, ".gif") == false)   ?: $format ='.gif'; 

    return $format;
}
?>  



