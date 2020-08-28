<?php
/**
 * Plugin Name: Slide Out Menu
 * Description: Provides a full screen meny that slides out from two sides
 * Version:     1.0.0
 * Author:      Stephen B
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

include(__DIR__ . '/options.php');

add_action( 'wp_enqueue_scripts', 'wpslm_load_front_scripts' );

function wpslm_load_front_scripts() {
	wp_enqueue_script('wpslm_scripts', plugins_url( '/scripts.js', __FILE__ ), ['jquery']);
	wp_enqueue_style( 'wpslm_styles', plugins_url( '/style.css', __FILE__ ));
}

add_action( 'wp_head', 'wpslm_dynamic_css' );

function wpslm_dynamic_css() {
	$wpslm = get_option( 'slide_page_menu_option_name' );
	$bg1 = $wpslm['background_colour_0'];
	$bg2 = $wpslm['background_colour_1'];
	$iconbg = $wpslm['icon_background_0'];
	$css = ".wpslm-left { background-color: ".$bg1."; } .wpslm-right { background-color: ".$bg2."; } .wpslm-close { background-color: ".$iconbg."; }";
	echo "<style>".$css."</style>";
}

add_action('wp_footer', 'output_slide_page_menu');

function output_slide_page_menu() {
	$wpslm = get_option( 'slide_page_menu_option_name' );
	$shortcode1 = $wpslm['shortcode_content_0'];
	$shortcode2 = $wpslm['shortcode_content_1'];
	echo '<div class="wpslm wpslm-left">';
	echo do_shortcode($shortcode1);
	echo '</div>';

	echo '<div class="wpslm wpslm-right">';
	echo do_shortcode($shortcode2);
	echo '</div>';
	echo '<span class="wpslm-close">X</span>';
}
