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
			/* /---------SETTINGS---------- */
			/* ----------CONTROLLERS------- */
			/* /---------CONTROLLERS------- */
		}

	}

	$cutoms = new SiForumCustomizer();
}
