<?php
$wp_customize->add_setting(
	'layout_version',
	array(
		'default'           => themesflat_customize_default( 'layout_version' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	'layout_version',
	array(
		'type'     => 'select',
		'section'  => 'background_image',
		'priority' => 1,
		'label'    => esc_html__( 'Layout version', 'fungi' ),
		'choices'  => array(
			'wide'  => esc_html__( 'Wide', 'fungi' ),
			'boxed' => esc_html__( 'Boxed', 'fungi' ),
		)
	)
);

// body background color
$wp_customize->add_setting(
	'body_background_color',
	array(
		'default'           => themesflat_customize_default( 'body_background_color' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new themesflat_ColorOverlay(
		$wp_customize,
		'body_background_color',
		array(
			'label'    => esc_html__( 'Body Background Color', 'fungi' ),
			'section'  => 'background_image',
			'priority' => 2
		)
	)
);

// Content Box control
$wp_customize->add_setting(
	'content_controls',
	array(
		'default'           => themesflat_customize_default( 'content_controls' ),
		'sanitize_callback' => 'themesflat_sanitize_text',
	)
);
$wp_customize->add_control( new themesflat_BoxControls( $wp_customize,
		'content_controls',
		array(
			'label'    => esc_html__( 'Content Box Controls (px)', 'fungi' ),
			'section'  => 'background_image',
			'type'     => 'box-controls',
			'priority' => 10
		) )
);

$wp_customize->add_setting(
	'content_controls_mobile',
	array(
		'default'           => themesflat_customize_default( 'content_controls_mobile' ),
		'sanitize_callback' => 'themesflat_sanitize_text',
	)
);
$wp_customize->add_control( new themesflat_BoxControls( $wp_customize,
		'content_controls_mobile',
		array(
			'label'    => esc_html__( 'Content Box Mobile (px)', 'fungi' ),
			'section'  => 'background_image',
			'type'     => 'box-controls',
			'priority' => 15
		) )
);

$wp_customize->add_setting(
	'page_sidebar_layout',
	array(
		'default'           => themesflat_customize_default( 'page_sidebar_layout' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	'page_sidebar_layout',
	array(
		'type'     => 'select',
		'section'  => 'background_image',
		'priority' => 20,
		'label'    => esc_html__( 'Page Sidebar Position', 'fungi' ),
		'choices'  => array(
			'sidebar-right'    => esc_html__( 'Sidebar Right', 'fungi' ),
			'sidebar-left'     => esc_html__( 'Sidebar Left', 'fungi' ),
			'fullwidth'        => esc_html__( 'Full Width', 'fungi' ),
			'fullwidth-small'  => esc_html__( 'Full Width Small', 'fungi' ),
			'fullwidth-center' => esc_html__( 'Full Width Center', 'fungi' ),
		),
	)
);