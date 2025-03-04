<?php
//Header Style
$wp_customize->add_setting(
	'style_header',
	array(
		'default'           => themesflat_customize_default( 'style_header' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new themesflat_RadioImages( $wp_customize,
		'style_header',
		array(
			'type'     => 'radio-images',
			'section'  => 'section_options',
			'priority' => 5,
			'label'    => esc_html__( 'Header Style', 'fungi' ),
			'choices'  => array(
				'header-default' => array(
					'tooltip' => esc_html__( 'Header Default', 'fungi' ),
					'src'     => THEMESFLAT_LINK . 'images/controls/header-default.jpg'
				),
				'header-01'      => array(
					'tooltip' => esc_html__( 'Header 01', 'fungi' ),
					'src'     => THEMESFLAT_LINK . 'images/controls/header-1.png'
				),
				'header-02'      => array(
					'tooltip' => esc_html__( 'Header 02', 'fungi' ),
					'src'     => THEMESFLAT_LINK . 'images/controls/header-2.png'
				),
				'header-03'      => array(
					'tooltip' => esc_html__( 'Header 03', 'fungi' ),
					'src'     => THEMESFLAT_LINK . 'images/controls/header-3.png'
				),
				'header-04'      => array(
					'tooltip' => esc_html__( 'Header 04', 'fungi' ),
					'src'     => THEMESFLAT_LINK . 'images/controls/header-4.png'
				),
			),
		) )
);

themesflat_customize_separation_section( $args = array(
	'section'   => 'section_options',
	'customize' => $wp_customize,
	'priority'  => 7,
) );

// Enable Header Absolute
$wp_customize->add_setting(
	'header_absolute',
	array(
		'sanitize_callback' => 'themesflat_sanitize_checkbox',
		'default'           => themesflat_customize_default( 'header_absolute' ),
	)
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
		'header_absolute',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Header Absolute ( OFF | ON )', 'fungi' ),
			'section'  => 'section_options',
			'priority' => 10,
		) )
);


// Show search
// $wp_customize->add_setting(
// 	'header_search_box',
// 	array(
// 		'sanitize_callback' => 'themesflat_sanitize_checkbox',
// 		'default'           => themesflat_customize_default( 'header_search_box' ),
// 	)
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
// 		'header_search_box',
// 		array(
// 			'type'     => 'checkbox',
// 			'label'    => esc_html__( 'Search Box ( OFF | ON )', 'fungi' ),
// 			'section'  => 'section_options',
// 			'priority' => 15,
// 		) )
// );

// // Show search 
// $wp_customize->add_setting(
// 	'header_sidebar_toggler',
// 	array(
// 		'sanitize_callback' => 'themesflat_sanitize_checkbox',
// 		'default'           => themesflat_customize_default( 'header_sidebar_toggler' ),
// 	)
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
// 		'header_sidebar_toggler',
// 		array(
// 			'type'     => 'checkbox',
// 			'label'    => esc_html__( 'Sidebar Toggler ( OFF | ON )', 'fungi' ),
// 			'section'  => 'section_options',
// 			'priority' => 20,
// 		) )
// );

// // Show search
// $wp_customize->add_setting(
// 	'header_social_icon',
// 	array(
// 		'sanitize_callback' => 'themesflat_sanitize_checkbox',
// 		'default'           => themesflat_customize_default( 'header_social_icon' ),
// 	)
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
// 		'header_social_icon',
// 		array(
// 			'type'     => 'checkbox',
// 			'label'    => esc_html__( 'Social Icon ( OFF | ON )', 'fungi' ),
// 			'section'  => 'section_options',
// 			'priority' => 21,
// 		) )
// );


// themesflat_customize_separation_section( $args = array(
// 	'section'   => 'section_options',
// 	'customize' => $wp_customize,
// 	'priority'  => 22,
// ) );

// Enable Header Sticky
$wp_customize->add_setting(
	'header_sticky',
	array(
		'sanitize_callback' => 'themesflat_sanitize_checkbox',
		'default'           => themesflat_customize_default( 'header_sticky' ),
	)
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
		'header_sticky',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Header Sticky ( OFF | ON )', 'fungi' ),
			'section'  => 'section_options',
			'priority' => 22,
		) )
);


