<?php
/*
Plugin Name:  Accordion
Plugin URI: http://paisleyfarmersmarket.ca/sohels/
Description: This plugin will add an expand collapse accordion feature inside a post or page.
Author: sohelwpexpert
Author URI: http://paisleyfarmersmarket.ca/sohels/
Version: 1.1
*/


/*Some Set-up*/
define('WP_ACCORDION_THREE_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );



function ms_wp_accordion_three_latest_jquery() {
/**
 * Register global styles & scripts.
 */
wp_register_style('wp-accordion-plugin-style', WP_ACCORDION_THREE_PLUGIN_PATH.'css/style.css');

wp_register_script('wp-accordion-plugin-script-active', WP_ACCORDION_THREE_PLUGIN_PATH.'js/florida-custom.js', array( 'jquery' ));


/**
 * Enqueue global styles & scripts.
 */
 
wp_enqueue_style('wp-accordion-plugin-style');

wp_enqueue_script('wp-accordion-plugin-script-active');
wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'ms_wp_accordion_three_latest_jquery' );




/* Add Slider Shortcode Button on Post Visual Editor */

function wpaccordion_button() {
	add_filter ("mce_external_plugins", "wpaccordion_button_js");
	add_filter ("mce_buttons", "wpaccordionb");
}

function wpaccordion_button_js($plugin_array) {
	$plugin_array['wptutsa'] = plugins_url('js/accordian-button.js', __FILE__);
	return $plugin_array;
}

function wpaccordionb($buttons) {
	array_push ($buttons, 'wpaccordiontriger');
	return $buttons;
}
add_action ('init', 'wpaccordion_button'); 




/* Generates Toggles Shortcode */
function wp_accordion_main($atts, $content = null) {
	return ('<div id="wp-tabs">'.do_shortcode($content).'</div>');
}
add_shortcode ("wp_accordion", "wp_accordion_main");

function wp_accordion_toggles($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => ''
    ), $atts));
	
	return ('
	   <span class="acc-trigger active"><a href="#"><strong>' .$title. '</strong></a></span>
        <div class="acc-container">
          <article class="content">
           ' .$content. '
          </article>
        </div>
	');
}
add_shortcode ("wp_toggle", "wp_accordion_toggles");


?>