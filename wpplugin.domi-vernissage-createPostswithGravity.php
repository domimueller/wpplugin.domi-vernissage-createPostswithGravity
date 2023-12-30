<?php

/**
* Plugin Name: Gravity Hooks für Erstellung von Inseraten
* Plugin URI: 
* Description: Funktionalität für Gravity Forms Erstellung basierend auf Postdaten. Darstellung im Theme
* Version: 1.0
* Author: Dominique Müller
* Author URI: 
**/


$plugin_url = WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__));

/* include Scripts*/
function domi_custom_customcss_create_gform() {
    wp_enqueue_style( 'customcss',  plugin_dir_url( __FILE__ ) . '/css/custom.css' );                      
}
add_action( 'wp_enqueue_scripts', 'domi_custom_customcss_create_gform');


/* INCLUDE FILES */
include $plugin_url . '/includes/gform_after_submission.php';
include $plugin_url . '/includes/customFunctions.php';
include $plugin_url . '/includes/gformConfiguration.php';
include $plugin_url . '/includes/gformMappingTestumgebung.php';
include $plugin_url . '/includes/gformMappingProduktivumgebung.php';



?>