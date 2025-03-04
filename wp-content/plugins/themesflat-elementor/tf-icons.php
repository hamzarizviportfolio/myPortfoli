<?php
add_filter( 'elementor/icons_manager/additional_tabs', 'themesflat_iconpicker_register' );

function themesflat_iconpicker_register( $icons = array() ) {
	$icons['pe_icon'] = array(
		'name'          => 'pe_icon',
		'label'         => esc_html__( 'PE Icons', 'themesflat-elementor' ),
		'labelIcon'     => 'pe-7s-album',
		'prefix'        => '',
		'displayPrefix' => '',
		'url'           => THEMESFLAT_LINK . 'css/pe-icon-7-stroke.css',
		'fetchJson'     => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . 'assets/css/pe_icons.json',
		'ver'           => '1.0.0',
	);

	return $icons;
}