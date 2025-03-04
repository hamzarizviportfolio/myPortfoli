<?php

use Elementor\Controls_Manager;

class TFPortfolioGrid_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tfportfolio';
	}

	public function get_title() {
		return esc_html__( 'TF Portfolio', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	public function get_style_depends() {
		return [ 'jquery-justified', 'owl-carousel' ];
	}

	public function get_script_depends() {
		return [ 'jquery-justified', 'appear', 'owl-carousel', 'tf-portfolio' ];
	}

	protected function register_controls() {
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
					'date'  => 'Date',
					'ID'    => 'Post ID',
					'title' => 'Title',
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
					'desc' => 'Descending',
					'asc'  => 'Ascending',
				],
			]
		);

		$this->add_control(
			'posts_categories',
			[
				'label'       => esc_html__( 'Categories', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => ThemesFlat_Addon_For_Elementor_Fungi::tf_get_taxonomies( 'portfolios_category' ),
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

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'default' => 'themesflat-portfolio-image',
			]
		);


		$this->add_responsive_control(
			'columns',
			[
				'label'   => esc_html__( 'Columns', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => esc_html__( '1', 'themesflat-elementor' ),
					2 => esc_html__( '2', 'themesflat-elementor' ),
					3 => esc_html__( '3', 'themesflat-elementor' ),
					4 => esc_html__( '4', 'themesflat-elementor' ),
					5 => esc_html__( '5', 'themesflat-elementor' ),
				],
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
				'{{WRAPPER}} .wrap-portfolio-post' => '--tf-portfolio-gap: {{VALUE}}px;',
			],
		] );
		$this->add_control(
			'show_popup',
			[
				'label'        => esc_html__( 'Show Popup', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
		// /.End Posts Query

		// Start Carousel
		$this->start_controls_section(
			'section_posts_carousel',
			[
				'label' => esc_html__( 'Carousel', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'carousel',
			[
				'label'        => esc_html__( 'Carousel', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'carousel_loop',
			[
				'label'        => esc_html__( 'Loop', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_auto',
			[
				'label'        => esc_html__( 'Auto Play', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_desk',
			[
				'label'     => esc_html__( 'Columns Desktop', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => [
					'1' => esc_html__( '1', 'themesflat-elementor' ),
					'2' => esc_html__( '2', 'themesflat-elementor' ),
					'3' => esc_html__( '3', 'themesflat-elementor' ),
					'4' => esc_html__( '4', 'themesflat-elementor' ),
					'5' => esc_html__( '5', 'themesflat-elementor' ),
					'6' => esc_html__( '6', 'themesflat-elementor' ),
				],
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_tablet',
			[
				'label'     => esc_html__( 'Columns Tablet', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '2',
				'options'   => [
					'1' => esc_html__( '1', 'themesflat-elementor' ),
					'2' => esc_html__( '2', 'themesflat-elementor' ),
					'3' => esc_html__( '3', 'themesflat-elementor' ),
				],
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_mobile',
			[
				'label'     => esc_html__( 'Columns Mobile', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1' => esc_html__( '1', 'themesflat-elementor' ),
					'2' => esc_html__( '2', 'themesflat-elementor' ),
				],
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_arrow',
			[
				'label'        => esc_html__( 'Arrow', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'carousel' => 'yes',
				],
				'description'  => 'Just show when you have two slide',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'carousel_prev_icon', [
				'label'     => esc_html__( 'Prev Icon', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::ICON,
				'default'   => 'fas fa-arrow-left',
				'include'   => [
					'fas fa-angle-double-left',
					'fas fa-angle-left',
					'fas fa-chevron-left',
					'fas fa-arrow-left',
				],
				'condition' => [
					'carousel'       => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_control(
			'carousel_next_icon', [
				'label'     => esc_html__( 'Next Icon', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::ICON,
				'default'   => 'fas fa-arrow-right',
				'include'   => [
					'fas fa-angle-double-right',
					'fas fa-angle-right',
					'fas fa-chevron-right',
					'fas fa-arrow-right',
				],
				'condition' => [
					'carousel'       => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'carousel_arrow_fontsize',
			[
				'label'      => esc_html__( 'Font Size', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 17,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'       => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'w_size_carousel_arrow',
			[
				'label'      => esc_html__( 'Width', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 67,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'       => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'h_size_carousel_arrow',
			[
				'label'      => esc_html__( 'Height', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 67,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'       => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'carousel_arrow_width',
			[
				'label'      => esc_html__( 'Width Wrap Nav', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 167,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'       => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'carousel_arrow_horizontal_position',
			[
				'label'      => esc_html__( 'Horizontal Position', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 2000,
						'max'  => 2000,
						'step' => 1,
					],
					'%'  => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 0.1,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 17.5,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav'      => 'right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav' => 'left: {{SIZE}}{{UNIT}};right: unset;',
				],
				'condition'  => [
					'carousel'       => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'carousel_arrow_vertical_position',
			[
				'label'      => esc_html__( 'Vertical Position', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 102,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'       => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->start_controls_tabs(
			'carousel_arrow_tabs',
			[
				'condition' => [
					'carousel_arrow' => 'yes',
					'carousel'       => 'yes',
				]
			] );
		$this->start_controls_tab(
			'carousel_arrow_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'carousel_arrow_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next' => 'color: {{VALUE}}',
				],
				'condition' => [
					'carousel_arrow' => 'yes',
				]
			]
		);
		$this->add_control(
			'carousel_arrow_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#33B9CB',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'carousel_arrow' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'carousel_arrow_border',
				'label'     => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector'  => '{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next',
				'condition' => [
					'carousel_arrow' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'carousel_arrow_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '50',
					'right'    => '50',
					'bottom'   => '50',
					'left'     => '50',
					'unit'     => '%',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'carousel_arrow' => 'yes',
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'carousel_arrow_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'carousel_arrow_color_hover',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next:hover'       => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev.disabled, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next.disabled' => 'color: {{VALUE}}',
				],
				'condition' => [
					'carousel_arrow' => 'yes',
				]
			]
		);
		$this->add_control(
			'carousel_arrow_hover_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => 'rgba(225,225,225,0.1)',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next:hover'       => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev.disabled, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next.disabled' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'carousel_arrow' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'carousel_arrow_border_hover',
				'label'     => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector'  => '{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev.disabled, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next.disabled',
				'condition' => [
					'carousel_arrow' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'carousel_arrow_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius Previous', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-prev.disabled, {{WRAPPER}} .tf-portfolio-wrap .owl-carousel .owl-nav .owl-next.disabled' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'carousel_arrow' => 'yes',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'carousel_bullets',
			[
				'label'        => esc_html__( 'Bullets', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'carousel' => 'yes',
				],
				'separator'    => 'before',
			]
		);

		$this->add_responsive_control(
			'w_size_carousel_bullets',
			[
				'label'      => esc_html__( 'Width', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'         => 'yes',
					'carousel_bullets' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'h_size_carousel_bullets',
			[
				'label'      => esc_html__( 'Height', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'         => 'yes',
					'carousel_bullets' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'carousel_bullets_horizontal_position',
			[
				'label'      => esc_html__( 'Horizonta Offset', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-dots' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'         => 'yes',
					'carousel_bullets' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'carousel_bullets_vertical_position',
			[
				'label'      => esc_html__( 'Vertical Offset', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 200,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'carousel'         => 'yes',
					'carousel_bullets' => 'yes',
				]
			]
		);

		$this->start_controls_tabs(
			'carousel_bullets_tabs',
			[
				'condition' => [
					'carousel'         => 'yes',
					'carousel_bullets' => 'yes',
				]
			] );
		$this->start_controls_tab(
			'carousel_bullets_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'carousel_bullets_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#e8e8e9',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'carousel_bullets' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'carousel_bullets_border',
				'label'     => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector'  => '{{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot',
				'condition' => [
					'carousel_bullets' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'carousel_bullets_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'carousel_bullets' => 'yes',
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'carousel_bullets_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'carousel_bullets_hover_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#33B9CB',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'carousel_bullets' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'carousel_bullets_border_hover',
				'label'     => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector'  => '{{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot.active',
				'condition' => [
					'carousel_bullets' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'carousel_bullets_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .tf-portfolio-wrap .owl-dots .owl-dot.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'carousel_bullets' => 'yes',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		// /.End Carousel

		// Start Filter
		$this->start_controls_section(
			'section_filter',
			[
				'label'     => esc_html__( 'Filter', 'themesflat-elementor' ),
				'condition' => [
					'carousel!' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_filter',
			[
				'label'        => esc_html__( 'Filter', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'carousel!' => 'yes',
				],
			]
		);
		$this->add_control(
			'filter_category_order',
			[
				'label'       => esc_html__( 'Filter Order', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Filter Slug Categories Order Split By ","', 'themesflat-elementor' ),
				'default'     => '',
				'label_block' => true,
				'condition'   => [
					'show_filter' => 'yes',
					'carousel!'   => 'yes',
				],
			]
		);
		$this->end_controls_section();
		// /.End Filter

		// Start Style
		$this->start_controls_section( 'section_post_style',
			[
				'label' => esc_html__( 'Style', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'h_style_title',
			[
				'label'     => esc_html__( 'Title', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-portfolio-wrap .portfolio-post .title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .portfolio-post .title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .portfolio-post .title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'h_style_position',
			[
				'label'     => esc_html__( 'Category', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'position_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-portfolio-wrap .portfolio-post .post-meta a',
			]
		);
		$this->add_control(
			'position_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-wrap .portfolio-post .post-meta a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		// /.End Style
		// Start Style Filter
		$this->start_controls_section( 'section_filter_style',
			[
				'label'     => esc_html__( 'Filter', 'themesflat-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_filter' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'filter_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li a',
			]
		);
		$this->add_control(
			'filter_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_bgcolor',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_color_hover',
			[
				'label'     => esc_html__( 'Color Active', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li.active a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_bgcolor_hover',
			[
				'label'     => esc_html__( 'Background Color Active', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li a:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li.active a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		// /.End Style Filter
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$has_carousel = '';
		if ( $settings['carousel'] == 'yes' ) {
			$has_carousel = 'has-carousel';
		}

		$classes = 'tf-portfolio-wrap tf-widget-portfolio-wrap';
		$classes .= ' ' . $has_carousel;

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$query_args = array(
			'post_type'      => 'portfolio',
			'posts_per_page' => $settings['posts_per_page'],
			'paged'          => $paged
		);

		if ( ! empty( $settings['posts_categories'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
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

		$show_filter_class = '';
		$item_classes      = '';
		if ( $settings['carousel'] !== 'yes' ) {
			$columns = empty( $settings['columns'] ) ? 1 : $settings['columns'];
			if ( isset( $settings['columns_tablet'] ) && $settings['columns_tablet'] != '' ) {
				$columns_tb = $settings['columns_tablet'];
			} else {
				$columns_tb = $columns;
			}
			if ( isset( $settings['columns_mobile'] ) && $settings['columns_mobile'] != '' ) {
				$columns_mb = $settings['columns_mobile'];
			} else {
				$columns_mb = $columns_tb;
			}
			$item_classes = themesflat_create_columns( $columns, $columns_tb, $columns_mb );
		}


		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) : ?>
            <div class="<?php echo esc_attr( $classes ); ?>">

				<?php
				if ( $settings['show_filter'] == 'yes' ):
					$show_filter_class     = 'container-filter show-filter';
					$filter_category_order = $settings['filter_category_order'];
					$filters               = wp_list_pluck( get_terms( 'portfolio_category', 'hide_empty=1' ), 'name', 'slug' );
					echo '<ul class="portfolio-filter posttype-filter"><li class="active"><a data-filter="*" href="#">' . esc_html__( 'All', 'themesflat-elementor' ) . '</a></li>';
					if ( $filter_category_order == '' ) {

						foreach ( $filters as $key => $value ) {
							echo '<li><a data-filter=".' . esc_attr( strtolower( $key ) ) . '" href="#" title="' . esc_attr( $value ) . '">' . esc_html( $value ) . '</a></li>';
						}

					} else {
						$filter_category_order = explode( ",", $filter_category_order );
						foreach ( $filter_category_order as $key ) {
							$key = trim( $key );
							echo '<li><a data-filter=".' . esc_attr( strtolower( $key ) ) . '" href="#" title="' . esc_attr( $filters[ $key ] ) . '">' . esc_html( $filters[ $key ] ) . '</a></li>';
						}
					}
					echo '</ul>';
				endif;
				?>

                <div class="wrap-portfolio-post row <?php echo esc_attr( $settings['columns'] ); ?> <?php echo esc_attr( $show_filter_class ); ?>">
					<?php if ( $settings['carousel'] == 'yes' ): ?>
                    <div class="owl-carousel" data-loop="<?php echo esc_attr( $settings['carousel_loop'] ); ?>"
                         data-auto="<?php echo esc_attr( $settings['carousel_auto'] ); ?>"
                         data-column="<?php echo esc_attr( $settings['carousel_column_desk'] ); ?>"
                         data-column2="<?php echo esc_attr( $settings['carousel_column_tablet'] ); ?>"
                         data-column3="<?php echo esc_attr( $settings['carousel_column_mobile'] ); ?>"
                         data-prev_icon="<?php echo esc_attr( $settings['carousel_prev_icon'] ) ?>"
                         data-next_icon="<?php echo esc_attr( $settings['carousel_next_icon'] ) ?>"
                         data-arrow="<?php echo esc_attr( $settings['carousel_arrow'] ) ?>"
                         data-bullets="<?php echo esc_attr( $settings['carousel_bullets'] ) ?>">
						<?php endif; ?>

						<?php while ( $query->have_posts() ) : $query->the_post();
							$link_att_key = $this->get_repeater_setting_key( 'link_attribute', 'link_attribute', get_the_ID() );

							if ( $settings['show_popup'] == 'yes' ) {
								$attr = array(
									'href'           => "#",
									'role'           => "button",
									'data-bs-toggle' => "modal",
									'data-bs-target' => "#portfolioModal" . get_the_ID(),
									'title'          => get_the_title()
								);
							} else {
								$attr = array(
									'href'  => get_permalink(),
									'title' => get_the_title()
								);
							}
							$this->add_render_attribute( $link_att_key, $attr );
							?>
							<?php
							global $post;
							$id          = $post->ID;
							$termsArray  = get_the_terms( $id, 'portfolio_category' );
							$termsString = "";

							if ( $termsArray ) {
								foreach ( $termsArray as $term ) {
									$itemname    = strtolower( $term->slug );
									$itemname    = str_replace( ' ', '-', $itemname );
									$termsString .= $itemname . ' ';
								}
							}
							?>
                            <div class="item <?php echo esc_attr( $termsString ); ?> <?php echo esc_attr( $item_classes ) ?>">
                                <div class="portfolio-post portfolio-post-<?php the_ID(); ?>">
                                    <div class="featured-post">
										<?php
										if ( has_post_thumbnail() ) {
											echo themesflat_render_thumbnail_markup( array(
												'image_size'  => 'full',
												'image_mode'  => 'background',
												'placeholder' => '',
												'image_ratio' => '1x1'
											) );
										}
										?>
                                    </div>
                                    <div class="portfolio-icon">
                                        <a <?php echo $this->get_render_attribute_string( $link_att_key ); ?>
                                                class="portfolio-view-more">
                                            <i class="bi bi-plus-lg"></i>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <div class="post-meta">
                                            <div class="post-meta portfolio-meta portfolio-categories">
												<?php echo get_the_term_list( $id, 'portfolio_category', '', ', ', '' ); ?>
                                            </div>
                                        </div>
                                        <h2 class="title">
                                            <a <?php echo $this->get_render_attribute_string( $link_att_key ); ?>><?php echo get_the_title(); ?></a>
                                        </h2>
                                    </div>
									<?php if ( $settings['show_popup'] == 'yes' ):
										?>
                                        <div class="modal fade tf-portfolio-modal" id="portfolioModal<?php the_ID(); ?>"
                                             tabindex="-1" aria-labelledby="portfolioModal<?php the_ID(); ?>"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"><i class="bi bi-x"></i></button>
                                                        <div class="row item-content">
                                                            <div class="col-xl-12">
                                                                <div class="featured-post"><?php the_post_thumbnail( 'full' ); ?></div>
                                                            </div>
                                                            <div class="col-xl-8">
                                                                <h1 class="post-title"><?php the_title(); ?></h1>
                                                            </div>
                                                            <div class="content-wrapper">
																<?php
																$document = Elementor\Plugin::$instance->documents->get_doc_for_frontend( $id );
																if ( ! $document || ! $document->is_built_with_elementor() ) {
																	the_content();
																} else {
																	$contentElementor = "";
																	if ( class_exists( "\\Elementor\\Plugin" ) ) {
																		$pluginElementor  = \Elementor\Plugin::instance();
																		$contentElementor = $pluginElementor->frontend->get_builder_content( $id );
																	}
																	echo $contentElementor;
																}
																?>
                                                            </div>
                                                        </div> <!-- .row -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
									<?php endif; ?>
                                </div>
                            </div>
						<?php endwhile; ?>

						<?php if ( $settings['carousel'] == 'yes' ): ?>
                    </div>
				<?php endif; ?>

					<?php wp_reset_postdata(); ?>
                </div>
            </div>
		<?php
		else:
			esc_html_e( 'No posts found', 'themesflat-elementor' );
		endif;

	}

}