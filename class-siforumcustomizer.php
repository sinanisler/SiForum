<?php

// Disable directly access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SiForumCustomizer' ) ) {
	class SiForumCustomizer {
		public function __construct() {
			add_action( 'customize_register', array( $this, 'siforum_customizer_register' ) );
		}

		public function siforum_customizer_register( $wp_customize ) {

			/* ----------PANEL------------- */
			$wp_customize->add_panel(
				'siforum_panel',
				array(
					'priority'    => 40,
					'title'       => __( 'Theme Settings', 'siforum' ),
					'description' => __( 'SiForum theme settings', 'siforum' ),
				)
			);
			/* /---------PANEL------------- */
			/* ----------SECTIONS---------- */
			$wp_customize->add_section(
				'siforum_theme_settings',
				array(
					'title' => __( 'Logo & URL & Other', 'cttheme' ),
					'panel' => 'siforum_panel',
				)
			);
			$wp_customize->add_section(
				'siforum_theme_settings_fontawesome',
				array(
					'title' => __( 'Fontawesome', 'cttheme' ),
					'panel' => 'siforum_panel',
				)
			);
			/* /---------SECTIONS---------- */
			/* ----------SETTINGS---------- */
			$wp_customize->add_setting(
				'siforum_header_image',
				array(
					'type'              => 'theme_mod',
					'transport'         => 'refresh',
					'sanitize_callback' => array( $this, 'siforum_sanitize_image' ),
				)
			);
			$wp_customize->add_setting(
				'siforum_header_link',
				array(
					'type'      => 'theme_mod',
					'default'   => 'https://atarikafa.com',
					'transport' => 'refresh',
				)
			);
			$wp_customize->add_setting(
				'siforum_header_background_color',
				array(
					'type'      => 'theme_mod',
					'transport' => 'refresh',
					'default'   => '#c10c0c',
				)
			);
			$wp_customize->add_setting(
				'siforum_fontawesome_select',
				array(
					'type'      => 'theme_mod',
					'transport' => 'refresh',
					'default'   => 'no',
				)
			);
			/* /---------SETTINGS---------- */
			/* ----------CONTROLLERS------- */
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'siforum_header_image_control',
					array(
						'label'    => __( 'Header Logo', 'siforum' ),
						'section'  => 'siforum_theme_settings',
						'settings' => 'siforum_header_image',
					)
				)
			);
			$wp_customize->add_control(
				'siforum_header_link',
				array(
					'id'      => 'siforum_header_link_control',
					'label'   => 'Header Link',
					'section' => 'siforum_theme_settings',
				)
			);
			// Add Controls
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'siforum_header_background_color_control',
					array(
						'label'    => 'Header Background Color',
						'section'  => 'siforum_theme_settings',
						'settings' => 'siforum_header_background_color',

					)
				)
			);

			$wp_customize->add_control(
				'siforum_fontawesome_select',
				array(
					'type'    => 'select',
					'section' => 'siforum_theme_settings_fontawesome',
					'label'   => __( 'Enable Font Awesome Usage', 'siforum' ),
					'choices' => array(
						'no'  => __( 'No' ),
						'yes' => __( 'Yes' ),
					),
				)
			);
			/* /---------CONTROLLERS------- */
		}


		public function siforum_sanitize_image( $file, $setting ) {

			$mimes = array(
				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif'          => 'image/gif',
				'png'          => 'image/png',
				'svg'          => 'image/svg+xml',
			);

			//check file type from file name
			$file_ext = wp_check_filetype( $file, $mimes );

			//if file has a valid mime type return it, otherwise return default
			return ( $file_ext['ext'] ? $file : $setting->default );
		}

	}

	$cutoms = new SiForumCustomizer();
}
