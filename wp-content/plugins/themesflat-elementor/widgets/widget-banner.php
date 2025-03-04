<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

class TFBanner_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tfbanner';
	}

	public function get_title() {
		return esc_html__( 'TF Banner', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-image';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}


	protected function register_controls() {
		$this->start_controls_section( 'banner_layout_content_section', [
			'label' => esc_html__( 'Layout Options', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'banner_layout',
			[
				'label'       => esc_html__( 'Layout', 'themesflat-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'layout-01',
				'label_block' => false,
				'options'     => [
					'layout-01' => esc_html__( 'Layout 01', 'themesflat-elementor' ),
					'layout-02' => esc_html__( 'Layout 02', 'themesflat-elementor' ),
					'layout-03' => esc_html__( 'Layout 03', 'themesflat-elementor' ),
					'layout-04' => esc_html__( 'Layout 04', 'themesflat-elementor' ),
					'layout-05' => esc_html__( 'Layout 05', 'themesflat-elementor' ),
					'layout-06' => esc_html__( 'Layout 06', 'themesflat-elementor' ),
					'layout-07' => esc_html__( 'Layout 07', 'themesflat-elementor' ),
				],
			]
		);

		$this->add_control(
			'banner_layout_hover_effect',
			[
				'label'       => esc_html__( 'Hover Effect', 'themesflat-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'label_block' => false,
				'options'     => [
					''         => esc_html__( 'None', 'themesflat-elementor' ),
					'symmetry' => esc_html__( 'Symmetry', 'themesflat-elementor' ),
					'suprema'  => esc_html__( 'Suprema', 'themesflat-elementor' ),
					'layla'    => esc_html__( 'Layla', 'themesflat-elementor' ),
					'bubba'    => esc_html__( 'Bubba', 'themesflat-elementor' ),
					'jazz'     => esc_html__( 'Jazz', 'themesflat-elementor' ),
					'flash'    => esc_html__( 'Flash', 'themesflat-elementor' ),
					'ming'     => esc_html__( 'Ming', 'themesflat-elementor' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'banner_image_content_section', [
			'label' => esc_html__( 'Image', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'banner_image',
			[
				'label'   => esc_html__( 'Choose Image', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control( 'banner_size_mode', [
			'label'   => esc_html__( 'Size Mode', 'themesflat-elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'original'      => esc_html__( 'Original', 'themesflat-elementor' ),
				'100'           => '1:1',
				'133.333333333' => '4:3',
				'75'            => '3:4',
				'177.777777778' => '16:9',
				'56.25'         => '9:16',
				'custom'        => esc_html__( 'Custom', 'themesflat-elementor' ),
				'custom-height' => esc_html__( 'Custom Height', 'themesflat-elementor' ),
			],
			'default' => 'original',
		] );

		$this->add_responsive_control(
			'banner_size_width',
			[
				'label'     => esc_html__( 'Custom Width', 'themesflat-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'condition' => [
					'banner_size_mode' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .tf-banner-bg ' => '--tf-banner-custom-width: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'banner_size_height',
			[
				'label'     => esc_html__( 'Custom Height', 'themesflat-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'condition' => [
					'banner_size_mode' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .tf-banner-bg ' => 'padding-bottom:calc(({{VALUE}}/var(--tf-banner-custom-width))*100%)',
				],
			]
		);

		$this->add_responsive_control(
			'banner_size_custom_height',
			[
				'label'     => esc_html__( 'Custom Height', 'themesflat-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 400,
				'min'       => 1,
				'condition' => [
					'banner_size_mode' => 'custom-height',
				],
				'selectors' => [
					'{{WRAPPER}} .tf-banner-bg ' => 'height: {{VALUE}}px',
				],
			]
		);

		$this->add_control(
			'banner_layout_hover_img',
			[
				'label'       => esc_html__( 'Hover Image Effect', 'themesflat-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'label_block' => false,
				'options'     => [
					''             => esc_html__( 'None', 'themesflat-elementor' ),
					'zoom-in'      => esc_html__( 'Zoom In', 'themesflat-elementor' ),
					'zoom-out'     => esc_html__( 'Zoom Out', 'themesflat-elementor' ),
					'slide-left'   => esc_html__( 'Slide Left', 'themesflat-elementor' ),
					'slide-right'  => esc_html__( 'Slide Right', 'themesflat-elementor' ),
					'slide-top'    => esc_html__( 'Slide Top', 'themesflat-elementor' ),
					'slide-bottom' => esc_html__( 'Slide Bottom', 'themesflat-elementor' ),
					'rotate'       => esc_html__( 'Rotate', 'themesflat-elementor' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'banner_content_content_section', [
			'label' => esc_html__( 'Content', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'banner_title', [
			'label'   => esc_html__( 'Title', 'themesflat-elementor' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Title on the Banner', 'themesflat-elementor' ),
		] );

		$this->add_control(
			'banner_title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'h1'   => esc_html__( 'H1', 'themesflat-elementor' ),
					'h2'   => esc_html__( 'H2', 'themesflat-elementor' ),
					'h3'   => esc_html__( 'H3', 'themesflat-elementor' ),
					'h4'   => esc_html__( 'H4', 'themesflat-elementor' ),
					'h5'   => esc_html__( 'H5', 'themesflat-elementor' ),
					'h6'   => esc_html__( 'H6', 'themesflat-elementor' ),
					'span' => esc_html__( 'Span', 'themesflat-elementor' ),
					'p'    => esc_html__( 'P', 'themesflat-elementor' ),
					'div'  => esc_html__( 'Div', 'themesflat-elementor' ),
				],
			]
		);

		$this->add_control( 'banner_description', [
			'label'   => esc_html__( 'Description', 'themesflat-elementor' ),
			'default' => esc_html__( 'Description on the Banner', 'themesflat-elementor' ),
			'type'    => Controls_Manager::WYSIWYG,
		] );

		$this->add_control( 'banner_link', [
			'label' => esc_html__( 'Link', 'themesflat-elementor' ),
			'type'  => Controls_Manager::URL,
		] );

		$this->add_control(
			'banner_always_show',
			[
				'label'        => esc_html__( 'Always show', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'separator'    => 'before',
				'description'  => esc_html__( 'Always display full information', 'themesflat-elementor' ),
				'conditions'   => [
					'terms' => [
						[
							'name'     => 'banner_layout',
							'operator' => 'in',
							'value'    => [
								'layout-04',
								'layout-05',
								'layout-06',
								'layout-07',
							],
						],
					]
				]
			]
		);
		$this->add_control(
			'banner_enable_label',
			[
				'label'        => esc_html__( 'Show Label', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
			]
		);
		$this->add_control( 'banner_label', [
			'label'   => esc_html__( 'Label', 'themesflat-elementor' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'New', 'themesflat-elementor' ),
			'condition'  => [
				'banner_enable_label' => 'yes',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'banner_btn_content_section', [
			'label' => esc_html__( 'Button', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'banner_enable_button',
			[
				'label'        => esc_html__( 'Show Button', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'banner_button_fixed',
			[
				'label'        => esc_html__( 'Button Fixed Below', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',

				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'banner_layout',
							'operator' => '==',
							'value'    => 'layout-02'
						],
						[
							'name'     => 'banner_enable_button',
							'operator' => '==',
							'value'    => 'yes'
						]
					]
				]

			]
		);

		$this->add_control( 'banner_text_button', [
			'label'     => esc_html__( 'Text Button', 'themesflat-elementor' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => esc_html__( 'Read Mode', 'themesflat-elementor' ),
			'condition' => [
				'banner_enable_button' => 'yes',
			],
		] );

		$this->add_control(
			'banner_button_icon',
			[
				'label'     => esc_html__( 'Icon', 'themesflat-elementor' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => [
					'banner_enable_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'banner_button_icon_align',
			[
				'label'     => esc_html__( 'Icon Position', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'before',
				'options'   => [
					'before' => esc_html__( 'Before', 'themesflat-elementor' ),
					'after'  => esc_html__( 'After', 'themesflat-elementor' ),
				],
				'condition' => [
					'banner_button_icon[value]!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'banner_wrapper_style_section', [
			'label' => esc_html__( 'Wrapper', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control(
			'banner_text_align',
			[
				'label'        => esc_html__( 'Content Align', 'themesflat-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'   => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
				'separator'    => 'after',
				'conditions'   => [
					'terms' => [
						[
							'name'     => 'banner_layout',
							'operator' => '!in',
							'value'    => [
								'layout-07',
								'layout-05',
							],
						],
					]
				]
			]
		);


		$this->add_control(
			'banner_heading_bg_overlay',
			[
				'label' => esc_html__( 'Background overlay', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'banner_overlay_tabs' );

		$this->start_controls_tab( 'banner_overlay_normal_tab', [
			'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'banner_bg_overlay',
			'selector' => '{{WRAPPER}} .tf-banner:after',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'banner_overlay_hover_tab', [
			'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'banner_hover_bg_overlay',
			'selector' => '{{WRAPPER}} .tf-banner:hover:after',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'banner_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'banner_layout!' => 'layout-04',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control( 'banner_content_show', [
			'label'      => esc_html__( 'Top Show', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', 'em' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .tf-banner-content' => 'top: calc(100% - {{SIZE}}{{UNIT}})',
			],
			'condition'  => [
				'banner_layout' => 'layout-04',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'banner_title_style_section', [
			'label'     => esc_html__( 'Title', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'banner_title!' => '',
			],
		] );

		$this->add_control(
			'banner_title_text_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-banner-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'banner_title_typography',
				'selector' => '{{WRAPPER}} .tf-banner-title',
			]
		);

		$this->add_responsive_control(
			'banner_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-banner-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'banner_desc_style_section', [
			'label'     => esc_html__( 'Description', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'banner_description!' => '',
			],
		] );

		$this->add_control(
			'banner_desc_text_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-banner-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'banner_desc_typography',
				'selector' => '{{WRAPPER}} .tf-banner-description',
			]
		);

		$this->add_responsive_control(
			'banner_desc_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-banner-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'banner_button_style_section', [
			'label'     => esc_html__( 'Button', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'banner_enable_button' => 'yes',
			],
		] );

		$this->add_responsive_control(
			'banner_button_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tf-banner-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'banner_button_typography',
				'selector' => '{{WRAPPER}} .tf-banner-btn',
			]
		);

		$this->start_controls_tabs( 'banner_button_tabs' );

		$this->start_controls_tab( 'banner_button_normal_tab', [
			'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
		] );

		$this->add_control(
			'banner_button_text_color',
			[
				'label'     => esc_html__( 'Button Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-banner-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'banner_button_border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-banner-btn',
			]
		);


		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'banner_button_background',
			'selector' => '{{WRAPPER}} .tf-banner-btn',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'banner_button_hover_tab', [
			'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
		] );

		$this->add_control(
			'banner_button_text_color_hover',
			[
				'label'     => esc_html__( 'Button Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-banner-btn:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'banner_button_border_hover',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-banner-btn:hover',
			]
		);

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'banner_button_background_hover',
			'selector' => '{{WRAPPER}} .tf-banner-btn:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'banner_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-banner-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'banner_button_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-banner-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 'banner_button_icon_spacing', [
			'label'      => esc_html__( 'Spacing Icon', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', 'em' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .tf-banner-btn.icon-before > i,{{WRAPPER}} .tf-banner-btn.icon-before > svg' => 'margin-right : {{SIZE}}{{UNIT}}',
				'{{WRAPPER}} .tf-banner-btn.icon-after > i , {{WRAPPER}} .tf-banner-btn.icon-after > svg' => 'margin-left : {{SIZE}}{{UNIT}}'
			],
			'condition'  => [
				'banner_button_icon[value]!' => '',
			],
		] );

		$this->end_controls_section();
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$banner_classes = array(
			'tf-banner',
			'tf-banner-' . $settings['banner_layout'],
		);

		if ( $settings['banner_layout_hover_effect'] !== '' ) {
			$banner_classes[] = 'tf-banner-has-effect';
			$banner_classes[] = 'tf-banner-effect-' . $settings['banner_layout_hover_effect'];
		}

		if ( $settings['banner_always_show'] == 'yes' ) {
			$banner_classes[] = 'tf-banner-show-all';
		}
		if ( $settings['banner_button_fixed'] == 'yes' ) {
			$banner_classes[] = 'tf-banner-btn-fixed';
		}

		if ( $settings['banner_layout_hover_img'] !== '' ) {
			$banner_classes[] = 'tf-banner-effect-img-' . $settings['banner_layout_hover_img'];
		}

		$this->add_render_attribute( 'banner_attr', 'class', $banner_classes );

		if ( ! empty( $settings['banner_link']['url'] ) ) {
			$this->add_link_attributes( 'banner_link_attr', $settings['banner_link'] );
			$this->add_link_attributes( 'btn_attr', $settings['banner_link'] );
		} else {
			$settings['banner_link']['url'] = '#';
			$this->add_link_attributes( 'btn_attr', $settings['banner_link'] );
		}

		$btn_class = array(
			'btn',
			'tf-banner-btn',
		);

		if ( $settings['banner_button_icon_align'] !== '' && ! empty( $settings['banner_button_icon']['value'] ) ) {
			$btn_class[] = "icon-{$settings['banner_button_icon_align']}";
		}

		$this->add_render_attribute( 'btn_attr', 'class', $btn_class );

		$this->add_render_attribute( 'banner_title_attr', 'class', 'tf-banner-title' );

		$tag_title_html = $settings['banner_title_tag'];

		if ( $settings['banner_image']['url'] !== '' ) {
			$bg_style  = array();
			$pd_bottom = 66.6666666;

			if ( $settings['banner_image']['id'] !== '' ) {
				$media_image = wp_get_attachment_image_src( $settings['banner_image']['id'], 'full' );
				$pd_bottom   = ( $media_image[2] / $media_image[1] ) * 100;
			}

			if ( $settings['banner_size_mode'] !== 'custom' && $settings['banner_size_mode'] !== 'original' ) {
				$pd_bottom = $settings['banner_size_mode'];
			}

			if ( $settings['banner_size_mode'] !== 'custom-height' && $settings['banner_size_mode'] !== 'custom' ) {
				$bg_style[] = "padding-bottom:{$pd_bottom}%";
			}

			$bg_style[] = "background-image : url({$settings['banner_image']['url']})";

			$this->add_render_attribute( 'bg_attr', array(
				'class' => 'tf-banner-bg',
				'style' => join( ";", $bg_style ),
			) );
		}

		?>
		<?php if ( $settings['banner_image']['url'] !== '' ): ?>
        <div class="tf-banner-wrapper">
	        <?php if ( $settings['banner_enable_label'] == 'yes' ): ?>
                <span class="banner-label"><?php echo esc_html( $settings['banner_label'] ) ?></span>
	        <?php endif; ?>
            <div <?php echo $this->get_render_attribute_string( 'banner_attr' ) ?>>
                <div class="tf-banner-image">
			        <?php if ( $settings['banner_title'] === '' && $settings['banner_link']['url'] !== '' && $settings['banner_enable_button'] === '' ): ?>
                        <a <?php echo $this->get_render_attribute_string( 'banner_link_attr' ) ?>>
                        </a>
			        <?php endif; ?>
                    <div <?php echo $this->get_render_attribute_string( 'bg_attr' ) ?>>
                    </div>
                </div>
                <div class="tf-banner-content">
			        <?php if ( $settings['banner_layout'] == 'layout-02' && $settings['banner_button_fixed'] == 'yes' ) {
				        echo ' <div class="tf-banner-top-box">';
			        }
			        ?>
			        <?php if ( $settings['banner_title'] !== '' ):
				        printf( '<%1$s %2$s>', $tag_title_html, $this->get_render_attribute_string( 'banner_title_attr' ) );
				        if ( $settings['banner_link']['url'] !== '' ): ?>
                            <a <?php echo $this->get_render_attribute_string( 'banner_link_attr' ) ?>>
						        <?php echo wp_kses_post( $settings['banner_title'] ); ?>
                            </a>
				        <?php else: echo wp_kses_post( $settings['banner_title'] );
				        endif;
				        printf( '</%1$s>', $tag_title_html );
			        endif; ?>
			        <?php if ( $settings['banner_layout'] == 'layout-06' || $settings['banner_layout'] == 'layout-04' || $settings['banner_layout'] == 'layout-07' ) {
				        echo ' <div class="tf-banner-bottom-box">';
			        }
			        ?>
			        <?php if ( $settings['banner_description'] !== '' ): ?>
                        <div class="tf-banner-description">
					        <?php echo wp_kses_post( $settings['banner_description'] ); ?>
                        </div>
			        <?php endif; ?>
			        <?php if ( $settings['banner_layout'] == 'layout-02' && $settings['banner_button_fixed'] == 'yes' ) {
				        echo ' </div>';
			        }
			        ?>
			        <?php if ( $settings['banner_enable_button'] === 'yes' ): ?>
				        <?php if ( ! empty( $settings['banner_button_icon']['value'] ) || $settings['banner_text_button'] !== '' ): ?>
                            <a <?php echo $this->get_render_attribute_string( 'btn_attr' ) ?>>
						        <?php if ( ! empty( $settings['banner_button_icon'] ) && ! empty( $settings['banner_button_icon']['value'] ) && ( $settings['banner_button_icon_align'] === 'before' ) ): ?>
							        <?php Icons_Manager::render_icon( $settings['banner_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						        <?php endif; ?>
						        <?php echo esc_html( $settings['banner_text_button'] ) ?>
						        <?php if ( ! empty( $settings['banner_button_icon'] ) && ! empty( $settings['banner_button_icon']['value'] ) && ( $settings['banner_button_icon_align'] === 'after' ) ): ?>
							        <?php Icons_Manager::render_icon( $settings['banner_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						        <?php endif; ?>
                            </a>
				        <?php endif; ?>
			        <?php endif; ?>
			        <?php if ( $settings['banner_layout'] == 'layout-06' || $settings['banner_layout'] == 'layout-04' || $settings['banner_layout'] == 'layout-07' ) {
				        echo ' </div>';
			        }
			        ?>
                </div>
            </div>
        </div>

		<?php endif;
	}

}