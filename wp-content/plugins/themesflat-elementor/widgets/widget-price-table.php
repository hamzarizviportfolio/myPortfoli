<?php

use Elementor\Controls_Manager;

class TFPriceTable_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-pricetable';
	}

	public function get_title() {
		return esc_html__( 'TF Price Table', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	public function get_style_depends() {
		return [ 'tf-pricetable' ];
	}

	protected function register_controls() {
		$this->setting();
		$this->style_general();
		$this->style_label();
		$this->style_header();
		$this->content_list_style();
		$this->button_style();
	}

	protected function setting() {
		// Start Price Table Header
		$this->start_controls_section(
			'section_price_header',
			[
				'label' => esc_html__( 'Header', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'price',
			[
				'label'   => esc_html__( 'Price', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '45', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'unit',
			[
				'label'   => esc_html__( 'Unit', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'm', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Title', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Basic', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'show_label',
			[
				'label'        => esc_html__( 'Show Label', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'label',
			[
				'label'     => esc_html__( 'Label', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Most Popular', 'themesflat-elementor' ),
				'condition' => [
					'show_label' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		// /.End Price Table Header

		// Start Price Table Content
		$this->start_controls_section(
			'section_price_content',
			[
				'label' => esc_html__( 'Content', 'themesflat-elementor' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item',
			[
				'label' => esc_html__( 'Item', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-check',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .wrap-icon i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .wrap-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Web development', 'themesflat-elementor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => esc_html__( 'Items', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'show_label'  => true,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'icon' => [
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'text' => esc_html__( ' 60 Mins Driving Lesson', 'themesflat-elementor' ),
					],
					[
						'icon' => [
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'text' => esc_html__( 'Additional Time Available', 'themesflat-elementor' ),
					],
					[
						'icon' => [
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'text' => esc_html__( ' 2 Hour Highway Lesson', 'themesflat-elementor' ),
					],
					[
						'icon' => [
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'text' => esc_html__( '7 Hour Pre-Licensing Course', 'themesflat-elementor' ),
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();
		// /.End Price Table Content

		// Start Price Table Button
		$this->start_controls_section(
			'section_price_button',
			[
				'label' => esc_html__( 'Button', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button Text', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Start Now', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'themesflat-elementor' ),
				'default'     => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);
		$this->end_controls_section();
		// /.End Price Table Button
	}

	protected function style_general() {
		// Start Style General
		$this->start_controls_section( 'section_style_general',
			[
				'label' => esc_html__( 'General', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'background_style_tabs' );
		$this->start_controls_tab(
			'background_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			] );
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'bg_image',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tf-pricetable',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'bg_image_css_filters',
				'selector' => '{{WRAPPER}} .tf-pricetable',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'background_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			] );
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'bg_image_hover',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tf-pricetable:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		// /.End Style General

	}

	protected function style_label() {
		// Start Style General
		$this->start_controls_section( 'section_style_label',
			[
				'label'     => esc_html__( 'Label', 'themesflat-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_label' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'label_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'label_border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable .label',
			]
		);

		$this->add_responsive_control(
			'label_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable .label',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'label_bg',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'    => [ 'classic' ],
				'selector' => '{{WRAPPER}} .tf-pricetable .label',
			]
		);
		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'label_offset',
			[
				'label'              => esc_html__( 'Offset', 'themesflat-elementor' ),
				'type'               => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%', 'em' ],
				'allowed_dimensions' => [ 'top', 'right' ],
				'default'            => [
					'right'    => '',
					'left'     => '',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'          => [
					'{{WRAPPER}} .tf-pricetable .label' => 'top: {{TOP}}{{UNIT}};right: {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// /.End Style General

	}

	protected function style_header() {
		// Start Style Header
		$this->start_controls_section( 'section_style_header',
			[
				'label' => esc_html__( 'Header', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'h_general',
			[
				'label' => esc_html__( 'General', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'header_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .header-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'header_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .header-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'header_border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable .header-price',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'header_bg_image',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tf-pricetable .header-price',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'header_bg_image_hover',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tf-pricetable:hover .header-price',
			]
		);

		$this->add_control(
			'h_price',
			[
				'label'     => esc_html__( 'Price', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_wrap_typography',
				'label'    => esc_html__( 'Typography Price Wrap', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable .price-wrap',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'label'    => esc_html__( 'Price Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable .price',
			]
		);
		$this->add_control(
			'price_color',
			[
				'label'     => esc_html__( ' Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .price-wrap' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'price_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable:hover .price-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'h_title',
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
				'selector' => '{{WRAPPER}} .tf-pricetable .header-price .title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( ' Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .header-price .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable:hover .header-price .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .header-price .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// /.End Style Header
	}

	protected function content_list_style() {
		// Start Style Content List
		$this->start_controls_section( 'section_style_content',
			[
				'label' => esc_html__( 'Content', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'h_general_content',
			[
				'label' => esc_html__( 'General', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_text_align',
			[
				'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .content-list .inner-content-list' => 'display: inline-block;text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_bg_color',
			[
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .content-wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'h_content_list',
			[
				'label' => esc_html__( 'List', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'space_between',
			[
				'label'      => esc_html__( 'Space Between', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .content-list .item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .content-list .item .wrap-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tf-pricetable .content-list .item .wrap-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__( 'Typography Text', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable .text',
			]
		);
		$this->add_control(
			'icon_list_color_normal',
			[
				'label'     => esc_html__( 'Icon Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .content-list .item .wrap-icon'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-pricetable .content-list .item .wrap-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_list_color_hover',
			[
				'label'     => esc_html__( 'Icon Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable:hover .content-list .item .wrap-icon'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .tf-pricetable:hover .content-list .item .wrap-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_list_color_normal',
			[
				'label'     => esc_html__( 'Text Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_list_color_hover',
			[
				'label'     => esc_html__( 'Text Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable:hover .text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_indent',
			[
				'label'      => esc_html__( 'Text Indent', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .content-list .item .wrap-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// /.End Style Content List

	}

	protected function button_style() {
		// Start Style Button
		$this->start_controls_section( 'section_style_button',
			[
				'label' => esc_html__( 'Button', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wrap_btn_padding',
			[
				'label'      => esc_html__( 'Wrap Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .wrap-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_text_align',
			[
				'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .wrap-button' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typography',
				'label'    => esc_html__( 'Typography Text', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-pricetable .wrap-button a',
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .wrap-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],

				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_btn' );
		$this->start_controls_tab( 'tab_btn_normal', [ 'label' => esc_html__( 'Normal', 'themesflat-elementor' ) ] );
		$this->add_control(
			'btn_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_bgcolor',
			[
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_border_width',
			[
				'label'      => esc_html__( 'Border Width', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
				],
			]
		);
		$this->add_control(
			'btn_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_btn_hover', [ 'label' => esc_html__( 'Hover', 'themesflat-elementor' ) ] );
		$this->add_control(
			'btn_color_hover',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_bgcolor_hover',
			[
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a:not(.btn):hover, {{WRAPPER}} .tf-pricetable .wrap-button a.btn:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_border_color_hover',
			[
				'label'     => esc_html__( 'Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-pricetable .wrap-button a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_animation_options',
			[
				'label'   => esc_html__( 'Effect Type', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'        => esc_html__( 'Default', 'themesflat-elementor' ),
					'button-overlay' => esc_html__( 'TF Effect', 'themesflat-elementor' ),
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		// /.End Style Button
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_pricetable', [
			'id'         => "tf-pricetable-{$this->get_id()}",
			'class'      => [ 'tf-pricetable' ],
			'data-tabid' => $this->get_id()
		] );

		$header = $content = $button = $icon = $item_list = $time = '';

		$btn_animation = 'btn btn-accent btn-round hover-default';
		if ( $settings['button_animation_options'] == 'button-overlay' ) {
			$btn_animation = 'btn ';
		}

		foreach ( $settings['items'] as $index => $item ) {
			$item_list .= '<div class="item elementor-repeater-item-' . $item['_id'] . '">
                            <span class="wrap-icon">' . \Elementor\Addon_Elementor_Icon_manager_zoyot::render_icon( $item['icon'] ) . '</span>
                            <span class="text">' . $item['text'] . '</span>
                        </div>';
		}
		$label = '';
		if ( $settings['show_label'] == 'yes' && ! empty( $settings['label'] ) ) {
			$label = '<span class="label">' . $settings['label'] . '</span>';
		}


		$price = $settings['price'] ? ' <div class="price-wrap">
                                            <span class="price">' . $settings['price'] . '</span><span class="suffix">/' . $settings['unit'] . '</span></div>' : '';
		$title = $settings['title'] ? '<div class="title">' . $settings['title'] . '</div>' : '';

		$header = sprintf( '<div class="header-price">
                                %1$s %2$s
                            </div>', $title, $price );

		$content = sprintf( '<div class="content-list">
                                <div class="inner-content-list">%1$s</div>
                            </div>', $item_list );

		$target   = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		$button   = sprintf( '<div class="wrap-button">
                                <a class="%5$s" href="%2$s" %3$s %4$s><span>%1$s</span><span class="icon"><i class="zoyot-icon-arrow-right"></i></span> </a>
                            </div>', $settings['button_text'], $settings['link']['url'], $target, $nofollow, $btn_animation );
		$content_wrap=sprintf( '<div class="content-wrapper">
                              %1$s %2$s
                            </div>', $content,$button );

		echo sprintf(
			'<div %1$s>
                %2$s
                %3$s
                %4$s
            </div>',
			$this->get_render_attribute_string( 'tf_pricetable' ),
			$header,
			$content_wrap,
			$label
		);
	}

}