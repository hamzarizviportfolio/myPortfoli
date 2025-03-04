<?php
// Page title heading
$wp_customize->add_setting(
	'sub_title_enabled',
	array(
		'sanitize_callback' => 'themesflat_sanitize_checkbox',
		'default'           => themesflat_customize_default( 'sub_title_enabled' ),
	)
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
		'sub_title_enabled',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Sub Title ( OFF | ON )', 'fungi' ),
			'section'  => 'section_subtitle',
			'priority' => 5,
		) )
);

$wp_customize->add_setting(
	'sub_title',
	array(
		'default'           => themesflat_customize_default( 'sub_title' ),
		'sanitize_callback' => 'themesflat_sanitize_text'
	)
);

$wp_customize->add_control(
	'sub_title',
	array(
		'label'           => esc_html__( 'Enter Sub Title', 'fungi' ),
		'section'         => 'section_subtitle',
		'type'            => 'text',
		'priority'        => 10,
		'active_callback' => function () use ( $wp_customize ) {
			return 1 === $wp_customize->get_setting( 'sub_title_enabled' )->value();
		},

	)
);