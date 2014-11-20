<?php
/* Plugin Name: SB Gallery for WordPress
Plugin URI: http://www.socialbullets.com/
Description: Add Styling and hovers effects to your gallery
Version: 1.2
Author: Arsalan Ahmed
Author URI: http://www.socialbullets.com/
License: GPLv2 or later
*/
include('includes/shortcode.php');

function azalaan_admin_actions() {
    add_options_page("SBGallery", "SBGallery", 3, "SBGallery", "azalaan_admin");
}
function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', plugins_url() . '/sb-gallery/css/style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
add_action('admin_menu', 'azalaan_admin_actions');
function azalaan_admin() {
    include('includes/gallery_options.php');
}
add_action('wp_head','gallery_includes');
add_action('wp_footer','gallery_scripts');
function gallery_includes()
{
wp_enqueue_style('awesome-gallery-slug',  plugins_url() . '/sb-gallery/css/style.css');  
}
function gallery_scripts()
{ 
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('fancybox',plugins_url() . '/sb-gallery/js/fancybox/jquery.fancybox-1.3.1.js',array( 'jquery' )); 
wp_enqueue_script('fancyfunction',plugins_url() . '/sb-gallery/js/fancybox/custom.js',array( 'jquery' )); 
} 
?>