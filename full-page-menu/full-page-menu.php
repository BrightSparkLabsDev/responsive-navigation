<?php
/**
 * Plugin Name: Full Page Menu
 * Description: Provides a full screen menu
 * Version:     1.0.0
 * Author:      Stephen B
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

include(__DIR__ . '/options.php');

add_action( 'wp_enqueue_scripts', 'wpfpm_load_front_scripts' );

function wpfpm_load_front_scripts() {
	wp_enqueue_script('wpfpm_scripts', plugins_url( '/scripts.js', __FILE__ ), ['jquery']);
	wp_enqueue_style( 'wpfpm_styles', plugins_url( '/style.css', __FILE__ ));
}

add_action( 'wp_head', 'wpfpm_dynamic_css' );

function wpfpm_dynamic_css() {
	$wpfpm = get_option( 'full_page_menu_option_name' );
	$bg = $wpfpm['background_colour_2'];
	$margin = $wpfpm['top_margin_1'];
	$margin_mobile = $wpfpm['top_margin_2'];
	$banner = $wpfpm['banner_background_3'];
	$css = ".wpfpm { background-color: ".$bg."; top: ".$margin."; } .elementor-sticky--effects  {background: ".$banner.";} @media(max-width:768px) { .wpfpm { top: ".$margin_mobile."; } }";

	echo "<style>".$css."</style>";
}

add_action('wp_footer', 'output_full_page_menu');

function output_full_page_menu() {
	$wpfpm = get_option( 'full_page_menu_option_name' );
	$shortcode = $wpfpm['shortcode_content_0'];
	echo '<div class="wpfpm">';
	echo do_shortcode($shortcode);
	echo '</div>';
}