$wp_customize->add_setting(
	'header_sticky_mode',
	array(
		'default'           => themesflat_customize_default( 'header_sticky_mode' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	'header_sticky_mode',
	array(
		'type'     => 'select',
		'section'  => 'section_options',
		'priority' => 23,
		'label'    => esc_html__( 'Header Sticky Mode', 'fungi' ),
		'choices'  => array(
			'header-show-on-scroll-up' => esc_html__( 'Show On Scroll Up', 'fungi' ),
			'header-always-show'       => esc_html__( 'Always Show', 'fungi' ),
		),
		'active_callback' => function () use ( $wp_customize ) {
			return 1 === $wp_customize->get_setting( 'header_sticky' )->value();
		},
	)
);

themesflat_customize_separation_section( $args = array(
	'section'   => 'section_options',
	'customize' => $wp_customize,
	'priority'  => 26,
) );

$wp_customize->add_setting(
	'header_height',
	array(
		'default'           => themesflat_customize_default( 'header_height' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
		'header_height',
		array(
			'type'        => 'slide-control',
			'section'     => 'section_options',
			'label'       => esc_html__( 'Height', 'fungi' ),
			'priority'    => 27,
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 400,
				'step' => 1,
			),
		)

	)
);

$wp_customize->add_setting(
	'header_height_sticky',
	array(
		'default'           => themesflat_customize_default( 'header_height_sticky' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
		'header_height_sticky',
		array(
			'type'        => 'slide-control',
			'section'     => 'section_options',
			'label'       => esc_html__( 'Height Sticky', 'fungi' ),
			'priority'    => 28,
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 400,
				'step' => 1,
			),
		)

	)
);

//CUSTOM HTML
// themesflat_customize_separation_section( $args = array(
// 	'section'   => 'section_options',
// 	'customize' => $wp_customize,
// 	'priority'  => 29,
// ) );

// $wp_customize->add_setting(
// 	'header_custom_html_enable',
// 	array(
// 		'sanitize_callback' => 'themesflat_sanitize_checkbox',
// 		'default'           => themesflat_customize_default( 'header_custom_html_enable' ),
// 	)
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
// 		'header_custom_html_enable',
// 		array(
// 			'type'     => 'checkbox',
// 			'label'    => esc_html__( ' Custom html ( OFF | ON )', 'fungi' ),
// 			'section'  => 'section_options',
// 			'priority' => 30,
// 		) )
// );

// $wp_customize->add_setting(
// 	'header_custom_html',
// 	array(
// 		'default'           => themesflat_customize_default( 'header_custom_html' ),
// 		'sanitize_callback' => 'themesflat_sanitize_text'
// 	)
// );
// $wp_customize->add_control(
// 	'header_custom_html',
// 	array(
// 		'label'           => esc_html__( 'Custom HTML', 'fungi' ),
// 		'section'         => 'section_options',
// 		'type'            => 'textarea',
// 		'priority'        => 35,
// 		'active_callback' => function () use ( $wp_customize ) {
// 			return 1 === $wp_customize->get_setting( 'header_custom_html_enable' )->value();
// 		},

// 	)
// );

// themesflat_customize_separation_section( $args = array(
// 	'section'   => 'section_options',
// 	'customize' => $wp_customize,
// 	'priority'  => 37,
// ) );

// // Phone Number
// $wp_customize->add_setting(
// 	'header_phone_enable',
// 	array(
// 		'sanitize_callback' => 'themesflat_sanitize_checkbox',
// 		'default'           => themesflat_customize_default( 'header_phone_enable' ),
// 	)
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
// 		'header_phone_enable',
// 		array(
// 			'type'     => 'checkbox',
// 			'label'    => esc_html__( ' Phone ( OFF | ON )', 'fungi' ),
// 			'section'  => 'section_options',
// 			'priority' => 40,
// 		) )
// );

// $wp_customize->add_setting(
// 	'header_phone',
// 	array(
// 		'default'           => themesflat_customize_default( 'header_phone' ),
// 		'sanitize_callback' => 'themesflat_sanitize_text'
// 	)
// );
// $wp_customize->add_control(
// 	'header_phone',
// 	array(
// 		'label'           => esc_html__( 'Enter Phone Number', 'fungi' ),
// 		'section'         => 'section_options',
// 		'type'            => 'textarea',
// 		'priority'        => 45,
// 		'active_callback' => function () use ( $wp_customize ) {
// 			return 1 === $wp_customize->get_setting( 'header_phone_enable' )->value();
// 		},

// 	)
// );

// themesflat_customize_separation_section( $args = array(
// 	'section'   => 'section_options',
// 	'customize' => $wp_customize,
// 	'priority'  => 47,
// ) );


// // Email
// $wp_customize->add_setting(
// 	'header_email_enable',
// 	array(
// 		'sanitize_callback' => 'themesflat_sanitize_checkbox',
// 		'default'           => themesflat_customize_default( 'header_email_enable' ),
// 	)
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
// 		'header_email_enable',
// 		array(
// 			'type'     => 'checkbox',
// 			'label'    => esc_html__( ' Email address ( OFF | ON )', 'fungi' ),
// 			'section'  => 'section_options',
// 			'priority' => 50,
// 		) )
// );

// $wp_customize->add_setting(
// 	'header_email',
// 	array(
// 		'default'           => themesflat_customize_default( 'header_email' ),
// 		'sanitize_callback' => 'themesflat_sanitize_text'
// 	)
// );
// $wp_customize->add_control(
// 	'header_email',
// 	array(
// 		'label'           => esc_html__( 'Enter Email', 'fungi' ),
// 		'section'         => 'section_options',
// 		'type'            => 'textarea',
// 		'priority'        => 55,
// 		'active_callback' => function () use ( $wp_customize ) {
// 			return 1 === $wp_customize->get_setting( 'header_email_enable' )->value();
// 		},

// 	)
// );

// themesflat_customize_separation_section( $args = array(
// 	'section'   => 'section_options',
// 	'customize' => $wp_customize,
// 	'priority'  => 60,
// ) );

// // Button
// $wp_customize->add_setting(
// 	'header_button_enable',
// 	array(
// 		'sanitize_callback' => 'themesflat_sanitize_checkbox',
// 		'default'           => themesflat_customize_default( 'header_button_enable' ),
// 	)
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
// 		'header_button_enable',
// 		array(
// 			'type'     => 'checkbox',
// 			'label'    => esc_html__( ' button ( OFF | ON )', 'fungi' ),
// 			'section'  => 'section_options',
// 			'priority' => 65,
// 		) )
// );

// $wp_customize->add_setting(
// 	'header_button',
// 	array(
// 		'default'           => themesflat_customize_default( 'header_button' ),
// 		'sanitize_callback' => 'themesflat_sanitize_text'
// 	)
// );

// $wp_customize->add_control(
// 	'header_button',
// 	array(
// 		'label'           => esc_html__( 'Enter text button', 'fungi' ),
// 		'section'         => 'section_options',
// 		'type'            => 'textarea',
// 		'priority'        => 70,
// 		'active_callback' => function () use ( $wp_customize ) {
// 			return 1 === $wp_customize->get_setting( 'header_button_enable' )->value();
// 		},

// 	)
// );


// $wp_customize->add_setting(
// 	'header_url_button',
// 	array(
// 		'default'           => themesflat_customize_default( 'header_url_button' ),
// 		'sanitize_callback' => 'themesflat_sanitize_text'
// 	)
// );

// $wp_customize->add_control(
// 	'header_url_button',
// 	array(
// 		'label'           => esc_html__( 'Enter url button', 'fungi' ),
// 		'section'         => 'section_options',
// 		'type'            => 'text',
// 		'priority'        => 70,
// 		'active_callback' => function () use ( $wp_customize ) {
// 			return 1 === $wp_customize->get_setting( 'header_button_enable' )->value();
// 		},

// 	)
// );