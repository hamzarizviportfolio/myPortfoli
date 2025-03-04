<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

class TFPortfolioMetro_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-portfolio-metro';
	}

	public function get_title() {
		return esc_html__( 'TF Portfolio Metro', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-posts-group';
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
		$this->section_term_setting();
		$this->section_wrapper_style();
		$this->section_content_style();
		$this->section_meta_style();
		$this->section_title_style();
		$this->section_category_filter_style();
		$this->section_read_more_style();
		$this->section_paging_style();
		$this->section_load_more_style();
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
			'post_layout',
			[
				'label'   => esc_html__( 'Post Layout', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'metro-style-01',
				'options' => [
					'metro-style-01' => esc_html__( 'Style 01', 'themesflat-elementor' ),
					'metro-style-02' => esc_html__( 'Style 02', 'themesflat-elementor' ),
				],
			]
		);
		$this->add_responsive_control(
			'number_column',
			[
				'label'     => esc_html__( 'Column', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => '3',
				'min'       => 1,
				'max'       => 30,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-metro' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);
		$this->add_responsive_control(
			'post_spacing',
			[
				'label'      => esc_html__( 'Item Spacing', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-list-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_responsive_control(
			'number_row',
			[
				'label'          => __( 'Number Row', 'themesflat-elementor' ),
				'type'           => \Elementor\Controls_Manager::SELECT,
				'default'        => '1',
				'tablet_default' => '1',
				'mobile_default' => '1',
				'options'        => [
					'1' => esc_html__( '1', 'themesflat-elementor' ),
					'2' => esc_html__( '2', 'themesflat-elementor' ),
					'3' => esc_html__( '3', 'themesflat-elementor' ),
					'4' => esc_html__( '4', 'themesflat-elementor' ),
					'5' => esc_html__( '5', 'themesflat-elementor' ),
					'6' => esc_html__( '6', 'themesflat-elementor' ),
				],
			]
		);
		$repeater->add_responsive_control(
			'number_column',
			[
				'label'          => __( 'Number Column', 'themesflat-elementor' ),
				'type'           => \Elementor\Controls_Manager::SELECT,
				'default'        => '1',
				'tablet_default' => '1',
				'mobile_default' => '1',
				'options'        => [
					'1' => esc_html__( '1', 'themesflat-elementor' ),
					'2' => esc_html__( '2', 'themesflat-elementor' ),
					'3' => esc_html__( '3', 'themesflat-elementor' ),
					'4' => esc_html__( '4', 'themesflat-elementor' ),
					'5' => esc_html__( '5', 'themesflat-elementor' ),
					'6' => esc_html__( '6', 'themesflat-elementor' ),
				],
			]
		);

		$this->add_control(
			'post_grid_items',
			[
				'label'     => esc_html__( 'Grid Items', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'separator' => 'before',
				'fields'    => $repeater->get_controls(),
			]
		);
		$this->add_control(
			'post_loop_layout',
			[
				'label'        => esc_html__( 'Loop layout', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'paging',
			[
				'label'     => esc_html__( 'Post Paging', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''          => esc_html__( 'None', 'themesflat-elementor' ),
					'load_more' => esc_html__( 'Load More', 'themesflat-elementor' ),
				],
				'separator' => 'before'
			]
		);

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
			'show_filter_category',
			[
				'label'        => esc_html__( 'Show Filter Category', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'post_ratio',
			[
				'label'   => esc_html__( 'Ratio', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1by1'   => '1:1',
					'3by2'   => '3:2',
					'4by3'   => '4:3',
					'9by16'  => '9:16',
					'16by9'  => '16:9',
					'21by9'  => '21:9',
					'custom' => esc_html__( 'Custom', 'themesflat-elementor' ),
				],
				'default' => '1by1',
			]
		);
		$this->add_control(
			'width',
			[
				'label'     => __( 'Width', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => [
					'post_ratio' => 'custom',
				]
			]
		);
		$this->add_control(
			'height',
			[
				'label'     => __( 'Height', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => [
					'post_ratio' => 'custom',
				]
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
				'label'      => esc_html__( 'Item Margin', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-list-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
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


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'post_list_shadow',
				'selector' => '{{WRAPPER}} .tf-portfolio .portfolio-post',
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

	public function section_category_filter_style() {
		//Content Style Section
		$this->start_controls_section(
			'section_category_style',
			[
				'label'     => esc_html__( 'Category Filter', 'themesflat-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_filter_category' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'post_category_filter_align',
			[
				'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'     => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'   => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_category_filter_margin',
			[
				'label'     => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_category_filter_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-nav-post .nav-link',
			]
		);

		$this->add_responsive_control(
			'post_category_item_spacing',
			[
				'label'      => esc_html__( 'Item Spacing', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-nav-post .nav-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_category_filter_item_padding',
			[
				'label'     => esc_html__( 'Item Padding', 'themesflat-elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post .nav-link' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);
		$this->start_controls_tabs( 'section_category_tabs' );

		$this->start_controls_tab(
			'section_category_style_normal',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'post_category_filter_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post .nav-link' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'post_category_filter_bg',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post .nav-link' => 'background-color: {{VALUE}}',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'post_category_filter_border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-nav-post .nav-link',
			]
		);


		$this->end_controls_tab();
		$this->start_controls_tab(
			'section_category_style_hover',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'post_category_filter_color_hover',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post .nav-link:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_category_filter_bg_hover',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post .nav-link:hover' => 'background-color: {{VALUE}}',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'post_category_filter_border_hover',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-nav-post .nav-link:hover',
			]
		);


		$this->end_controls_tab();
		$this->start_controls_tab(
			'section_category_style_active',
			[
				'label' => esc_html__( 'Active', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'post_category_filter_color_active',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post .nav-item.active .nav-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_category_filter_bg_active',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post .nav-item.active .nav-link' => 'background-color: {{VALUE}}',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'post_category_filter_border_active',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-nav-post .nav-item.active .nav-link',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'category_filter_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'post_category_filter_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tf-nav-post .nav-link' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'post_category_filter_shadow',
				'selector' => '{{WRAPPER}} .tf-nav-post .nav-link',
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

	public function section_paging_style() {
		$this->start_controls_section(
			'section_paging_more',
			[
				'label'     => esc_html__( 'Paging', 'themesflat-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'paging!' => '',
				],
			]
		);
		$this->add_control(
			'paging_align',
			[
				'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
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
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'paging_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-list-paging' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function section_load_more_style() {

		$this->start_controls_section(
			'section_load_more',
			[
				'label'     => esc_html__( 'Load More Button', 'themesflat-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'paging' => 'load_more',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'     => 'load_more_typography',
				'selector' => '{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button',
			]
		);
		$this->add_control(
			'load_more_button_type',
			[
				'label'     => esc_html__( 'Type', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'separator' => 'before',
				'options'   => tf_get_button_styles(),
			]
		);


		$this->add_control(
			'load_more_button_shape',
			[
				'label'   => esc_html__( 'Shape', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'rounded',
				'options' => tf_get_button_shape(),

			]
		);

		$this->add_control(
			'load_more_button_size',
			[
				'label'          => esc_html__( 'Size', 'themesflat-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'md',
				'options'        => tf_get_button_sizes(),
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'load_more_button_scheme',
			[
				'label'   => esc_html__( 'Scheme', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => tf_get_color_schemes(),
				'default' => 'accent',
			]
		);
		$this->add_responsive_control(
			'load_more_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'load_more_button_icon_spacing',
			[
				'label'      => esc_html__( 'Icon Spacing', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [ 'max' => 300 ],
					'%'  => [ 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button .button-suffix' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'     => 'icon_typography',
				'label'      => esc_html__( 'Icon Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button .button-suffix i',
			]
		);
		$this->start_controls_tabs(
			'load_more_button_tabs'
		);
		$this->start_controls_tab(
			'load_more_button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'load_more_button_normal_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'load_more_button_normal_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'load_more_button_normal_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'load_more_button_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'load_more_button_hover_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'load_more_button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'load_more_button_hover_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-portfolio-list-paging .tf-load-more-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$args = tf_get_portfolio_query_args( $settings );

		if ( ! empty( $settings['load_more_button_scheme'] ) ) {
			$scheme = $settings['load_more_button_scheme'];
		}
		$nonce_field = wp_create_nonce( 'tf_load_post' );

		$ratio = $custom_ratio = 100;
		if ( $settings['height'] > 0 && $settings['width'] > 0 ) {
			$custom_ratio = ( $settings['height'] / $settings['width'] ) * 100;
		}
		$ratios = array(
			'3by2'   => 66.7,
			'4by3'   => 75,
			'9by16'  => 177.8,
			'16by9'  => 56.25,
			'21by9'  => 42.86,
			'custom' => $custom_ratio
		);

		if ( array_key_exists( $settings['post_ratio'], $ratios ) ) {
			$ratio = $ratios[ $settings['post_ratio'] ];
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

		$column_classes   = array();
		$column_classes[] = 'tf-portfolio-item tfanimated';

		$settings_array = [
			'id'                           => $this->get_id(),
			'show_title'                   => $settings['show_title'],
			'show_read_more_button'        => $settings['show_read_more_button'],
			'show_load_more_text'          => $settings['show_load_more_text'],
			'load_more_button_text_suffix' => $settings['load_more_button_text_suffix'],
			'orderby'                      => $settings['orderby'],
			'show_category'                => $settings['show_category'],
			'category_length'              => $settings['category_length'],
			'paging'                       => $settings['paging'],
			'show_filter_category'         => $settings['show_filter_category'],
			'post_layout'                  => $settings['post_layout'],
			'load_more_button_type'        => $settings['load_more_button_type'],
			'load_more_button_shape'       => $settings['load_more_button_shape'],
			'load_more_button_size'        => $settings['load_more_button_size'],
			'load_more_button_scheme'      => $settings['load_more_button_scheme'],
			'button_class'                 => $class,
			'column_class'                 => implode( " ", $column_classes ),
			'post_grid_items'              => $settings['post_grid_items'],
			'ratio'                        => $ratio,
			'post_loop_layout'             => $settings['post_loop_layout'],
			'post_style'                   => 'metro'
		];

		$wrapper_classes[] = 'tf-list-grid tf-portfolio tf-portfolio-metro tf-portfolio-appender';
		$wrapper_classes[] = 'portfolio-post-' . $settings['post_layout'];

		$this->add_render_attribute(
			'post_list_wrapper',
			[
				'id'    => 'tf-portfolio-list-' . esc_attr( $this->get_id() ),
				'class' => $wrapper_classes,
			]
		);
		$total_page    = 1;
		$post_per_page = $args['posts_per_page'];

		if ( $post_per_page != 0 && $post_per_page != '' ) {
			$new_arg                   = $args;
			$new_arg['posts_per_page'] = - 1;
			$query                     = new \WP_Query( $new_arg );
			$post_count                = $query->post_count;
			$total_page                = ceil( $post_count / intval( $post_per_page ) );
			$paging_post_count         = $post_count;
		}

		?>
		<?php if ( $settings['show_filter_category'] == 'yes' ) {
			tf_get_template( 'pagination/categories.php', array(
				'settings'       => $settings,
				'settings_array' => $settings_array,
				'nonce_field'    => $nonce_field,
				'posts_per_page' => $post_per_page
			) );
		} ?>


        <div <?php echo $this->get_render_attribute_string( 'post_list_wrapper' ) ?>>
			<?php echo tf_render_template_post( $args, $settings_array ) ?>
        </div>

        <div class="tf-portfolio-list-paging">
			<?php
			if ( intval( $settings['posts_per_page'] ) > 0 && $settings['paging'] != '' && $args['posts_per_page'] < $paging_post_count ) :
				?>
				<?php
				tf_get_template( 'pagination/load-more.php', array(
					'args'                => $args,
					'settings_array'      => $settings_array,
					'total_page'          => $total_page,
					'show_load_more_text' => $settings['show_load_more_text'],
					'class'               => $class,
					'nonce_field'         => $nonce_field
				) );
				?>
			<?php endif; ?>
        </div>
		<?php

	}

}