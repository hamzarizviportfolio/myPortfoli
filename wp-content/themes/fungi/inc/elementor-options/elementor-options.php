<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

class themesflat_options_elementor {
	public function __construct() {
		add_action( 'elementor/documents/register_controls', [ $this, 'themesflat_elementor_register_options' ], 10 );
		add_action( 'elementor/editor/before_enqueue_scripts', function () {
			wp_enqueue_script( 'elementor-preview-load', THEMESFLAT_LINK . 'js/elementor/elementor-preview-load.js', array( 'jquery' ), null, true );
		}, 10, 3 );
	}

	public function themesflat_elementor_register_options( $element ) {
		$post_id   = $element->get_id();
		$post_type = get_post_type( $post_id );

		$this->themesflat_options_color( $element );
		if ( ( $post_type !== 'post' ) && ( $post_type !== 'portfolios' ) && ( $post_type !== 'services' ) && ( $post_type !== 'doctor' ) ) {
			// $this->themesflat_options_topbar( $element );
			$this->themesflat_options_page_header( $element );
		}

		$this->themesflat_options_page( $element );
		$this->themesflat_options_page_pagetitle( $element );

		if ( $post_type == 'services' ) {
			$this->themesflat_options_services( $element );
		}
	}

	public function themesflat_options_color( $element ) {

		// TF Services
		$element->start_controls_section(
			'themesflat_color_options',
			[
				'label' => esc_html__( 'TF Color', 'fungi' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		$element->add_control(
			'secondary_color',
			[
				'label'     => esc_html__( 'Secondary Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--theme-secondary-color: {{VALUE}};',
				],
			]
		);

		$element->add_control(
			'primary_color',
			[
				'label'     => esc_html__( 'Primary Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--theme-primary-color: {{VALUE}};',
				],
			]
		);
		$element->add_control(
			'accent_color',
			[
				'label'     => esc_html__( 'Accent Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--theme-accent-color: {{VALUE}};',
				],
			]
		);

		$element->add_control(
			'body_background_color',
			[
				'label'     => esc_html__( 'Body Background Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--theme-background-color-main: {{VALUE}};',
					'{{WRAPPER}} body, .page-wrap, .boxed .themesflat-boxed,.page-sidebar ' => 'background-color: {{VALUE}};',
				],
			]
		);

		$element->end_controls_section();
	}

	public function themesflat_options_page_header( $element ) {
		// TF Header
		$element->start_controls_section(
			'themesflat_header_options',
			[
				'label' => esc_html__( 'TF Header', 'fungi' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		$element->add_control(
			'h_options_header',
			[
				'label'     => esc_html__( 'Header', 'fungi' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$element->add_control(
			'disable_header',
			[
				'label'        => esc_html__( 'Disable Header', 'fungi' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'On', 'fungi' ),
				'label_off'    => esc_html__( 'Off', 'fungi' ),
				'return_value' => 'yes',
			]
		);

		$element->add_control(
			'style_header',
			[
				'label'     => esc_html__( 'Header Style', 'fungi' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''               => esc_html__( 'Theme Setting', 'fungi' ),
					'header-default' => esc_html__( 'Header Default', 'fungi' ),
					'header-01'      => esc_html__( 'Header 01', 'fungi' ),
					'header-02'      => esc_html__( 'Header 02', 'fungi' ),
					'header-03'      => esc_html__( 'Header 03', 'fungi' ),
					'header-04'      => esc_html__( 'Header 04', 'fungi' ),
				],
				'condition' => [ 'disable_header!' => 'yes' ],
			]
		);
		// Logo
		$element->add_control(
			'site_logo',
			[
				'label'     => esc_html__( 'Custom Logo', 'fungi' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [ 'disable_header!' => 'yes' ],
			]
		);

		$element->add_control(
			'site_logo_sticky',
			[
				'label'     => esc_html__( 'Custom Logo Sticky', 'fungi' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [ 'disable_header!' => 'yes' ],
			]
		);
		$element->add_control(
			'site_logo_mobile',
			[
				'label'     => esc_html__( 'Custom Logo Mobile', 'fungi' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [ 'disable_header!' => 'yes' ],
			]
		);
		$element->add_responsive_control(
			'logo_width',
			[
				'label'      => esc_html__( 'Logo Width', 'fungi' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 30,
						'max' => 500,
					],
					'%'  => [
						'min' => 50,
						'max' => 150,
					],
				],
				'condition'  => [ 'disable_header!' => 'yes' ],
				'selectors'  => [
					'{{WRAPPER}} #header #logo a img, {{WRAPPER}} .modal-menu__panel-footer .logo-panel a img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$element->add_responsive_control(
			'spacing_menu',
			[
				'label'      => esc_html__( 'Spacing Menu', 'fungi' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'condition'  => [ 'disable_header!' => 'yes' ],
				'selectors'  => [
					'{{WRAPPER}} #mainnav > ul > li' => 'margin-right: {{SIZE}}{{UNIT}} !important; margin-left: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$element->add_responsive_control(
			'header_height',
			[
				'label'      => esc_html__( 'Height Header', 'fungi' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'condition'  => [ 'disable_header!' => 'yes' ],
				'selectors'  => [
					'{{WRAPPER}}' => '--theme-height-header: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$element->add_control(
			'header_absolute',
			[
				'label'     => esc_html__( 'Header Absolute', 'fungi' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					'' => esc_html__( 'Theme Setting', 'fungi' ),
					0  => esc_html__( 'No', 'fungi' ),
					1  => esc_html__( 'Yes', 'fungi' ),
				],
				'condition' => [
					'style_header!'   => '',
					'disable_header!' => 'yes',
				],
			]
		);
		$element->add_control(
			'header_sticky',
			[
				'label'     => esc_html__( 'Header Sticky', 'fungi' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					'' => esc_html__( 'Theme Setting', 'fungi' ),
					0  => esc_html__( 'No', 'fungi' ),
					1  => esc_html__( 'Yes', 'fungi' ),
				],
				'condition' => [
					'style_header!'   => '',
					'disable_header!' => 'yes',
				],
			]
		);

		$element->add_control(
			'header_image_enable',
			[
				'label'     => esc_html__( 'Header Image Sider Nav', 'fungi' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					'' => esc_html__( 'Theme Setting', 'fungi' ),
					0  => esc_html__( 'No', 'fungi' ),
					1  => esc_html__( 'Yes', 'fungi' ),
				],
			]
		);

		$element->add_control(
			'site_image_menu',
			[
				'label'     => esc_html__( 'Custom Image Menu (Only on Header Image Sider Nav)', 'fungi' ),
				'type'      => Controls_Manager::MEDIA,
			]
		);

		// $element->add_control(
		// 	'header_search_box',
		// 	[
		// 		'label'     => esc_html__( 'Search Box', 'fungi' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => '',
		// 		'options'   => [
		// 			'' => esc_html__( 'Theme Setting', 'fungi' ),
		// 			0  => esc_html__( 'Hide', 'fungi' ),
		// 			1  => esc_html__( 'Show', 'fungi' ),
		// 		],
		// 		'condition' => [
		// 			'style_header!'   => '',
		// 			'disable_header!' => 'yes',
		// 		],
		// 	]
		// );
		// $element->add_control(
		// 	'header_sidebar_toggler',
		// 	[
		// 		'label'     => esc_html__( 'Sidebar Toggler', 'fungi' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => '',
		// 		'options'   => [
		// 			'' => esc_html__( 'Theme Setting', 'fungi' ),
		// 			0  => esc_html__( 'Hide', 'fungi' ),
		// 			1  => esc_html__( 'Show', 'fungi' ),
		// 		],
		// 		'condition' => [
		// 			'style_header!'   => '',
		// 			'disable_header!' => 'yes',
		// 		],
		// 	]
		// );

		// $element->add_control(
		// 	'header_social_icon',
		// 	[
		// 		'label'     => esc_html__( 'Social', 'fungi' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => '',
		// 		'options'   => [
		// 			'' => esc_html__( 'Theme Setting', 'fungi' ),
		// 			0  => esc_html__( 'Hide', 'fungi' ),
		// 			1  => esc_html__( 'Show', 'fungi' ),
		// 		],
		// 		'condition' => [ 'disable_header!' => 'yes' ],
		// 	]
		// );

		// $element->add_control(
		// 	'header_custom_html_enable',
		// 	[
		// 		'label'     => esc_html__( 'Custom HTML', 'fungi' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => '',
		// 		'separator' => 'before',
		// 		'options'   => [
		// 			'' => esc_html__( 'Theme Setting', 'fungi' ),
		// 			0  => esc_html__( 'Hide', 'fungi' ),
		// 			1  => esc_html__( 'Show', 'fungi' ),
		// 		],
		// 		'condition' => [ 'disable_header!' => 'yes', ],
		// 	]
		// );

		// $element->add_control(
		// 	'header_custom_html',
		// 	[
		// 		'label'       => esc_html__( 'Enter Custom HTML', 'fungi' ),
		// 		'type'        => Controls_Manager::WYSIWYG,
		// 		'label_block' => true,
		// 		'condition'   => [
		// 			'header_custom_html_enable!' => '0',
		// 			'disable_header!'            => 'yes',
		// 		],
		// 	]
		// );

		// $element->add_control(
		// 	'header_phone_enable',
		// 	[
		// 		'label'     => esc_html__( 'Enable Phone', 'fungi' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => '',
		// 		'separator' => 'before',
		// 		'options'   => [
		// 			'' => esc_html__( 'Theme Setting', 'fungi' ),
		// 			0  => esc_html__( 'Hide', 'fungi' ),
		// 			1  => esc_html__( 'Show', 'fungi' ),
		// 		],
		// 		'condition' => [ 'disable_header!' => 'yes' ],
		// 	]
		// );

		// $element->add_control(
		// 	'header_phone',
		// 	[
		// 		'label'       => esc_html__( 'Enter Phone Number', 'fungi' ),
		// 		'type'        => Controls_Manager::TEXT,
		// 		'label_block' => true,
		// 		'condition'   => [
		// 			'header_phone_enable!' => '0',
		// 			'disable_header!'      => 'yes',
		// 		],
		// 	]
		// );

		// $element->add_control(
		// 	'header_email_enable',
		// 	[
		// 		'label'     => esc_html__( 'Enable Email', 'fungi' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => '',
		// 		'separator' => 'before',
		// 		'options'   => [
		// 			'' => esc_html__( 'Theme Setting', 'fungi' ),
		// 			0  => esc_html__( 'Hide', 'fungi' ),
		// 			1  => esc_html__( 'Show', 'fungi' ),
		// 		],
		// 		'condition' => [ 'disable_header!' => 'yes' ],
		// 	]
		// );

		// $element->add_control(
		// 	'header_email',
		// 	[
		// 		'label'       => esc_html__( 'Enter Email', 'fungi' ),
		// 		'type'        => Controls_Manager::TEXT,
		// 		'label_block' => true,
		// 		'condition'   => [
		// 			'header_email_enable!' => '0',
		// 			'disable_header!'      => 'yes',
		// 		],
		// 	]
		// );

		// $element->add_control(
		// 	'header_button_enable',
		// 	[
		// 		'label'     => esc_html__( 'Enable Button', 'fungi' ),
		// 		'type'      => Controls_Manager::SELECT,
		// 		'default'   => '',
		// 		'separator' => 'before',
		// 		'options'   => [
		// 			'' => esc_html__( 'Theme Setting', 'fungi' ),
		// 			0  => esc_html__( 'Hide', 'fungi' ),
		// 			1  => esc_html__( 'Show', 'fungi' ),
		// 		],
		// 		'condition' => [ 'disable_header!' => 'yes' ],
		// 	]
		// );

		// $element->add_control(
		// 	'header_button',
		// 	[
		// 		'label'       => esc_html__( 'Enter Button Text', 'fungi' ),
		// 		'type'        => Controls_Manager::TEXT,
		// 		'label_block' => true,
		// 		'condition'   => [
		// 			'header_button_enable!' => '0',
		// 			'disable_header!'       => 'yes',
		// 		],
		// 	]
		// );

		// $element->add_control(
		// 	'header_url_button',
		// 	[
		// 		'label'       => esc_html__( 'Enter Button Url', 'fungi' ),
		// 		'type'        => Controls_Manager::TEXT,
		// 		'label_block' => true,
		// 		'condition'   => [
		// 			'header_button_enable!' => '0',
		// 			'disable_header!'       => 'yes',
		// 		],
		// 	]
		// );

		$element->add_control(
			'header_backgroundcolor',
			[
				'label'     => esc_html__( 'Header Background', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} #header' => 'background: {{VALUE}};',
				],
				'condition' => [
					'style_header!'   => '',
					'disable_header!' => 'yes',
				],
			]
		);

		$element->add_control(
			'header_backgroundcolor_sticky',
			[
				'label'     => esc_html__( 'Header Background Sticky', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sticky-area-wrap.sticky .inner-header  ' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$element->add_control(
			'header_color_main_nav',
			[
				'label'     => esc_html__( 'Navigation Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--theme-color-main-navigation: {{VALUE}};',
				],
			]
		);

		$element->add_control(
			'header_color_hover_main_nav',
			[
				'label'     => esc_html__( 'Header Navigation Hover Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--theme-color-hover-main-navigation: {{VALUE}};',
				],
				'condition' => [
					'style_header!'   => '',
					'disable_header!' => 'yes',
				],
			]
		);

		$element->add_control(
			'header_sticky_color_main_nav',
			[
				'label'     => esc_html__( 'Header Sticky Navigation Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--theme-header-sticky-color-main-navigation: {{VALUE}};',
				],
			]
		);

		$element->add_control(
			'header_sticky_color_hover_main_nav',
			[
				'label'     => esc_html__( 'Header Sticky Navigation Hover Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => ' --theme-header-sticky-color-hover-main-navigation: {{VALUE}};',
				],
				'condition' => [
					'style_header!'   => '',
					'disable_header!' => 'yes',
				],
			]
		);

		//Extra Classes Header
		$element->add_control(
			'extra_classes_header',
			[
				'label'       => esc_html__( 'Extra Classes', 'fungi' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'condition'   => [ 'disable_header!' => 'yes' ],
			]
		);

		$element->end_controls_section();
	}

	public function themesflat_topbar_options_plus( $element ) {
		$element->add_control(
			'social_topbar_left',
			[
				'label'   => esc_html__( 'Social Left ( OFF | ON )', 'fungi' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Theme Setting', 'fungi' ),
					0  => esc_html__( 'Hide', 'fungi' ),
					1  => esc_html__( 'Show', 'fungi' ),
				],
			]
		);

		$element->add_control(
			'topbar_left_custom_html_enable',
			[
				'label'   => esc_html__( 'Custom HTML Left ( OFF | ON )', 'fungi' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Theme Setting', 'fungi' ),
					0  => esc_html__( 'Hide', 'fungi' ),
					1  => esc_html__( 'Show', 'fungi' ),
				],
			]
		);

		$element->add_control(
			'topbar_left_custom_html',
			[
				'label'       => esc_html__( 'Custom HTML Left', 'fungi' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$element->add_control(
			'social_topbar_right',
			[
				'label'   => esc_html__( 'Social Right ( OFF | ON )', 'fungi' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Theme Setting', 'fungi' ),
					0  => esc_html__( 'Hide', 'fungi' ),
					1  => esc_html__( 'Show', 'fungi' ),
				],
			]
		);

		$element->add_control(
			'topbar_right_custom_html_enable',
			[
				'label'   => esc_html__( 'Custom HTML Right ( OFF | ON )', 'fungi' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Theme Setting', 'fungi' ),
					0  => esc_html__( 'Hide', 'fungi' ),
					1  => esc_html__( 'Show', 'fungi' ),
				],
			]
		);

		$element->add_control(
			'topbar_right_custom_html',
			[
				'label'       => esc_html__( 'Custom HTML Right', 'fungi' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

	}

	public function themesflat_options_topbar( $element ) {
		$element->start_controls_section(
			'themesflat_topbar_options',
			[
				'label' => esc_html__( 'TF Topbar', 'fungi' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		$element->add_control(
			'h_options_topbar',
			[
				'label'     => esc_html__( 'Topbar', 'fungi' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$element->add_control(
			'topbar_enabled',
			[
				'label'   => esc_html__( 'Enable Topbar', 'fungi' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Theme Setting', 'fungi' ),
					0  => esc_html__( 'Hide', 'fungi' ),
					1  => esc_html__( 'Show', 'fungi' ),
				],
			]
		);

		$element->add_responsive_control(
			'topbar_padding',
			[
				'label'              => esc_html__( 'Padding', 'fungi' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'allowed_dimensions' => [ 'top', 'bottom' ],
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .themesflat-top .container-inside' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$element->add_control(
			'topbar_background_color',
			[
				'label'     => esc_html__( 'Background', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themesflat-top' => 'background: {{VALUE}};',
				],
			]
		);
		$element->add_control(
			'topbar_textcolor',
			[
				'label'     => esc_html__( 'Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themesflat-top' => 'color: {{VALUE}};',
				],
			]
		);
		$element->add_control(
			'topbar_link_color',
			[
				'label'     => esc_html__( 'Link Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themesflat-top a' => 'color: {{VALUE}};',
				],
			]
		);
		$element->add_control(
			'topbar_link_color_hover',
			[
				'label'     => esc_html__( 'Link Hover Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themesflat-top a:hover'                                   => 'color: {{VALUE}};',
					'{{WRAPPER}}.header-04 .themesflat-top ul.flat-information li > i'      => 'color: {{VALUE}};',
					'{{WRAPPER}}.header-default .themesflat-top ul.flat-information li > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themesflat-top .wrap-btn-topbar .btn-topbar:before'       => 'background-color: {{VALUE}};',
				],
			]
		);
		$element->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'topbar_typography',
				'label'    => esc_html__( 'Typography', 'fungi' ),
				'selector' => '{{WRAPPER}} .themesflat-top',
			]
		);

		$this->themesflat_topbar_options_plus( $element );

		$element->end_controls_section();
	}

	public function themesflat_options_page_pagetitle( $element ) {
		// TF Page Title
		$element->start_controls_section(
			'themesflat_pagetitle_options',
			[
				'label' => esc_html__( 'TF Page Title', 'fungi' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		$element->add_control(
			'hide_pagetitle',
			[
				'label'     => esc_html__( 'Hide Page Title', 'fungi' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'block',
				'options'   => [
					'none'  => esc_html__( 'Yes', 'fungi' ),
					'block' => esc_html__( 'No', 'fungi' ),
				],
				'selectors' => [
					'{{WRAPPER}} .page-title' => 'display: {{VALUE}};',
				],
			]
		);

		$element->add_responsive_control(
			'pagetitle_padding',
			[
				'label'              => esc_html__( 'Padding', 'fungi' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%', 'em' ],
				'allowed_dimensions' => [ 'top', 'bottom' ],
				'selectors'          => [
					'{{WRAPPER}} .page-title' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
				],
				'condition'          => [ 'hide_pagetitle' => 'block' ]
			]
		);

		$element->add_responsive_control(
			'pagetitle_margin',
			[
				'label'              => esc_html__( 'Margin', 'fungi' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%', 'em' ],
				'allowed_dimensions' => [ 'top', 'bottom' ],
				'selectors'          => [
					'{{WRAPPER}} .page-title' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
				'condition'          => [ 'hide_pagetitle' => 'block' ]
			]
		);

		$element->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'pagetitle_bg',
				'label'     => esc_html__( 'Background', 'fungi' ),
				'types'     => [ 'classic', 'gradient', 'video' ],
				'selector'  => '{{WRAPPER}} .page-title',
				'condition' => [ 'hide_pagetitle' => 'block' ]
			]
		);

		$element->add_control(
			'pagetitle_overlay_color',
			[
				'label'     => esc_html__( 'Overlay Color', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .page-title .overlay' => 'background: {{VALUE}}; opacity: 100%;filter: alpha(opacity=100);',
				],
				'condition' => [ 'hide_pagetitle' => 'block' ]
			]
		);

		//Extra Classes Page Title
		$element->add_control(
			'extra_classes_pagetitle',
			[
				'label'       => esc_html__( 'Extra Classes', 'fungi' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before'
			]
		);

		$element->end_controls_section();
	}

	public function themesflat_options_page( $element ) {
		$post_id   = $element->get_id();
		$post_type = get_post_type( $post_id );

		// TF Page
		$element->start_controls_section(
			'themesflat_page_options',
			[
				'label' => esc_html__( 'TF Page', 'fungi' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		if ( ( $post_type !== 'post' ) && ( $post_type !== 'portfolios' ) && ( $post_type !== 'services' ) && ( $post_type !== 'doctor' ) ) {
			$element->add_control(
				'page_sidebar_layout',
				[
					'label'   => esc_html__( 'Sidebar Position', 'fungi' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						''                 => esc_html__( 'No Sidebar', 'fungi' ),
						'sidebar-right'    => esc_html__( 'Sidebar Right', 'fungi' ),
						'sidebar-left'     => esc_html__( 'Sidebar Left', 'fungi' ),
						'fullwidth'        => esc_html__( 'Full Width', 'fungi' ),
						'fullwidth-small'  => esc_html__( 'Full Width Small', 'fungi' ),
						'fullwidth-center' => esc_html__( 'Full Width Center', 'fungi' ),
					],
				]
			);
		}

		$element->add_control(
			'one_page_enable',
			[
				'label'        => esc_html__( 'One Page', 'fungi' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'On', 'fungi' ),
				'label_off'    => esc_html__( 'Off', 'fungi' ),
				'return_value' => 'yes',
			]
		);

		$element->add_control(
			'select_page_menu',
			[
				'label'   => esc_html__( 'Choose Menu', 'fungi' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => $this->getMenus(),
			]
		);

		$element->add_control(
			'main_content_background',
			[
				'label'     => esc_html__( 'Background', 'fungi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themesflat-boxed' => 'background: {{VALUE}};',
				],
			]
		);

		$element->add_control(
			'main_content_heading',
			[
				'label'     => esc_html__( 'Main Content', 'fungi' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$element->add_responsive_control(
			'main_content_padding',
			[
				'label'              => esc_html__( 'Padding', 'fungi' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%', 'em' ],
				'allowed_dimensions' => [ 'top', 'bottom' ],
				'selectors'          => [
					'{{WRAPPER}} #themesflat-content' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

		$element->add_responsive_control(
			'main_content_margin',
			[
				'label'              => esc_html__( 'Margin', 'fungi' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%', 'em' ],
				'allowed_dimensions' => [ 'top', 'bottom' ],
				'selectors'          => [
					'{{WRAPPER}} #themesflat-content' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

		$element->end_controls_section();
	}

	public function themesflat_options_services( $element ) {
		// TF Services
		$element->start_controls_section(
			'themesflat_services_options',
			[
				'label' => esc_html__( 'TF Services', 'fungi' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		$element->add_control(
			'services_post_heading',
			[
				'label' => esc_html__( 'Services Post', 'fungi' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$element->add_control(
			'services_post_icon',
			[
				'label'   => esc_html__( 'Post Icon', 'fungi' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => '',
					'library' => '',
				],
			]
		);

		$element->end_controls_section();
	}

	public function getMenus() {
		$user_menus = get_categories( array(
			'taxonomy'   => 'nav_menu',
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC'
		) );
		$menus      = array(
			'' => esc_html__( 'Default', 'fungi' ),
		);
		foreach ( $user_menus as $menu ) {
			$menus[ $menu->term_id ] = $menu->name;
		}

		return $menus;
	}
}

new themesflat_options_elementor();