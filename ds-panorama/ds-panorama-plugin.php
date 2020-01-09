<?php

/**
 * Plugin Name: Panorama for Divi
 * Plugin URI: https://divi-sensei.com/panorama-for-divi
 * Description: Display interactive panoramas on your Divi site
 * Author: Divi Sensei
 * Author URI: https://divi-sensei.com
 * Version: 1.0
 */

//Load Base Module Class
require_once plugin_dir_path(__FILE__) . '/includes/jt-divi-module/class-jt-divi-module.php';

//Load Counter Module
require_once plugin_dir_path(__FILE__) . '/ds-panorama-module.php';

//Load Updater
require plugin_dir_path(__FILE__) . '/includes/plugin-update-checker-4.2/plugin-update-checker.php';
$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'http://divi-sensei.com/wp-update-server/?action=get_metadata&slug=ds-panorama', //Metadata URL.
    __FILE__, //Full path to the main plugin file.
    'ds-panorama' //Plugin slug. Usually it's the same as the name of the directory.
);

//Lod Frontend CSS and JS
add_action('wp_enqueue_scripts', 'ds_panorama_enqueue_scripts');
function ds_panorama_enqueue_scripts()
{
    //3rd party
    wp_register_style('ds_panorama_jquery_css', plugins_url('includes/panorama_viewer.css', __FILE__));
    wp_register_script('ds_panorama_jquery_js', plugin_dir_url(__FILE__) . 'includes/jquery.panorama_viewer.js', array('jquery'), true);
    
    //module
    wp_register_style('ds_panorama_css', plugins_url('ds-panorama-style.css', __FILE__));
    wp_register_script('ds_panorama', plugin_dir_url(__FILE__) . 'ds-panorama-module.js', array('jquery', 'et-builder-modules-global-functions-script', 'ds_panorama_jquery_js'), true);
}

//Load Admin CSS
add_action('admin_enqueue_scripts', 'ds_panorama_admin_enqueue_scripts');
function ds_panorama_admin_enqueue_scripts()
{
    wp_enqueue_style('ds_panorama_admin_css', plugins_url('admin/css/admin-style.css', __FILE__));
    wp_enqueue_script('ds_panorama', plugin_dir_url(__FILE__) . '/admin/js/admin.js', array('jquery'), true);
}
