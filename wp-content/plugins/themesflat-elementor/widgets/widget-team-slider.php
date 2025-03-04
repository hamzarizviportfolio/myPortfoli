<?php

use Elementor\Controls_Manager;

class TFTeamSlider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-team-slider';
	}

	public function get_title() {
		return esc_html__( 'TF Team Slider', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	public function get_style_depends() {
		return [ 'tf-team' ];
	}

	public function get_script_depends() {
		return [ 'tf-team-member' ];
	}

	protected function register_controls() {
		$this->setting();
		$this->register_carousel();
		$this->general_style();
		$this->image_style();
		$this->content_style();
		$this->title_style();
		$this->social_style();
		$this->register_style_carousel();
	}

	protected function setting() {
		// Start Tab Setting
		$this->start_controls_section( 'section_tabs',
			[
				'label' => esc_html__( 'Setting', 'themesflat-elementor' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . "assets/img/default-team.jpg",
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Watson Mendela', 'themesflat-elementor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'link_facebook',
			[
				'label'       => esc_html__( 'Facebook Url', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'default'     => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'themesflat-elementor' ),
			]
		);
		$repeater->add_control(
			'link_insta',
			[
				'label'       => esc_html__( 'Instagram Url', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'default'     => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'themesflat-elementor' ),
			]
		);
		$repeater->add_control(
			'link_dribble',
			[
				'label'       => esc_html__( 'Dribble Url', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'default'     => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'team_list',
			[
				'label'   => esc_html__( 'Team Member List', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Mrs.Rokmini Moniam',
					],
					[
						'title' => 'Kelly Coleman',
					],
					[
						'title' => 'Philip Mendez',
					],
				],
			]
		);

		$this->end_controls_section();
		// /.End Social Icons
	}

	protected function register_carousel() {

		// Start Carousel
		$this->start_controls_section(
			'section_posts_carousel',
			[
				'label' => esc_html__( 'Carousel', 'themesflat-elementor' ),
			]
		);
		$this->add_responsive_control(
			'layout',
			[
				'label'   => esc_html__( 'Columns', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => esc_html__( '1', 'themesflat-elementor' ),
					2 => esc_html__( '2', 'themesflat-elementor' ),
					3 => esc_html__( '3', 'themesflat-elementor' ),
					4 => esc_html__( '4', 'themesflat-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'navigation_arrow',
			[
				'label'   => esc_html__( 'Navigation Arrow', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'off' => esc_html__( 'Hide', 'themesflat-elementor' ),
					'on'  => esc_html__( 'Show', 'themesflat-elementor' ),

				],
				'default' => 'off',
			]
		);

		$this->add_responsive_control(
			'navigation_dots',
			[
				'label'   => esc_html__( 'Navigation Dots', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'off' => esc_html__( 'Hide', 'themesflat-elementor' ),
					'on'  => esc_html__( 'Show', 'themesflat-elementor' ),

				],
				'default' => 'on',
			]
		);

		$this->add_control(
			'center_mode',
			[
				'label'        => esc_html__( 'Center Mode', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Disable', 'themesflat-elementor' ),
				'return_value' => 'on',
				'default'      => '',
			]
		);
		$this->add_responsive_control(
			'center_padding',
			[
				'label'       => esc_html__( 'Center Padding', 'themesflat-elementor' ),
				'description' => esc_html__( 'Side padding when in center mode (px/%)', 'themesflat-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '50px',
				'conditions'  => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'center_mode',
							'operator' => '==',
							'value'    => 'on'
						],
						[
							'name'     => 'carousel',
							'operator' => '==',
							'value'    => 'yes'
						],
					]
				],
			]
		);

		$this->add_control(
			'autoplay_enable',
			[
				'label'        => esc_html__( 'Autoplay Slides', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Disable', 'themesflat-elementor' ),
				'return_value' => 'on',
				'default'      => '',
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label'      => esc_html__( 'Autoplay Speed', 'themesflat-elementor' ),
				'type'       => Controls_Manager::NUMBER,
				'step'       => 500,
				'default'    => 5000,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'autoplay_enable',
							'operator' => '==',
							'value'    => 'on'
						],
						[
							'name'     => 'carousel',
							'operator' => '==',
							'value'    => 'yes'
						],
					]
				],
			]
		);
		$this->add_control(
			'loop',
			[
				'label'        => esc_html__( 'Loop', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Disable', 'themesflat-elementor' ),
				'return_value' => 'on',
				'default'      => '',
			]
		);


		$this->add_control(
			'grid_mode',
			[
				'label'        => esc_html__( 'Enabled Grid Mode', 'themesflat-elementor'  ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'themesflat-elementor'  ),
				'label_off'    => esc_html__( 'Disable', 'themesflat-elementor'  ),
				'return_value' => 'on',
				'default'      => '',
			]
		);

		$this->add_responsive_control(
			'slide_rows',
			[
				'label'      => esc_html__( 'Slide Rows', 'themesflat-elementor'  ),
				'type'       => Controls_Manager::NUMBER,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'grid_mode',
							'operator' => '==',
							'value'    => 'on'
						],
						[
							'name'     => 'carousel',
							'operator' => '==',
							'value'    => 'yes'
						],
					]
				],
				'default'    => 2
			]
		);

		$this->add_responsive_control( 'slides_per_row', [
			'label'      => esc_html__( 'Slides Per Row', 'themesflat-elementor'  ),
			'type'       => Controls_Manager::NUMBER,
			'min'        => 1,
			'max'        => 12,
			'step'       => 1,
			'default'    => 1,
			'conditions' => [
				'relation' => 'and',
				'terms'    => [
					[
						'name'     => 'grid_mode',
						'operator' => '==',
						'value'    => 'on'
					],
					[
						'name'     => 'carousel',
						'operator' => '==',
						'value'    => 'yes'
					],
				]
			],
		] );
		$this->end_controls_section();
	}

	protected function general_style() {
		// Start Style Default
		$this->start_controls_section( 'general_style',
			[
				'label' => esc_html__( 'General', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'align',
			[
				'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
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
				'default'   => '',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .tf-team' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function image_style() {
		// Start Style Default
		$this->start_controls_section( 'image_style',
			[
				'label' => esc_html__( 'Image', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'hover_image_animation',
			[
				'label'   => esc_html__( 'Hover Image Effect', 'themesflat-elementor'  ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''             => esc_html__( 'Choose Animation', 'themesflat-elementor'  ),
					'gray-scale' => esc_html__( 'Gray Scale', 'themesflat-elementor'  ),
					'opacity'    => esc_html__( 'Opacity', 'themesflat-elementor'  ),
					'shine'      => esc_html__( 'Shine', 'themesflat-elementor'  ),
					'circle'     => esc_html__( 'Circle', 'themesflat-elementor'  ),
					'flash'      => esc_html__( 'Flash', 'themesflat-elementor'  ),
					'zoom-in'      => esc_html__( 'Zoom In', 'themesflat-elementor'  ),
					'zoom-out'     => esc_html__( 'Zoom Out', 'themesflat-elementor'  ),
					'rotate'       => esc_html__( 'Rotate', 'themesflat-elementor'  ),
					'slide-left'   => esc_html__( 'Slide Left', 'themesflat-elementor'  ),
					'slide-right'  => esc_html__( 'Slide Right', 'themesflat-elementor'  ),
					'slide-top'    => esc_html__( 'Slide Top', 'themesflat-elementor'  ),
					'slide-bottom' => esc_html__( 'Slide Bottom', 'themesflat-elementor'  ),
				]
			]
		);
		$this->add_responsive_control(
			'image_width',
			[
				'label'      => esc_html__( 'Width', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-team .image-team img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => esc_html__( 'Height', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-team .image-team img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius_image',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-team .image-team, {{WRAPPER}} .tf-team .image-team img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function content_style() {
		// Start Style Default
		$this->start_controls_section( 'content_style',
			[
				'label' => esc_html__( 'Content', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_content',
			[
				'label'     => esc_html__( 'Backround', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-team .content' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-team .content',
			]
		);
		$this->add_control(
			'border_radius_content',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-team .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'padding_content',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-team .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function title_style() {
		// Start Style Default
		$this->start_controls_section( 'title_style',
			[
				'label' => esc_html__( 'Title', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_title',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-team .title',
			]
		);
		$this->add_control(
			'color_title',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-team .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'padding_title',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-team .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function social_style() {
		$this->start_controls_section( 'social_style',
			[
				'label' => esc_html__( 'Social', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'color_social',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-team .social a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'bgcolor_social',
			[
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-team .social a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_social_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-team .social a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'bgcolor_social_hover',
			[
				'label'     => esc_html__( 'Background Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-team .social a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'social_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-team .social > a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_carousel() {
		// Start Style
		$this->start_controls_section( 'section_carousel_style',
			[
				'label' => esc_html__( 'Carousel', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'dots_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Dots Color', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .slick-dots li span' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'dots_color_active',
			[
				'label' => esc_html__( 'Dots Color Active', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .slick-dots li.slick-active span' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_responsive_control(
			'dots_offset',
			[
				'label'              => esc_html__( 'Offset', 'themesflat-elementor' ),
				'type'               => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%' ],
				'allowed_dimensions' => [ 'top', 'right' ],
				'default'            => [
					'right'    => '',
					'left'     => '',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'          => [
					'{{WRAPPER}} .slick-dots' => 'top: {{TOP}}{{UNIT}}; right:{{RIGHT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// /.End Style
	}

	protected function render( $instance = [] ) {
		$settings       = $this->get_settings_for_display();
		$slides_to_show = empty( $settings['layout'] ) ? 1 : $settings['layout'];
		if ( isset( $settings['layout_tablet'] ) && $settings['layout_tablet'] != '' ) {
			$slides_to_show_tablet = $settings['layout_tablet'];
		} else {
			$slides_to_show_tablet = $slides_to_show;
		}
		if ( isset( $settings['layout_mobile'] ) && $settings['layout_mobile'] != '' ) {
			$slides_to_show_mobile = $settings['layout_mobile'];
		} else {
			$slides_to_show_mobile = $slides_to_show_tablet;
		}

		$navigation_arrow = $settings['navigation_arrow'];

		if ( isset( $settings['navigation_arrow_tablet'] ) && $settings['navigation_arrow_tablet'] != '' ) {
			$navigation_arrow_tablet = $settings['navigation_arrow_tablet'];
		} else {
			$navigation_arrow_tablet = $navigation_arrow;
		}
		if ( isset( $settings['navigation_arrow_mobile'] ) && $settings['navigation_arrow_mobile'] != '' ) {
			$navigation_arrow_mobile = $settings['navigation_arrow_mobile'];
		} else {
			$navigation_arrow_mobile = $navigation_arrow_tablet;
		}


		$navigation_dots = $settings['navigation_dots'];
		if ( isset( $settings['navigation_dots_tablet'] ) && $settings['navigation_dots_tablet'] != '' ) {
			$navigation_dots_tablet = $settings['navigation_dots_tablet'];
		} else {
			$navigation_dots_tablet = $navigation_dots;
		}
		if ( isset( $settings['navigation_dots_mobile'] ) && $settings['navigation_dots_mobile'] != '' ) {
			$navigation_dots_mobile = $settings['navigation_dots_mobile'];
		} else {
			$navigation_dots_mobile = $navigation_dots_tablet;
		}

		$center_padding = $settings['center_padding'];
		if ( isset( $settings['center_padding_tablet'] ) && $settings['center_padding_tablet'] != '' ) {
			$center_padding_tablet = $settings['center_padding_tablet'];
		} else {
			$center_padding_tablet = $center_padding;
		}
		if ( isset( $settings['center_padding_mobile'] ) && $settings['center_padding_mobile'] != '' ) {
			$center_padding_mobile = $settings['center_padding_mobile'];
		} else {
			$center_padding_mobile = $center_padding_tablet;
		}

		$slide_rows = $settings['slide_rows'];
		if ( isset( $settings['slide_rows_tablet'] ) && $settings['slide_rows_tablet'] != '' ) {
			$slide_rows_tablet = $settings['slide_rows_tablet'];
		} else {
			$slide_rows_tablet = $slide_rows;
		}
		if ( isset( $settings['slide_rows_mobile'] ) && $settings['slide_rows_mobile'] != '' ) {
			$slide_rows_mobile = $settings['slide_rows_mobile'];
		} else {
			$slide_rows_mobile = $slide_rows_tablet;
		}

		$slides_per_row = $settings['slides_per_row'];
		if ( isset( $settings['slides_per_row_tablet'] ) && $settings['slides_per_row_tablet'] != '' ) {
			$slides_per_row_tablet = $settings['slides_per_row_tablet'];
		} else {
			$slides_per_row_tablet = $slides_per_row;
		}
		if ( isset( $settings['slides_per_row_mobile'] ) && $settings['slides_per_row_mobile'] != '' ) {
			$slides_per_row_mobile = $settings['slides_per_row_mobile'];
		} else {
			$slides_per_row_mobile = $slides_per_row_tablet;
		}
		$slick_options           = array(
			'slidesToShow'  => intval( $settings['layout'] ),
			'centerMode'    => $settings['center_mode'] === 'on',
			'centerPadding' => $settings['center_padding'],
			'arrows'        => $settings['navigation_arrow'] === 'on',
			'dots'          => $settings['navigation_dots'] === 'on',
			'infinite'      => ( $settings['center_mode'] === 'on' ) ? true : ( $settings['loop'] === 'on' ),
			'autoplay'      => $settings['autoplay_enable'] === 'on',
			'autoplaySpeed' => intval( $settings['autoplay_speed'] ),
		);
		$mobile_breakpoint_value = \Elementor\Plugin::$instance->breakpoints->get_breakpoints( 'mobile' )->get_value();
		$tablet_breakpoint_value = \Elementor\Plugin::$instance->breakpoints->get_breakpoints( 'tablet' )->get_value();

		$tablet_settings = array(
			'slidesToShow'  => intval( $slides_to_show_tablet ),
			'centerPadding' => $center_padding_tablet,
			'arrows'        => $navigation_arrow_tablet === 'on',
			'dots'          => $navigation_dots_tablet === 'on',
		);

		$mobile_settings = array(
			'slidesToShow'  => intval( $slides_to_show_mobile ),
			'centerPadding' => $center_padding_mobile,
			'arrows'        => $navigation_arrow_mobile === 'on',
			'dots'          => $navigation_dots_mobile === 'on',
		);

		if ( $settings['grid_mode'] === 'on' ) {
			$slick_options['rows']         = intval( $slide_rows );
			$slick_options['slidesPerRow'] = intval( $slides_per_row );

			$tablet_settings['rows']         = intval( $slide_rows_tablet );
			$tablet_settings['slidesPerRow'] = intval( $slides_per_row_tablet );

			$mobile_settings['rows']         = intval( $slide_rows_mobile );
			$mobile_settings['slidesPerRow'] = intval( $slides_per_row_mobile );
		}
		if ( $settings['grid_mode'] === 'on' ) {
			$slick_options['rows']         = intval( $slide_rows );
			$slick_options['slidesPerRow'] = intval( $slides_per_row );

			$tablet_settings['rows']         = intval( $slide_rows_tablet );
			$tablet_settings['slidesPerRow'] = intval( $slides_per_row_tablet );

			$mobile_settings['rows']         = intval( $slide_rows_mobile );
			$mobile_settings['slidesPerRow'] = intval( $slides_per_row_mobile );
		}
		$responsive = array(
			array(
				'breakpoint' => ( $tablet_breakpoint_value + 1 ),
				'settings'   => $tablet_settings
			),
			array(
				'breakpoint' => ( $mobile_breakpoint_value + 1 ),
				'settings'   => $mobile_settings
			)
		);

		$slick_options['responsive'] = $responsive;
		$hover_classes='';
		if ( ! empty( $settings['hover_image_animation'] ) ) {
			$hover_classes = 'tf-hover-' . $settings['hover_image_animation'];
		}

		$this->add_render_attribute( 'tf_team', [
			'id'                 => "tf-team-{$this->get_id()}",
			'class'              => [ 'tf-team-slider','tf-team-wrapper',$hover_classes ],
			'data-tabid'         => $this->get_id(),
			'data-slick-options' => json_encode( $slick_options )
		] );
		?>
        <div <?php echo $this->get_render_attribute_string( 'tf_team' ) ?>>
			<?php foreach ( $settings['team_list'] as $item ):
				?>
                <div class="item">
                    <div class="tf-team">
                        <div class="wrap-team">
							<?php if ( $item['image']['url'] ): ?>
                                <div class="image-team">
                                    <img src="<?php echo esc_attr( $item['image']['url'] ); ?>"
                                         alt="<?php echo esc_attr( $item['title'] ) ?>">
                                </div>
							<?php endif; ?>
                            <div class="content">
                                <h3 class="title"><?php echo esc_html( $item['title'] ) ?></h3>
                                <div class="social">
									<?php if ( ! empty( $item['link_facebook']['url'] ) ):
										$target = $item['link_facebook']['is_external'] ? ' target="_blank"' : '';
										$nofollow = $item['link_facebook']['nofollow'] ? ' rel="nofollow"' : '';
										?>
                                        <a href="<?php echo esc_url( $item['link_facebook']['url'] ) ?>" <?php echo esc_attr( $target ) ?> <?php echo esc_attr( $nofollow ) ?>>
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
									<?php endif; ?>
									<?php if ( ! empty( $item['link_insta']['url'] ) ):
										$target = $item['link_insta']['is_external'] ? ' target="_blank"' : '';
										$nofollow = $item['link_insta']['nofollow'] ? ' rel="nofollow"' : '';
										?>
                                        <a href="<?php echo esc_url( $item['link_insta']['url'] ) ?>" <?php echo esc_attr( $target ) ?> <?php echo esc_attr( $nofollow ) ?>>
                                            <i class="fab fa-instagram"></i>
                                        </a>
									<?php endif; ?>
									<?php if ( ! empty( $item['link_dribble']['url'] ) ):
										$target = $item['link_dribble']['is_external'] ? ' target="_blank"' : '';
										$nofollow = $item['link_dribble']['nofollow'] ? ' rel="nofollow"' : '';
										?>
                                        <a href="<?php echo esc_url( $item['link_dribble']['url'] ) ?>" <?php echo esc_attr( $target ) ?> <?php echo esc_attr( $nofollow ) ?>>
                                            <i class="fab fa-dribbble"></i>
                                        </a>
									<?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
		<?php


	}

}