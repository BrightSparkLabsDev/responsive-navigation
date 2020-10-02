<?php

class SlidePageMenu {
	private $slide_page_menu_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'slide_page_menu_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'slide_page_menu_page_init' ) );
	}

	public function slide_page_menu_add_plugin_page() {
		add_options_page(
			'Slide Page Menu', // page_title
			'Slide Page Menu', // menu_title
			'manage_options', // capability
			'slide-page-menu', // menu_slug
			array( $this, 'slide_page_menu_create_admin_page' ) // function
		);
	}

	public function slide_page_menu_create_admin_page() {
		$this->slide_page_menu_options = get_option( 'slide_page_menu_option_name' ); ?>

		<div class="wrap">
			<h2>Slide Page Menu</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'slide_page_menu_option_group' );
					do_settings_sections( 'slide-page-menu-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function slide_page_menu_page_init() {
		register_setting(
			'slide_page_menu_option_group', // option_group
			'slide_page_menu_option_name', // option_name
			array( $this, 'slide_page_menu_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'slide_page_menu_setting_section', // id
			'Settings', // title
			array( $this, 'slide_page_menu_section_info' ), // callback
			'slide-page-menu-admin' // page
		);

		add_settings_field(
			'shortcode_content_0', // id
			'Shortcode content left', // title
			array( $this, 'shortcode_content_0_callback' ), // callback
			'slide-page-menu-admin', // page
			'slide_page_menu_setting_section' // section
		);

		add_settings_field(
			'shortcode_content_1', // id
			'Shortcode content right', // title
			array( $this, 'shortcode_content_1_callback' ), // callback
			'slide-page-menu-admin', // page
			'slide_page_menu_setting_section' // section
		);

		add_settings_field(
			'background_colour_0', // id
			'Background colour left', // title
			array( $this, 'background_colour_0_callback' ), // callback
			'slide-page-menu-admin', // page
			'slide_page_menu_setting_section' // section
		);

		add_settings_field(
			'background_colour_1', // id
			'Background colour right', // title
			array( $this, 'background_colour_1_callback' ), // callback
			'slide-page-menu-admin', // page
			'slide_page_menu_setting_section' // section
		);

		add_settings_field(
			'icon_background_0', // id
			'Icon Background', // title
			array( $this, 'icon_background_0_callback' ), // callback
			'slide-page-menu-admin', // page
			'slide_page_menu_setting_section' // section
		);

		add_settings_field(
			'custom_trigger', // id
			'Custom Trigger', // title
			array( $this, 'custom_trigger_callback' ), // callback
			'slide-page-menu-admin', // page
			'slide_page_menu_setting_section' // section
		);
	}

	public function slide_page_menu_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['shortcode_content_0'] ) ) {
			$sanitary_values['shortcode_content_0'] = sanitize_text_field( $input['shortcode_content_0'] );
		}

		if ( isset( $input['shortcode_content_1'] ) ) {
			$sanitary_values['shortcode_content_1'] = sanitize_text_field( $input['shortcode_content_1'] );
		}

		if ( isset( $input['background_colour_0'] ) ) {
			$sanitary_values['background_colour_0'] = sanitize_text_field( $input['background_colour_0'] );
		}

		if ( isset( $input['background_colour_1'] ) ) {
			$sanitary_values['background_colour_1'] = sanitize_text_field( $input['background_colour_1'] );
		}

		if ( isset( $input['icon_background_0'] ) ) {
			$sanitary_values['icon_background_0'] = sanitize_text_field( $input['icon_background_0'] );
		}

		if ( isset( $input['custom_trigger'] ) ) {
			$sanitary_values['custom_trigger'] = sanitize_text_field( $input['custom_trigger'] );
		}

		return $sanitary_values;
	}

	public function slide_page_menu_section_info() {

	}

	public function shortcode_content_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="slide_page_menu_option_name[shortcode_content_0]" id="shortcode_content_0" value="%s">',
			isset( $this->slide_page_menu_options['shortcode_content_0'] ) ? esc_attr( $this->slide_page_menu_options['shortcode_content_0']) : ''
		);
	}

	public function shortcode_content_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="slide_page_menu_option_name[shortcode_content_1]" id="shortcode_content_1" value="%s">',
			isset( $this->slide_page_menu_options['shortcode_content_1'] ) ? esc_attr( $this->slide_page_menu_options['shortcode_content_1']) : ''
		);
	}

	public function background_colour_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="slide_page_menu_option_name[background_colour_0]" id="background_colour_0" value="%s">',
			isset( $this->slide_page_menu_options['background_colour_0'] ) ? esc_attr( $this->slide_page_menu_options['background_colour_0']) : ''
		);
	}

	public function background_colour_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="slide_page_menu_option_name[background_colour_1]" id="background_colour_1" value="%s">',
			isset( $this->slide_page_menu_options['background_colour_1'] ) ? esc_attr( $this->slide_page_menu_options['background_colour_1']) : ''
		);
	}

	public function icon_background_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="slide_page_menu_option_name[icon_background_0]" id="icon_background_0" value="%s">',
			isset( $this->slide_page_menu_options['icon_background_0'] ) ? esc_attr( $this->slide_page_menu_options['icon_background_0']) : ''
		);
	}

	public function custom_trigger_callback() {
		printf(
			'<input class="regular-text" type="text" name="slide_page_menu_option_name[custom_trigger]" id="custom_trigger" value="%s">',
			isset( $this->slide_page_menu_options['custom_trigger'] ) ? esc_attr( $this->slide_page_menu_options['custom_trigger']) : ''
		);
	}

}
if ( is_admin() ) {
    $slide_page_menu = new SlidePageMenu();
}
