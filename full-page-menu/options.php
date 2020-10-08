<?php

class FullPageMenu {
	private $full_page_menu_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'full_page_menu_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'full_page_menu_page_init' ) );
	}

	public function full_page_menu_add_plugin_page() {
		add_options_page(
			'Full Page Menu', // page_title
			'Full Page Menu', // menu_title
			'manage_options', // capability
			'full-page-menu', // menu_slug
			array( $this, 'full_page_menu_create_admin_page' ) // function
		);
	}

	public function full_page_menu_create_admin_page() {
		$this->full_page_menu_options = get_option( 'full_page_menu_option_name' ); ?>

		<div class="wrap">
			<h2>Full Page Menu</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'full_page_menu_option_group' );
					do_settings_sections( 'full-page-menu-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function full_page_menu_page_init() {
		register_setting(
			'full_page_menu_option_group', // option_group
			'full_page_menu_option_name', // option_name
			array( $this, 'full_page_menu_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'full_page_menu_setting_section', // id
			'Settings', // title
			array( $this, 'full_page_menu_section_info' ), // callback
			'full-page-menu-admin' // page
		);

		add_settings_field(
			'shortcode_content_0', // id
			'Shortcode content', // title
			array( $this, 'shortcode_content_0_callback' ), // callback
			'full-page-menu-admin', // page
			'full_page_menu_setting_section' // section
		);

		add_settings_field(
			'top_margin_1', // id
			'Top margin', // title
			array( $this, 'top_margin_1_callback' ), // callback
			'full-page-menu-admin', // page
			'full_page_menu_setting_section' // section
		);

		add_settings_field(
			'top_margin_2', // id
			'Top margin - mobile', // title
			array( $this, 'top_margin_2_callback' ), // callback
			'full-page-menu-admin', // page
			'full_page_menu_setting_section' // section
		);

		add_settings_field(
			'background_colour_2', // id
			'Background colour', // title
			array( $this, 'background_colour_2_callback' ), // callback
			'full-page-menu-admin', // page
			'full_page_menu_setting_section' // section
		);

		add_settings_field(
			'banner_background_3', // id
			'Banner Background', // title
			array( $this, 'banner_background_3_callback' ), // callback
			'full-page-menu-admin', // page
			'full_page_menu_setting_section' // section
		);

		add_settings_field(
			'custom_trigger', // id
			'Custom Trigger', // title
			array( $this, 'custom_trigger_callback' ), // callback
			'full-page-menu-admin', // page
			'full_page_menu_setting_section' // section
		);
	}

	public function full_page_menu_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['shortcode_content_0'] ) ) {
			$sanitary_values['shortcode_content_0'] = sanitize_text_field( $input['shortcode_content_0'] );
		}

		if ( isset( $input['top_margin_1'] ) ) {
			$sanitary_values['top_margin_1'] = sanitize_text_field( $input['top_margin_1'] );
		}

		if ( isset( $input['top_margin_2'] ) ) {
			$sanitary_values['top_margin_2'] = sanitize_text_field( $input['top_margin_2'] );
		}

		if ( isset( $input['background_colour_2'] ) ) {
			$sanitary_values['background_colour_2'] = sanitize_text_field( $input['background_colour_2'] );
		}

		if ( isset( $input['banner_background_3'] ) ) {
			$sanitary_values['banner_background_3'] = sanitize_text_field( $input['banner_background_3'] );
		}

		if ( isset( $input['custom_trigger'] ) ) {
			$sanitary_values['custom_trigger'] = sanitize_text_field( $input['custom_trigger'] );
		}

		return $sanitary_values;
	}

	public function full_page_menu_section_info() {

	}

	public function shortcode_content_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="full_page_menu_option_name[shortcode_content_0]" id="shortcode_content_0" value="%s">',
			isset( $this->full_page_menu_options['shortcode_content_0'] ) ? esc_attr( $this->full_page_menu_options['shortcode_content_0']) : ''
		);
	}

	public function top_margin_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="full_page_menu_option_name[top_margin_1]" id="top_margin_1" value="%s">',
			isset( $this->full_page_menu_options['top_margin_1'] ) ? esc_attr( $this->full_page_menu_options['top_margin_1']) : ''
		);
	}

	public function top_margin_2_callback() {
		printf(
			'<input class="regular-text" type="text" name="full_page_menu_option_name[top_margin_2]" id="top_margin_2" value="%s">',
			isset( $this->full_page_menu_options['top_margin_2'] ) ? esc_attr( $this->full_page_menu_options['top_margin_2']) : ''
		);
	}

	public function background_colour_2_callback() {
		printf(
			'<input class="regular-text" type="text" name="full_page_menu_option_name[background_colour_2]" id="background_colour_2" value="%s">',
			isset( $this->full_page_menu_options['background_colour_2'] ) ? esc_attr( $this->full_page_menu_options['background_colour_2']) : ''
		);
	}

	public function banner_background_3_callback() {
		printf(
			'<input class="regular-text" type="text" name="full_page_menu_option_name[banner_background_3]" id="banner_background_3" value="%s">',
			isset( $this->full_page_menu_options['banner_background_3'] ) ? esc_attr( $this->full_page_menu_options['banner_background_3']) : ''
		);
	}

	public function custom_trigger_callback() {
		printf(
			'<input class="regular-text" type="text" name="full_page_menu_option_name[custom_trigger]" id="custom_trigger" value="%s">',
			isset( $this->full_page_menu_options['custom_trigger'] ) ? esc_attr( $this->full_page_menu_options['custom_trigger']) : ''
		);
	}

}
if ( is_admin() ) {
    $full_page_menu = new FullPageMenu();
}
