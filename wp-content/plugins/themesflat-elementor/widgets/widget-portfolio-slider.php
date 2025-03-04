<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

class TFPortfolioSlider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-portfolio-slider';
	}

	public function get_title() {
		return esc_html__( 'TF Portfolio Slider', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_script_depends() {
		return [ 'tf-portfolio' ];
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	protected function register_controls() {
		$this->section_query();
		$this->section_layout();
		$this->section_heading();
		$this->register_carousel();
		$this->section_term_setting();
		$this->section_wrapper_style();
		$this->section_content_style();
		$this->section_meta_style();
		$this->section_title_style();
		$this->section_read_more_style();
		$this->register_style_carousel();
		$this->heading_style();
	}

	public function section_query() {
		$taxonomies = get_taxonomies( [], 'objects' );

		$this->start_controls_section(
			'section_post__filters',
			[
				'label' => esc_html__( 'Query', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'posts_ids',
			[
				'label'       => esc_html__( 'Search & Select', 'themesflat-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => tf_get_all_types_post(),
				'label_block' => true,
				'multiple'    => true,
				'condition'   => [
					'post_type' => 'by_id',
				],
			]
		);

		$this->add_control(
			'authors', [
				'label'       => esc_html__( 'Author', 'themesflat-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => tf_get_authors(),
				'condition'   => [
					'post_type!' => 'by_id',
				],
			]
		);
		foreach ( $taxonomies as $taxonomy => $object ) {
			if ( ! isset( $object->object_type[0] ) ) {
				continue;
			}

			$this->add_control(
				$taxonomy . '_ids',
				[
					'label'       => $object->label,
					'type'        => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'object_type' => $taxonomy,
					'options'     => wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' ),
					'condition'   => [
						'post_type' => $object->object_type,
					],
				]
			);
		}

		$this->add_control(
			'post__not_in',
			[
				'label'       => esc_html__( 'Exclude', 'themesflat-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => tf_get_all_types_post(),
				'label_block' => true,
				'post_type'   => '',
				'multiple'    => true,
				'condition'   => [
					'post_type!' => 'by_id',
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => esc_html__( 'Posts Per Page', 'themesflat-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'offset',
			[
				'label'   => esc_html__( 'Offset', 'themesflat-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0',
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => tf_get_post_orderby_options(),
				'default' => 'date',

			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'asc'  => esc_html__( 'Ascending', 'themesflat-elementor' ),
					'desc' => esc_html__( 'Descending', 'themesflat-elementor' ),
				],
				'default' => 'desc',

			]
		);
		$this->end_controls_section();

	}

	public function section_layout() {
		$this->start_controls_section(
			'section_post_list_layout',
			[
				'label' => esc_html__( 'Layout Settings', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'show_heading',
			[
				'label'        => esc_html__( 'Show Heading', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
					'style-03' => esc_html__( 'Style 03', 'themesflat-elementor' ),
				],
			]
		);
		$this->add_responsive_control(
			'layout',
			[
				'label'          => esc_html__( 'Column', 'themesflat-elementor' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
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
				'{{WRAPPER}} .tf-portfolio-slider .slick-slide' => '--tf-portfolio-gap: {{VALUE}}px;',
			],
		] );

		$this->add_control(
			'show_load_more_text',
			[
				'label'       => esc_html__( 'Label Text', 'themesflat-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Load More', 'themesflat-elementor' ),
				'condition'   => [
					'paging' => 'load_more',
				],
			]
		);
		$this->add_control(
			'load_more_button_text_suffix',
			[
				'label'     => esc_html__( 'Suffix Icon', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-long-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'paging' => 'load_more',
				],
			]
		);
		$this->add_control(
			'show_image',
			[
				'label'        => esc_html__( 'Show Image', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before'
			]
		);
		$this->add_control( 'image_size_mode', [
			'label'     => esc_html__( 'Size Mode', 'themesflat-elementor' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'original'      => esc_html__( 'Original', 'themesflat-elementor' ),
				'100'           => '1:1',
				'133.333333333' => '4:3',
				'75'            => '3:4',
				'177.777777778' => '16:9',
				'56.25'         => '9:16',
				'custom'        => esc_html__( 'Custom', 'themesflat-elementor' ),
			],
			'default'   => '75',
			'condition' => [
				'show_image' => 'yes',
			],
		] );

		$this->add_control(
			'image_size_width',
			[
				'label'     => esc_html__( 'Custom Width', 'themesflat-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'condition' => [
					'image_size_mode' => 'custom',
				],
			]
		);

		$this->add_control(
			'image_size_height',
			[
				'label'     => esc_html__( 'Custom Height', 'themesflat-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'condition' => [
					'image_size_mode' => 'custom',
				],
			]
		);
		$this->add_control(
			'show_title',
			[
				'label'        => esc_html__( 'Show Title', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before'
			]
		);

		$this->add_control(
			'show_read_more_button',
			[
				'label'        => esc_html__( 'Show Read More Button', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->end_controls_section();


	}

	protected function section_heading() {
		$this->start_controls_section( 'heading_content_section', [
			'label'     => esc_html__( 'Heading', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
			'condition' => [
				'show_heading' => 'yes',
			],
		] );
		$this->add_control( 'heading_title', [
			'label'       => esc_html__( 'Title', 'themesflat-elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => esc_html__( 'Enter your title', 'themesflat-elementor' ),
			'default'     => esc_html__( 'Add Your Heading Text Here', 'themesflat-elementor' ),
			'description' => esc_html__( 'Wrap any words with &lt;mark&gt;&lt;/mark&gt; tag to make them highlight.', 'themesflat-elementor' ),
		] );

		$this->add_control( 'heading_sub_title_text', [
			'label'   => esc_html__( 'Subtitle', 'themesflat-elementor' ),
			'type'    => Controls_Manager::TEXTAREA,
			'dynamic' => [
				'active' => true,
			],
		] );
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
				'label'        => esc_html__( 'Enabled Grid Mode', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Disable', 'themesflat-elementor' ),
				'return_value' => 'on',
				'default'      => '',
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
				]
			],
		] );
		$this->end_controls_section();
	}

	public function section_term_setting() {
		$this->start_controls_section(
			'section_post_list_term',
			[
				'label' => esc_html__( 'Term Settings', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'show_category',
			[
				'label'        => esc_html__( 'Show Category', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'category_length',
			[
				'label'     => esc_html__( 'Number Of Category', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 10,
				'step'      => 1,
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);
		$this->end_controls_section();
	}

	public function section_wrapper_style() {

		$this->start_controls_section(
			'section_post_style',
			[
				'label' => esc_html__( 'Post Style', 'themesflat-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'post_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	public function section_content_style() {

		$this->start_controls_section(
			'section_post_content_style',
			[
				'label' => esc_html__( 'Content Style', 'themesflat-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'post_content_align',
			[
				'label'     => esc_html__( 'Text Align', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_content_padding',
			[
				'label'      => esc_html__( 'Content Padding', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_content_margin',
			[
				'label'      => esc_html__( 'Content Margin', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .content' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'content_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color Hover', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post:hover .content' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

	}

	public function section_meta_style() {

		$this->start_controls_section(
			'section_meta_style',
			[
				'label'     => esc_html__( 'Meta', 'themesflat-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_category' => 'yes'
				]
			]
		);
		$this->start_controls_tabs( 'section_meta_tabs' );

		$this->start_controls_tab(
			'section_meta_style_normal',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'post_meta_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .post-meta a' => 'color: {{VALUE}};',
				],

			]
		);


		$this->end_controls_tab();
		$this->start_controls_tab(
			'section_meta_style_hover',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'post_meta_hover_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .post-meta a:hover' => 'color: {{VALUE}}!important;',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'meta_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_meta_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-portfolio .portfolio-post .post-meta a',

			]
		);

		$this->end_controls_section();
	}

	public function section_title_style() {


		$this->start_controls_section(
			'section_title',
			[
				'label'     => esc_html__( 'Title', 'themesflat-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'section_title_tabs' );

		$this->start_controls_tab(
			'section_title_style_normal',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'post_title_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .title a' => 'color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'section_title_style_hover',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'post_title_color_hover',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .title a:hover' => 'color: {{VALUE}};',
				],

			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'title_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_title_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-portfolio .portfolio-post .title',
			]
		);
		$this->add_responsive_control(
			'post_title_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function section_read_more_style() {

		$this->start_controls_section(
			'section_read_more',
			[
				'label'     => esc_html__( 'Read More Button', 'themesflat-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_read_more_button' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'     => 'read_more_typography',
				'selector' => '{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more',
			]
		);
		$this->start_controls_tabs(
			'read_more_button_tabs'
		);
		$this->start_controls_tab(
			'read_more_button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'read_more_button_normal_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'read_more_button_border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more',
			]
		);

		$this->add_control(
			'read_more_button_normal_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'read_more_button_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'read_more_button_hover_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'read_more_button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'read_more_button_hover_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'read_more_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'read_more_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .tf-portfolio .portfolio-post .portfolio-view-more' => 'height: {{SIZE}}{{UNIT}};',
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

	protected function heading_style() {
		$this->start_controls_section( 'heading_title_style_section', [
			'label'     => esc_html__( 'Heading', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_heading!' => '',
			],
		] );
		$this->add_control(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);


		$this->add_responsive_control( 'heading_title_margin', [
			'label'      => esc_html__( 'Title Margin', 'themesflat-elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .tf-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
			],
		] );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_title_typography',
				'selector' => '{{WRAPPER}} .tf-heading-title',
			]
		);

		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'heading_text_shadow',
			'selector' => '{{WRAPPER}} .tf-heading-title',
		] );

		$this->start_controls_tabs( 'heading_title_style_tabs' );

		$this->start_controls_tab( 'heading_title_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
		] );

		$this->add_control(
			'heading_title_text_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .tf-heading-title' => 'color: {{VALUE}};' ],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'heading_title_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
		] );

		$this->add_control(
			'heading_title_text_color_hover',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .tf-heading-title:hover, {{WRAPPER}} .tf-heading-title a:hover' => 'color: {{VALUE}};' ],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_control(
			'subtitle_style',
			[
				'label'     => esc_html__( 'Subtitle', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_sub_title_typography',
				'selector' => '{{WRAPPER}} .tf-heading-sub-title',
			]
		);

		$this->add_control(
			'heading_sub_title_text_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .tf-heading .tf-heading-sub-title' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'heading_sub_title_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .tf-heading .tf-heading-sub-title' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control( 'heading_sub-title_spacing_hover', [
			'label'      => esc_html__( 'Spacing', 'themesflat-elementor' ),
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
				'{{WRAPPER}} .tf-heading-sub-title' => 'margin-bottom : {{SIZE}}{{UNIT}} !important',
			],
		] );

		$this->end_controls_section();
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$args = tf_get_portfolio_query_args( $settings );

		if ( ! empty( $settings['load_more_button_scheme'] ) ) {
			$scheme = $settings['load_more_button_scheme'];
		}
		$button_classes = 'btn tf-load-more-button';
		if ( ! empty( $settings['load_more_button_size'] ) ) {
			$button_classes .= ' btn-' . $settings['load_more_button_size'];
		}
		if ( ! empty( $settings['load_more_button_shape'] ) ) {
			$button_classes .= ' btn-' . $settings['load_more_button_shape'];
		}
		if ( ! empty( $settings['load_more_button_type'] ) && $settings['load_more_button_type'] != 'outline' ) {
			$button_classes .= ' btn-' . $settings['load_more_button_type'];
		}
		if ( ! empty( $scheme ) ) {

			if ( empty( $settings['load_more_button_type'] ) || $settings['load_more_button_type'] == '3d' ) {
				$button_classes_scheme = ' btn-' . $scheme;
			}
			if ( $settings['load_more_button_type'] == 'outline' ) {
				$button_classes_scheme = ' btn-outline-' . $scheme;
			}
			$button_classes .= $button_classes_scheme;
		}


		$class = $button_classes;

		$column_classes    = array();
		$column_classes[]  = 'tf-grid-item';
		$wrapper_classes[] = 'tf-portfolio tf-portfolio-slider';
		$wrapper_classes[] = 'portfolio-post-' . $settings['post_layout'];
		if ( ! empty( $settings['hover_animation'] ) ) {
			$wrapper_classes[] = 'tf-portfolio-image-hover-' . $settings['hover_animation'];
		}
		$class_carousel    = '';
		$wrapper_classes[] = $class_carousel;
		$slides_to_show    = empty( $settings['layout'] ) ? 1 : $settings['layout'];
		if ( isset( $settings['layout_tablet'] ) && $settings['layout_tablet'] != '' ) {
			$slides_to_show_tablet = $settings['layout_tablet'];
		} else {
			$slides_to_show_tablet = 2;
		}
		if ( isset( $settings['layout_mobile'] ) && $settings['layout_mobile'] != '' ) {
			$slides_to_show_mobile = $settings['layout_mobile'];
		} else {
			$slides_to_show_mobile = 1;
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
			'slidesToShow'  => $slides_to_show_tablet,
			'centerPadding' => $center_padding_tablet,
			'arrows'        => $navigation_arrow_tablet === 'on',
			'dots'          => $navigation_dots_tablet === 'on',
		);

		$mobile_settings = array(
			'slidesToShow'  => $slides_to_show_mobile,
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
		$this->add_render_attribute( 'post_list_wrapper', 'data-slick-options', json_encode( $slick_options ) );

		$settings_array = [
			'id'                           => $this->get_id(),
			'show_image'                   => $settings['show_image'],
			'show_title'                   => $settings['show_title'],
			'show_read_more_button'        => $settings['show_read_more_button'],
			'show_load_more_text'          => $settings['show_load_more_text'],
			'load_more_button_text_suffix' => $settings['load_more_button_text_suffix'],
			'orderby'                      => $settings['orderby'],
			'show_category'                => $settings['show_category'],
			'category_length'              => $settings['category_length'],
			'post_layout'                  => $settings['post_layout'],
			'button_class'                 => $class,
			'image_size_mode'              => $settings['image_size_mode'],
			'image_size_width'             => $settings['image_size_width'],
			'image_size_height'            => $settings['image_size_height'],
			'column_class'                 => implode( " ", $column_classes ),
		];


		$this->add_render_attribute(
			'post_list_wrapper',
			[
				'id'    => 'tf-portfolio-list-' . esc_attr( $this->get_id() ),
				'class' => $wrapper_classes,
			]
		);

		?>
		<?php if ( $settings['show_heading'] == 'yes' ): ?>
            <div class="container">
                <div class="tf-heading">
                    <h6 class="tf-heading-sub-title"><?php echo esc_html( $settings['heading_sub_title_text'] ) ?></h6>
                    <h2 class="tf-heading-title"><?php echo esc_html( $settings['heading_title'] ) ?></h2>
                </div>
            </div>
		<?php endif; ?>
        <div <?php echo $this->get_render_attribute_string( 'post_list_wrapper' ) ?>>
			<?php echo tf_render_template_post( $args, $settings_array ) ?>
        </div>

		<?php

	}

}