<?php

use Elementor\Controls_Manager;

class TFPosts_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tfposts';
	}

	public function get_title() {
		return esc_html__( 'TF Posts', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel', 'tf-posts' ];
	}

	public function get_script_depends() {
		return [ 'owl-carousel', 'tf-posts' ];
	}

	protected function register_controls() {
		$this->register_query();

		$this->register_layout();

		$this->register_carousel();

		$this->register_style();

	}

	protected function register_query() {
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
				'options'     => ThemesFlat_Addon_For_Elementor_Fungi::tf_get_taxonomies(),
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

		$this->end_controls_section();
		// /.End Posts Query
	}

	protected function register_layout() {
		// Start Layout
		$this->start_controls_section(
			'section_posts_layout',
			[
				'label' => esc_html__( 'Layout', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'post_layout',
			[
				'label'   => esc_html__( 'Post Layout', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-01',
				'options' => [
					'style-01' => esc_html__( 'Style 01', 'themesflat-elementor' ),
					'style-02' => esc_html__( 'Style 02', 'themesflat-elementor' ),
				],
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
		$this->add_responsive_control( 'spacing_item', [
			'label'     => esc_html__( 'Space Between Items', 'themesflat-elementor' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 0,
			'max'       => 200,
			'step'      => 1,
			'default'   => 30,
			'selectors' => [
				'{{WRAPPER}} .tf-posts .wrap-posts' => '--tf-post-gap: {{VALUE}}px;',
			],
		] );

		$this->add_control(
			'layout_align',
			[
				'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themesflat-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_image',
			[
				'label'     => esc_html__( 'Image', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_control(
			'show_image',
			[
				'label'        => esc_html__( 'Show Image', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
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
		$this->add_control(
			'heading_content',
			[
				'label'     => esc_html__( 'Content', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'        => esc_html__( 'Show Title', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'heading_meta',
			[
				'label'     => esc_html__( 'Meta', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_meta',
			[
				'label'        => esc_html__( 'Show Meta', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_category',
			[
				'label'        => esc_html__( 'Show Category', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'show_meta' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_date',
			[
				'label'        => esc_html__( 'Show Date', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'show_meta' => 'yes',
				],
			]
		);

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
	}

	protected function register_carousel() {

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
	}

	protected function register_style() {
		$this->general_style();
		$this->title_style();
		$this->meta_style();
		$this->register_style_carousel();
	}

	protected function general_style() {

		// Start General Style
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => esc_html__( 'General', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-posts .blog-post',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-posts .blog-post',
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-posts .blog-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// /.End General Style
	}

	protected function content_style() {
		// Start Content Style
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-posts .blog-post .content-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// /.End content-post Style
	}

	protected function title_style() {
		// Start Title Style
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post .content-post .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Hover Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post .content-post .entry-title a:hover' => 'color: {{VALUE}}!important',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_s1_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-posts .blog-post .content-post .entry-title',

			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-posts .blog-post .content-post .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// /.End Title Style
	}

	protected function button_style() {
		// Start Button Style
		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__( 'Button', 'themesflat-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'button_s1_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-posts .blog-post .tf-button',
			]
		);
		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post .tf-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post .tf-button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_bg_color_hover',
			[
				'label'     => esc_html__( 'Background Hover Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post .tf-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'read_more_button_icon_spacing',
			[
				'label'      => esc_html__( 'Icon Spacing', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-posts .blog-post .themesflat-readmore-archive i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-posts .blog-post .themesflat-readmore-archive' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// /.End Button Style
	}

	protected function meta_style() {

		// Start Meta Style
		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => esc_html__( 'Meta', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_s1_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-posts .post-meta a,{{WRAPPER}} .tf-posts .post-meta,{{WRAPPER}} .tf-posts .post-meta .item-meta > span',

			]
		);

		$this->add_control(
			'bg_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post .post-meta .item-meta' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'bg_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-posts .blog-post .post-meta .item-meta a:hover' => 'color: {{VALUE}}!important',
				],
			]
		);
		$this->end_controls_section();
		// /.End Meta Style
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
		$settings = $this->get_settings_for_display();


		$this->add_render_attribute( 'tf_posts', [
			'id'         => "tf-posts-{$this->get_id()}",
			'class'      => [
				'tf-posts',
			],
			'data-tabid' => $this->get_id()
		] );

		$class_carousel = $data_carousel = $row = '';
		$item_classes   = 'item ';
		if ( $settings['carousel'] == 'yes' ) {
			$class_carousel = 'themesflat-posts-slider';
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
			$this->add_render_attribute( 'tf_posts_container', 'data-slick-options', json_encode( $slick_options ) );
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
			$item_classes .= themesflat_create_columns( $columns, $columns_tb, $columns_mb );
		}
		$container_class = array(
			'wrap-posts',
			'blog-grid',
			$row,
			'column-' . $settings['layout'],
			$class_carousel

		);
		$this->add_render_attribute( 'tf_posts_container', [
			'class' => $container_class,
			'id'    => "tf-post-list-" . $this->get_id()
		] );

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$query_args = array(
			'post_type'      => 'post',
			'posts_per_page' => $settings['posts_per_page'],
			'paged'          => $paged
		);
		if ( ! empty( $settings['posts_categories'] ) ) {
			$query_args['category_name'] = implode( ',', $settings['posts_categories'] );
		}
		if ( ! empty( $settings['exclude'] ) ) {
			if ( ! is_array( $settings['exclude'] ) ) {
				$exclude = explode( ',', $settings['exclude'] );
			}

			$query_args['post__not_in'] = $exclude;
		}
		$query_args['orderby'] = $settings['order_by'];
		$query_args['order']   = $settings['order'];

		$image_size = '740x740';
		if ( ! empty( $settings['image_width'] ) && ! empty( $settings['image_height'] ) ) {
			$image_size = $settings['image_width'] . 'x' . $settings['image_height'];
		}

		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) :
			?>
            <!-- Button trigger modal -->
            <div <?php echo $this->get_render_attribute_string( 'tf_posts' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'tf_posts_container' ) ?>>
					<?php while ( $query->have_posts() ) : $query->the_post();
						$link_att_key = $this->get_repeater_setting_key( 'link_attribute', 'link_attribute', get_the_ID() );

						if ( $settings['show_popup'] == 'yes' ) {
							$this->add_render_attribute( $link_att_key, array(
								'href'           => "#",
								'role'           => "button",
								'data-bs-toggle' => "modal",
								'data-bs-target' => "#blogModal1" . get_the_ID(),
								'title'          => get_the_title()

							) );
						}else{
							$this->add_render_attribute( $link_att_key, array(
								'href'  => get_permalink(),
								'title' => get_the_title()
							) );
                        }
						?>
                        <div class="<?php echo esc_attr( $item_classes ) ?>">
							<?php if ( $settings['post_layout'] == 'style-01' ): ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post post-style-01' ); ?>>
                                    <div class="main-post">
										<?php if ( $settings['show_image'] == 'yes' ): ?>
                                            <div class="featured-post">
												<?php echo themesflat_render_thumbnail_markup( array(
													'image_size'  => $image_size,
													'image_mode'  => 'background',
													'placeholder' => ''
												) ); ?>
                                            </div>
										<?php endif; ?>
                                        <div class="content-post">
											<?php if ( $settings['show_meta'] == 'yes' ): ?>
                                                <div class="post-meta">
													<?php if ( $settings['show_date'] == 'yes' ): ?>
                                                        <div class="item-meta">
                                                             <span class="meta-icon"><i class="fas fa-calendar"></i></span>
															<?php
															$archive_year  = get_the_time( 'Y' );
															$archive_month = get_the_time( 'm' );
															$archive_day   = get_the_time( 'd' );
															?>
                                                            <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>">
                                                                <span class="meta-text"><?php echo get_the_date() ?></span></a>
                                                        </div>
													<?php endif; ?>
													<?php if ( $settings['show_category'] == 'yes' ):
														global $post;
														$id         = $post->ID;
														$post_type  = get_post_type( $id );
														$taxonomies = get_object_taxonomies( $post_type )[0];
														if ( $taxonomies ):
															?>
                                                            <div class="item-meta post-categories">
                                                                <span class="meta-icon"><i class="fa fa-folder"></i></span>
																<?php echo get_the_term_list( $id, $taxonomies, '', ', ', '' ); ?>
                                                            </div>
														<?php endif;
													endif; ?>
                                                </div>
											<?php endif; ?>
											<?php if ( $settings['show_title'] == 'yes' ): ?>
                                                <h2 class="entry-title">
                                                    <a <?php echo $this->get_render_attribute_string( $link_att_key ); ?>><?php echo get_the_title(); ?></a>
                                                </h2>
											<?php endif; ?>
                                        </div><!-- /.entry-post -->

                                    </div><!-- /.main-post -->
                                </div><!-- #post-## -->
							<?php else: ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post post-style-02
                                ' ); ?>>
                                    <div class="main-post">
										<?php if ( $settings['show_image'] == 'yes' ): ?>
                                            <div class="featured-post">
												<?php echo themesflat_render_thumbnail_markup( array(
													'image_size'  => $image_size,
													'image_mode'  => 'background',
													'placeholder' => ''
												) ); ?>
                                            </div>
										<?php endif; ?>
                                        <div class="content-post">
											<?php if ( $settings['show_meta'] == 'yes' ): ?>
                                                <div class="post-meta category">
													<?php if ( $settings['show_category'] == 'yes' ):
														global $post;
														$id         = $post->ID;
														$post_type  = get_post_type( $id );
														$taxonomies = get_object_taxonomies( $post_type )[0];
														if ( $taxonomies ):
															?>
                                                            <div class="item-meta post-categories">
                                                                 <span class="meta-icon"><i
                                                                             class="pe-7s-folder"></i></span>
																<?php echo get_the_term_list( $id, $taxonomies, '', ', ', '' ); ?>
                                                            </div>
														<?php endif;
													endif; ?>
                                                </div>
											<?php endif; ?>
											<?php if ( $settings['show_title'] == 'yes' ): ?>
                                                <h2 class="entry-title">
                                                    <a <?php echo $this->get_render_attribute_string( $link_att_key ); ?>><?php echo get_the_title(); ?></a>
                                                </h2>
											<?php endif; ?>
											<?php if ( $settings['show_meta'] == 'yes' ): ?>
                                                <div class="post-meta date">
													<?php if ( $settings['show_date'] == 'yes' ): ?>
                                                        <div class="item-meta">
                                                            <span class="meta-icon"><i class="fas fa-calendar"></i></span>
															<?php
															$archive_year  = get_the_time( 'Y' );
															$archive_month = get_the_time( 'm' );
															$archive_day   = get_the_time( 'd' );
															?>
                                                            <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>">
                                                                <span class="meta-text"><?php echo get_the_date(); ?></span>
                                                            </a>
                                                        </div>
													<?php endif; ?>
                                                </div>
											<?php endif; ?>
                                        </div><!-- /.entry-post -->

                                    </div><!-- /.main-post -->
                                </div><!-- #post-## -->
							<?php endif; ?>
							<?php if ( $settings['show_popup'] == 'yes' ): ?>
                                <div class="modal fade tf-post-modal" id="blogModal1<?php the_ID(); ?>"
                                     tabindex="-2" aria-labelledby="blogModal1<?php the_ID(); ?>"
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
                                                    <div class="col-xl-8 offset-xl-2">
                                                        <h2 class="post-title"><?php the_title(); ?></h2>
                                                        <div class="post-meta">
															<?php
															global $post;
															$id         = $post->ID;
															$post_type  = get_post_type( $id );
															$taxonomies = get_object_taxonomies( $post_type )[0];
															if ( $taxonomies ):
																?>
                                                                <div class="item-meta post-categories">
                                                                <span class="meta-icon"><i class="fa fa-folder"></i></span>
																	<?php echo get_the_term_list( $id, $taxonomies, '', ', ', '' ); ?>
                                                                </div>
															<?php endif; ?>
                                                            <div class="item-meta">
                                                             <span class="meta-icon"><i class="fas fa-calendar"></i></span>
																<?php
																$archive_year  = get_the_time( 'Y' );
																$archive_month = get_the_time( 'm' );
																$archive_day   = get_the_time( 'd' );
																?>
                                                                <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>">

                                                                    <span class="meta-text"><?php echo get_the_date() ?></span>
                                                                </a>
                                                            </div>
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
														<?php if ( themesflat_get_opt( 'show_entry_footer_content' ) == 1 ):
															$tags_links = '';
															/* translators: used between list items, there is a space after the comma */
															$tags_list = get_the_tag_list( '', ' ' );
															if ( $tags_list ) {
																$tags_links = sprintf( '<div class="tags-links"><span class="themesflat-tags-lable">Tags:</span>' . esc_html__( ' %1$s', 'fungi' ) . '</div>', $tags_list );

															}
															?>
                                                            <footer class="entry-footer">
                                                                <div class="entry-footer-meta">
																	<?php
																	printf( $tags_links );
																	themesflat_social_single();
																	?>
                                                                </div>
                                                            </footer>
														<?php endif; ?>
                                                    </div>
                                                </div> <!-- .row -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
							<?php endif; ?>
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