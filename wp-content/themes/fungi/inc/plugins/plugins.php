<?php
// Register action to declare required plugins
add_action( 'tgmpa_register', 'themesflat_recommend_plugin' );
function themesflat_recommend_plugin() {

	$plugins = array(
		array(
			'name'     => esc_html__( 'Elementor', 'fungi' ),
			'slug'     => 'elementor',
			'required' => true
		),
		array(
			'name'     => esc_html__( 'ThemesFlat', 'fungi' ),
			'slug'     => 'themesflat',
			'source'   => THEMESFLAT_DIR . 'inc/plugins/themesflat.zip',
			'required' => true
		),
		array(
			'name'     => esc_html__( 'Themesflat Elementor', 'fungi' ),
			'slug'     => 'themesflat-elementor',
			'source'   => THEMESFLAT_DIR . 'inc/plugins/themesflat-elementor.zip',
			'required' => true
		),
		array(
			'name'     => esc_html__( 'Contact Form 7', 'fungi' ),
			'slug'     => 'contact-form-7',
			'required' => true
		),
		array(
			'name'     => esc_html__( 'One Click Demo Import', 'fungi' ),
			'slug'     => 'one-click-demo-import',
			'required' => false
		),

	);

	tgmpa( $plugins );
}

