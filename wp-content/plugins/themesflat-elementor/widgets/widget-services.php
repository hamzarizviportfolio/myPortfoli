<?php

use Elementor\Controls_Manager;

class TFServices_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-services';
	}

	public function get_title() {
		return esc_html__( 'TF Services', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_style_depends() {
		return [ 'owl-carousel' ];
	}

	public function get_script_depends() {
		return [ 'owl-carousel', 'tf-services' ];
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	protected function register_controls() {
		$this->register_query();
		$this->register_style();
	}

	public function register_query() {
		// Start Posts Query
		$this->start_controls_section(
			'section_posts_query',
			[
				'label' => esc_html__( 'Query', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => esc_html__( 'Posts Per Page', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '6',
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'   => esc_html__( 'Order By', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'  => esc_html__( 'Date', 'themesflat-elementor' ),
					'ID'    => esc_html__( 'Post ID', 'themesflat-elementor' ),
					'title' => esc_html__( 'Title', 'themesflat-elementor' )
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'desc' => esc_html__( 'Descending', 'themesflat-elementor' ),
					'asc'  => esc_html__( 'Ascending', 'themesflat-elementor' )
				],
			]
		);

		$this->add_control(
			'posts_categories',
			[
				'label'       => esc_html__( 'Categories', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => ThemesFlat_Addon_For_Elementor_Fungi::tf_get_taxonomies( 'services_category' ),
				'label_block' => true,
				'multiple'    => true,
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => esc_html__( 'Exclude', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'themesflat-elementor' ),
				'default'     => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'sort_by_id',
			[
				'label'       => esc_html__( 'Sort By ID', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Post Ids Will Be Sort. Ex: 1,2,3', 'themesflat-elementor' ),
				'default'     => '',
				'label_block' => true,
			]
		);


		$this->add_control(
			'excerpt_lenght',
			[
				'label'   => esc_html__( 'Excerpt Length', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'default' => 20,
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

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Styles', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-01',
				'options' => [
					'style-01' => esc_html__( 'Style 1', 'themesflat-elementor' ),
					'style-02' => esc_html__( 'Style 2', 'themesflat-elementor' ),
					'style-03' => esc_html__( 'Style 3', 'themesflat-elementor' ),
					'style-04' => esc_html__( 'Style 4', 'themesflat-elementor' ),
				],
			]
		);
		$this->add_control(
			'show_image',
			[
				'label'        => esc_html__( 'Show Image', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_responsive_control(
			'image_width',
			[
				'label'     => esc_html__( 'Image Width', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'step'      => 1,
				'condition' => [
					'show_image' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'image_height',
			[
				'label'     => esc_html__( 'Image Height', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'step'      => 1,
				'condition' => [
					'show_image' => 'yes'
				]
			]
		);
		$this->add_responsive_control( 'spacing_item', [
			'label'     => esc_html__( 'Space Between Items', 'themesflat-elementor' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 0,
			'max'       => 200,
			'step'      => 1,
			'default'   => 30,
			'selectors' => [
				'{{WRAPPER}} .tf-services-wrap .wrap-services-post' => '--tf-services-gap: {{VALUE}}px;',
			],
		] );

		$this->add_control(
			'carousel',
			[
				'label'        => esc_html__( 'Carousel', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'disable_animation',
			[
				'label'        => esc_html__( 'Disable Animation', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);
		$this->add_responsive_control(
			'navigation_arrow',
			[
				'label'     => esc_html__( 'Navigation Arrow', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'off' => esc_html__( 'Hide', 'themesflat-elementor' ),
					'on'  => esc_html__( 'Show', 'themesflat-elementor' ),

				],
				'default'   => 'off',
				'condition' => [
					'carousel' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'navigation_dots',
			[
				'label'     => esc_html__( 'Navigation Dots', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'off' => esc_html__( 'Hide', 'themesflat-elementor' ),
					'on'  => esc_html__( 'Show', 'themesflat-elementor' ),

				],
				'default'   => 'on',
				'condition' => [
					'carousel' => 'yes'
				]
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
				'condition'    => [
					'carousel' => 'yes'
				]
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
				'condition'    => [
					'carousel' => 'yes'
				]
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
				'condition'    => [
					'carousel' => 'yes'
				]
			]
		);

		$this->add_control(
			'grid_mode',
			[
				'label'        => esc_html__( 'Enabled Grid Mode', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Disable', 'themesflat-elementor' ),
				'return_value' => 'on',
				'default'      => '',
				'condition'    => [
					'carousel' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'slide_rows',
			[
				'label'      => esc_html__( 'Slide Rows', 'themesflat-elementor' ),
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
			'label'      => esc_html__( 'Slides Per Row', 'themesflat-elementor' ),
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

		// /.End Posts Query
	}

	public function register_style() {
		$this->wrapper_style();
		$this->icon_style();
		$this->content_style();
		$this->title_style();
		$this->desc_style();
		$this->readmore_style();
		$this->register_style_carousel();
	}

	protected function wrapper_style() {
		$this->start_controls_section(
			'general_style', [
				'label' => esc_html__( 'Wrapper', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-services-post ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .wrap-services-post .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'wrapper_style_tabs'
		);
		$this->start_controls_tab(
			'wrapper_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'background_color_normal', [
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'color_normal', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .title a'            => 'color: {{VALUE}};',
					'{{WRAPPER}} .tf-services-post .desc'               => 'color: {{VALUE}};',
					'{{WRAPPER}} .tf-services-post .tf-service-icon'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .tf-services-post .services-view-more' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'border_normal',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-post',
			]
		);
		$this->add_control(
			'border_icon_color_normal', [
				'label'     => esc_html__( 'Icon Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .tf-service-icon' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'wrapper_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'background_color_hover', [
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'color_hover', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post:hover .title a'            => 'color: {{VALUE}};',
					'{{WRAPPER}} .tf-services-post:hover .desc'               => 'color: {{VALUE}};',
					'{{WRAPPER}} .tf-services-post:hover .tf-service-icon'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .tf-services-post:hover .services-view-more' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'border_hover',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-post:hover',
			]
		);
		$this->add_control(
			'border_icon_color_hover', [
				'label'     => esc_html__( 'Icon Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post:hover .tf-service-icon' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function icon_style() {
		$this->start_controls_section(
			'icon_style', [
				'label'     => esc_html__( 'Icon', 'themesflat-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => array( 'style-02', 'style-03', 'style-4' ),
				],
			]
		);
		$this->add_control(
			'show_icon_hover_effect',
			[
				'label'        => esc_html__( 'Show Icon Hover Effect', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'     => 'icon_typography',
				'selector' => '{{WRAPPER}} .tf-services-post .tf-service-icon',
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-services-post .tf-service-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'icon_style_tabs'
		);
		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'icon_color_normal', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .tf-service-icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_bg_color_normal', [
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .tf-service-icon'       => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tf-services-post .tf-service-icon .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Icon Border Color', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .tf-services-post .tf-service-icon' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'icon_color_hover', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post:hover .tf-service-icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_bg_color_hover', [
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post:hover .tf-service-icon'       => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tf-services-post:hover .tf-service-icon .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_border_color_hover',
			[
				'label' => esc_html__( 'Icon Border Hover Color', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .tf-services-post:hover .tf-service-icon' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function content_style() {
		$this->start_controls_section(
			'content_style', [
				'label'     => esc_html__( 'Content', 'themesflat-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => array( 'style-02', 'style-03' ),
				],
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .wrap-services-post .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .wrap-services-post .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'content_border',
				'label'    => esc_html__( 'Content Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .wrap-services-post .content',
			]
		);
		$this->end_controls_section();

	}

	protected function title_style() {
		$this->start_controls_section(
			'title_style', [
				'label' => esc_html__( 'Title', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .tf-services-post .content .title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .wrap-services-post .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'title_style_tabs'
		);
		$this->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'title_color_normal', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .content .title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'title_color_hover', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .content .title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function desc_style() {
		$this->start_controls_section(
			'desc_style', [
				'label'     => esc_html__( 'Description', 'themesflat-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => array( 'style-02', 'style-03' ),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .tf-services-post .content .desc',
			]
		);

		$this->add_control(
			'desc_color_normal', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .content .desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .wrap-services-post .content .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function readmore_style() {
		$this->start_controls_section(
			'readmore_style', [
				'label' => esc_html__( 'Read More', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'     => 'readmore_typography',
				'selector' => '{{WRAPPER}} .tf-services-post .services-view-more',
			]
		);
		$this->add_responsive_control(
			'read_more_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-services-post .services-view-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'read_more_button_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-services-post .services-view-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'read_more_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-services-post .services-view-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'read_more_button_width',
			[
				'label'      => esc_html__( 'Width', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-services-post .services-view-more' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'read_more_button_height',
			[
				'label'      => esc_html__( 'Height', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-services-post .services-view-more' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'readmore_style_tabs'
		);
		$this->start_controls_tab(
			'readmore_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'readmore_color_normal', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .services-view-more' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'readmore_bg_color_normal', [
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post .services-view-more' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-post .services-view-more',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'readmore_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'readmore_color_hover', [
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post:hover .services-view-more' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'readmore_bg_color_hover', [
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-post:hover .services-view-more' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'readmore_border_hover',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-post:hover .services-view-more',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function register_style_carousel() {
		// Start Style
		$this->start_controls_section( 'section_carousel_style',
			[
				'label'     => esc_html__( 'Carousel', 'themesflat-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'carousel' => 'yes',
				],
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
					'{{WRAPPER}} .slick-dots li.slick-active span' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->end_controls_section();
		// /.End Style
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_services_wrap', [
			'id'         => "tf-services-{$this->get_id()}",
			'class'      => [
				'tf-services-wrap',
				'themesflat-services-taxonomy',
				$settings['style'],
				$settings['show_icon_hover_effect'] == 'yes' ? 'icon-hover-effect' : ''
			],
			'data-tabid' => $this->get_id()
		] );

		$class_carousel = $data_carousel = $row = '';
		$item_classes   = '';
		if ( $settings['carousel'] == 'yes' ) {
			$class_carousel = 'themesflat-services-slider';
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
				'autoplaySpeed' => intval( $settings['autoplay_speed'] )
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
			$this->add_render_attribute( 'tf_services_container', 'data-slick-options', json_encode( $slick_options ) );
		} else {
			$row     = 'row';
			$columns = empty( $settings['layout'] ) ? 1 : $settings['layout'];
			if ( isset( $settings['layout_tablet'] ) && $settings['layout_tablet'] != '' ) {
				$columns_tb = $settings['layout_tablet'];
			} else {
				$columns_tb = $columns;
			}
			if ( isset( $settings['layout_mobile'] ) && $settings['layout_mobile'] != '' ) {
				$columns_mb = $settings['layout_mobile'];
			} else {
				$columns_mb = $columns_tb;
			}
			$item_classes = themesflat_create_columns( $columns, $columns_tb, $columns_mb );
		}
		$container_class = array(
			'wrap-services-post',
			$row,
			'column-' . $settings['layout'],
			'tf-services-' . $settings['style'],
			$class_carousel

		);

		if ( $settings['disable_animation'] == 'yes' ) {
			$container_class[] = 'disable_animation';
		}
		$this->add_render_attribute( 'tf_services_container', [
			'class' => $container_class,
			'id'    => "tf-services-list-" . $this->get_id()
		] );
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$query_args = array(
			'post_type'      => 'services',
			'posts_per_page' => $settings['posts_per_page'],
			'paged'          => $paged
		);

		if ( ! empty( $settings['posts_categories'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'services_category',
					'field'    => 'slug',
					'terms'    => $settings['posts_categories']
				),
			);
		}
		if ( ! empty( $settings['exclude'] ) ) {
			if ( ! is_array( $settings['exclude'] ) ) {
				$exclude = explode( ',', $settings['exclude'] );
			}

			$query_args['post__not_in'] = $exclude;
		}

		$query_args['orderby'] = $settings['order_by'];
		$query_args['order']   = $settings['order'];

		if ( $settings['sort_by_id'] != '' ) {
			$sort_by_id             = array_map( 'trim', explode( ',', $settings['sort_by_id'] ) );
			$query_args['post__in'] = $sort_by_id;
			$query_args['orderby']  = 'post__in';
		}

		$image_size = '740x400';
		if ( ! empty( $settings['image_width'] ) && ! empty( $settings['image_height'] ) ) {
			$image_size = $settings['image_width'] . 'x' . $settings['image_height'];
		}
		$settings['image_size'] = $image_size;
		$query                  = new WP_Query( $query_args );

		if ( $query->have_posts() ) :
			?>
            <div <?php echo $this->get_render_attribute_string( 'tf_services_wrap' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'tf_services_container' ) ?>>
					<?php while ( $query->have_posts() ) : $query->the_post();
						?>
                        <div class="item <?php echo esc_attr( $item_classes ) ?>">
							<?php tf_get_template( 'services/' . $settings['style'] . '.php', array(
								'settings' => $settings,
							) ); ?>

                        </div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
                </div>
            </div>
		<?php
		else:
			esc_html_e( 'No posts found', 'themesflat-elementor' );
		endif;

	}

}