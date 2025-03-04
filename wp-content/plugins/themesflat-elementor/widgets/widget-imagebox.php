<?php

class TFImageBox_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tfimagebox';
	}

	public function get_title() {
		return esc_html__( 'TF Image Box', 'themesflat-elementor' );
	}

	public function get_image() {
		return 'eimage-image-box';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	public function get_style_depends() {
		return ['tf-imagebox'];
	}

	protected function register_controls() {
		$this->setting();
		$this->read_more();
		$this->container_style();
		$this->hover_style();
		$this->image_style();
		$this->content_style();
		$this->button_style();
	}

	protected function setting() {
		// Start Image Box Setting
		$this->start_controls_section(
			'section_tfimagebox',
			[
				'label' => esc_html__( 'Image Box', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label'       => esc_html__( 'Title', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Non-Polluting', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'description_text',
			[
				'label'   => 'Description',
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Consecte adipiscing elitsed eiusmod tempor indun', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'position',
			[
				'label'   => esc_html__( 'Image Position', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left'  => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'image'  => 'eimage-h-align-left',
					],
					'top'   => [
						'title' => esc_html__( 'Top', 'themesflat-elementor' ),
						'image'  => 'eimage-v-align-top',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'image'  => 'eimage-h-align-right',
					],
				],
			]
		);

		$this->add_control(
			'content_align',
			[
				'label'     => esc_html__( 'Align', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''           => esc_html__( 'Default', 'themesflat-elementor' ),
					'center'     => esc_html__( 'Middle', 'themesflat-elementor' ),
					'flex-start' => esc_html__( 'Top', 'themesflat-elementor' ),
					'flex-end'   => esc_html__( 'Bottom', 'themesflat-elementor' ),
				],
				'default'   => '',
				'condition' => [
					'position' => [ 'right', 'left' ],
				],
				'selectors' => [
					'{{WRAPPER}} .tfimagebox ' => 'display: -webkit-box; display: -ms-flexbox ; display: flex; -webkit-box-align:{{VALUE}};-ms-flex-align:{{VALUE}} !important;align-items:{{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();
		// /.End Image Box Setting
	}

	protected function read_more() {
		// Start Read More
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Read More', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'show_button',
			[
				'label'        => esc_html__( 'Show Button', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'     => esc_html__( 'Button Text', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Read More', 'themesflat-elementor' ),
				'condition' => [
					'show_button' => 'yes',
				],
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
				'condition'   => [
					'show_button' => 'yes'
				]
			]
		);
		$this->end_controls_section();
		// /.End Read More
	}

	protected function container_style() {
		// Start Container Style
		$this->start_controls_section(
			'section_style_container',
			[
				'label' => esc_html__( 'Image Box Container', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'container_align',
			[
				'label' => esc_html__('Alignment', 'themesflat-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'themesflat-elementor'),
						'image' => 'eimage-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'themesflat-elementor'),
						'image' => 'eimage-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'themesflat-elementor'),
						'image' => 'eimage-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justified', 'themesflat-elementor'),
						'image' => 'eimage-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tfimagebox' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'container_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tfimagebox',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'container_border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tfimagebox',
			]
		);

		$this->add_responsive_control(
			'container_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'container_style_tabs'
		);

		$this->start_controls_tab( 'container_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			] );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'container_background_color',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tfimagebox',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'container_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			] );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'container_background_color_hover',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tfimagebox:hover',
			]
		);

		$this->add_control(
			'heading_content_text_color',
			[
				'label'     => esc_html__( 'Image & Text Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_text_color_image',
			[
				'label'     => esc_html__( 'Image Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tfimagebox:hover .wrap-image-inner'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .tfimagebox:hover .wrap-image-inner svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_text_color_title',
			[
				'label'     => esc_html__( 'Title Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tfimagebox:hover .content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_text_color_description',
			[
				'label'     => esc_html__( 'Description Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tfimagebox:hover .content .description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_text_color_button',
			[
				'label'     => esc_html__( 'Button Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tfimagebox:hover .tf-button'                => 'color: {{VALUE}};',
					'{{WRAPPER}} .tfimagebox:hover .tf-button i'              => 'color: {{VALUE}};',
					'{{WRAPPER}} .tfimagebox:hover .tf-button.has-line:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// /.End Container Style
	}

	protected function image_style() {
		// Start Image Style
		$this->start_controls_section(
			'section_style_image',
			[
				'label'     => esc_html__( 'Image', 'themesflat-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_showcase',
			[
				'label'     => esc_html__( 'Type', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'default'        => esc_html__( 'Default', 'themesflat-elementor' ),
					'circle'         => esc_html__( 'Circle', 'themesflat-elementor' ),
					'square'         => esc_html__( 'Square', 'themesflat-elementor' ),
					'circle-outline' => esc_html__( 'Circle Outline', 'themesflat-elementor' ),
					'square-outline' => esc_html__( 'Square Outline', 'themesflat-elementor' ),
				],
				'default'   => 'default',
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'      => esc_html__( 'Size', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .wrap-image-inner img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wrap_image_size',
			[
				'label'      => esc_html__( 'Wrap Image Size', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .wrap-image-inner'                                                                                      => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tfimagebox .wrap-image.square .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image.square-outline .wrap-image-inner' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'image_showcase!' => 'default'
				],
			]
		);

		$this->add_control(
			'image_border_width',
			[
				'label'      => esc_html__( 'Border Width', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .wrap-image-inner'              => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tfimagebox .wrap-image-spin-around:before' => 'width: calc(100% + 2 * {{SIZE}}{{UNIT}}); height: calc(100% + 2 * {{SIZE}}{{UNIT}}); border-width: {{SIZE}}{{UNIT}}; top: -{{SIZE}}{{UNIT}}; left: -{{SIZE}}{{UNIT}};',

				],
				'condition'  => [
					'image_showcase' => array( 'circle-outline', 'square-outline' )
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image-spin-around:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'image_showcase!' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .wrap-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'image_tabs' );

		$this->start_controls_tab(
			'image_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'image_background',
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .tfimagebox .wrap-image.circle .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image.square .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image-spin-around:before',
				'condition' => [
					'image_showcase' => [ 'circle', 'square' ]
				]
			]
		);

		$this->add_control(
			'border_image_color',
			[
				'label'     => esc_html__( 'Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .wrap-image.circle-outline .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image.square-outline .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image-spin-around:before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'image_showcase' => [ 'circle-outline', 'square-outline' ]
				]
			]
		);

		$this->add_control(
			'border_style_image',
			[
				'label'     => esc_html__( 'Border Type', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => [
					'solid'  => esc_html__( 'Solid', 'themesflat-elementor' ),
					'double' => esc_html__( 'Double', 'themesflat-elementor' ),
					'dotted' => esc_html__( 'Dotted', 'themesflat-elementor' ),
					'dashed' => esc_html__( 'Dashed', 'themesflat-elementor' ),
					'groove' => esc_html__( 'Groove', 'themesflat-elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .wrap-image.circle-outline .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image.square-outline .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image-spin-around:before' => 'border-style: {{VALUE}}',
				],
				'condition' => [
					'image_showcase' => [ 'circle-outline', 'square-outline' ]
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tfimagebox .wrap-image .wrap-image-inner',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'image_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'image_background_hover',
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .tfimagebox:hover .wrap-image.circle .wrap-image-inner, {{WRAPPER}} .tfimagebox:hover .wrap-image.square .wrap-image-inner, {{WRAPPER}} .tfimagebox:hover .wrap-image-spin-around:before',
				'condition' => [
					'image_showcase' => [ 'circle', 'square' ]
				]
			]
		);

		$this->add_control(
			'border_image_color_hover',
			[
				'label'     => esc_html__( 'Border Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tfimagebox:hover .wrap-image.circle-outline .wrap-image-inner, {{WRAPPER}} .tfimagebox:hover .wrap-image.square-outline .wrap-image-inner, {{WRAPPER}} .tfimagebox:hover .wrap-image-spin-around:before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'image_showcase' => [ 'circle-outline', 'square-outline' ]
				]
			]
		);

		$this->add_control(
			'border_style_image_hover',
			[
				'label'     => esc_html__( 'Border Type', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => [
					'solid'  => esc_html__( 'Solid', 'themesflat-elementor' ),
					'double' => esc_html__( 'Double', 'themesflat-elementor' ),
					'dotted' => esc_html__( 'Dotted', 'themesflat-elementor' ),
					'dashed' => esc_html__( 'Dashed', 'themesflat-elementor' ),
					'groove' => esc_html__( 'Groove', 'themesflat-elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tfimagebox:hover .wrap-image.circle-outline .wrap-image-inner, {{WRAPPER}} .tfimagebox:hover .wrap-image.square-outline .wrap-image-inner, {{WRAPPER}} .tfimagebox .wrap-image-spin-around:before' => 'border-style: {{VALUE}}',
				],
				'condition' => [
					'image_showcase' => [ 'circle-outline', 'square-outline' ]
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_hover_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tfimagebox:hover .wrap-image .wrap-image-inner',
			]
		);

		$this->add_control(
			'image_animation',
			[
				'label'   => esc_html__( 'Hover Animation', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'               => esc_html__( 'Default', 'themesflat-elementor' ),
					'right-to-left'         => esc_html__( 'Right To Left', 'themesflat-elementor' ),
					'left-to-right'         => esc_html__( 'Left To Right', 'themesflat-elementor' ),
					'top-to-bottom'         => esc_html__( 'Top To Bottom', 'themesflat-elementor' ),
					'bottom-to-top'         => esc_html__( 'Bottom To Top', 'themesflat-elementor' ),
					'spin-around'           => esc_html__( 'Spin Around', 'themesflat-elementor' ),
					'wrap-image-spin-around' => esc_html__( 'Wrap Image Spin Around', 'themesflat-elementor' ),
					'wrap-image-pop'         => esc_html__( 'Wrap Image Pop', 'themesflat-elementor' ),
					'image-scale'            => esc_html__( 'Image Scale', 'themesflat-elementor' ),
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// /.End Image Style
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
			'text_align',
			[
				'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'image'  => 'eimage-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'image'  => 'eimage-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'image'  => 'eimage-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themesflat-elementor' ),
						'image'  => 'eimage-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
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
				'selector' => '{{WRAPPER}} .tfimagebox .content .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .content .title, {{WRAPPER}} .tfimagebox .content .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'themesflat-elementor' ),
					'h2' => esc_html__( 'H2', 'themesflat-elementor' ),
					'h3' => esc_html__( 'H3', 'themesflat-elementor' ),
					'h4' => esc_html__( 'H4', 'themesflat-elementor' ),
					'h5' => esc_html__( 'H5', 'themesflat-elementor' ),
					'h6' => esc_html__( 'H6', 'themesflat-elementor' ),
				],
			]
		);

		$this->add_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .content .title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!' => ''
				],
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label'     => esc_html__( 'Description', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .tfimagebox .content .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .content .description, {{WRAPPER}} .tfimagebox .content .description a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();
		// /.End Content Style
	}

	protected function button_style() {
		// Start Button Style
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_align',
			[
				'label'   => esc_html__( 'Alignment', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'image'  => 'eimage-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'image'  => 'eimage-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'image'  => 'eimage-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themesflat-elementor' ),
						'image'  => 'eimage-text-align-justify',
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tfimagebox .tf-button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .tf-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .tf-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab( 'button_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			] );
		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .tf-button'                => 'color: {{VALUE}}',
					'{{WRAPPER}} .tfimagebox .tf-button i'              => 'color: {{VALUE}}',
					'{{WRAPPER}} .tfimagebox .tf-button svg'            => 'fill: {{VALUE}}',
					'{{WRAPPER}} .tfimagebox .tf-button.has-line:after' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .tfimagebox .tf-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tfimagebox .tf-button',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .tf-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_button_icon',
			[
				'label'     => esc_html__( 'Icon', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_button',
			[
				'label'            => esc_html__( 'Icon Button', 'themesflat-elementor' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'image_bt',
				'default'          => [
					'value'   => 'carenow-image-arrow-right-small',
					'library' => 'carenow_image',
				],
			]
		);

		$this->add_control(
			'button_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .tfimagebox .tf-button i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tfimagebox .tf-button svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label'   => esc_html__( 'Icon Position', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'bt_image_after',
				'options' => [
					'bt_image_before' => esc_html__( 'Before', 'themesflat-elementor' ),
					'bt_image_after'  => esc_html__( 'After', 'themesflat-elementor' ),
				],
			]
		);

		$this->add_control(
			'button_icon_spacer',
			[
				'label'      => esc_html__( 'Icon Spacer', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .tf-button.bt_image_before i'        => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tfimagebox .tf-button.bt_image_before svg'      => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tfimagebox .tf-button.bt_image_after i'         => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tfimagebox .tf-button.bt_image_after svg'       => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .tfimagebox .tf-button.bt_image_before i'   => 'margin-left: {{SIZE}}{{UNIT}};margin-right:0;',
					'.rtl {{WRAPPER}} .tfimagebox .tf-button.bt_image_before svg' => 'margin-left: {{SIZE}}{{UNIT}};margin-right:0;',
					'.rtl {{WRAPPER}} .tfimagebox .tf-button.bt_image_after i'    => 'margin-right: {{SIZE}}{{UNIT}};margin-left:0;',
					'.rtl {{WRAPPER}} .tfimagebox .tf-button.bt_image_after svg'  => 'margin-right: {{SIZE}}{{UNIT}};margin-left:0;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			] );

		$this->add_control(
			'button_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .tf-button:hover'                => 'color: {{VALUE}}',
					'{{WRAPPER}} .tfimagebox .tf-button:hover i'              => 'color: {{VALUE}}',
					'{{WRAPPER}} .tfimagebox .tf-button:hover svg'            => 'fill: {{VALUE}}',
					'{{WRAPPER}} .tfimagebox .tf-button.has-line:hover:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label'     => esc_html__( 'Background Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tfimagebox .tf-button:not(.btn):hover, {{WRAPPER}} .tfimagebox .tf-button.btn:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'button_border_hover',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tfimagebox .tf-button:hover',
			]
		);

		$this->add_control(
			'button_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox .tf-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'button'         => esc_html__( 'Elementor Button Effect', 'themesflat-elementor' ),
				]
			]
		);

		$this->add_control(
			'button_animation',
			[
				'label'     => esc_html__( 'Hover Animation', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'elementor-animation-push',
				'options'   => [
					'elementor-animation-grow'              => esc_html__( 'Grow', 'themesflat-elementor' ),
					'elementor-animation-shrink'            => esc_html__( 'Shrink', 'themesflat-elementor' ),
					'elementor-animation-pulse'             => esc_html__( 'Pulse', 'themesflat-elementor' ),
					'elementor-animation-pulse-grow'        => esc_html__( 'Pulse Grow', 'themesflat-elementor' ),
					'elementor-animation-pulse-shrink'      => esc_html__( 'Pulse Shrink', 'themesflat-elementor' ),
					'elementor-animation-push'              => esc_html__( 'Push', 'themesflat-elementor' ),
					'elementor-animation-pop'               => esc_html__( 'Pop', 'themesflat-elementor' ),
					'elementor-animation-bob'               => esc_html__( 'Bob', 'themesflat-elementor' ),
					'elementor-animation-hang'              => esc_html__( 'Hang', 'themesflat-elementor' ),
					'elementor-animation-skew'              => esc_html__( 'Skew', 'themesflat-elementor' ),
					'elementor-animation-wobble-vertical'   => esc_html__( 'Wobble Vertical', 'themesflat-elementor' ),
					'elementor-animation-wobble-horizontal' => esc_html__( 'Wobble Horizontal', 'themesflat-elementor' ),

				],
				'condition' => [
					'button_animation_options' => 'button',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// /.End Button Style
	}

	protected function hover_style() {
		// Start Design When Hover Style
		$this->start_controls_section(
			'section_style_background_overlay',
			[
				'label' => esc_html__( 'Design When Hover', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_effect_overlay',
			[
				'label' => esc_html__( 'Effect Overlay', 'themesflat-elementor' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'enable_overlay',
			[
				'label'        => esc_html__( 'Enable Overlay', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'background',
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .tfimagebox .overlay',
				'condition' => [
					'enable_overlay' => 'yes'
				]
			]
		);

		$this->add_control(
			'hover_style',
			[
				'label'     => esc_html__( 'Hover Style', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'fadein',
				'options'   => [
					'fadein'      => esc_html__( 'Fade In', 'themesflat-elementor' ),
					'from-left'   => esc_html__( 'From Left', 'themesflat-elementor' ),
					'from-top'    => esc_html__( 'From Top', 'themesflat-elementor' ),
					'from-right'  => esc_html__( 'From Right', 'themesflat-elementor' ),
					'from-bottom' => esc_html__( 'From Bottom', 'themesflat-elementor' ),
					'flip-box'    => esc_html__( 'Flip Box', 'themesflat-elementor' ),
				],
				'condition' => [
					'enable_overlay' => 'yes'
				]
			]
		);

		$this->add_control(
			'flip_box_height',
			[
				'label'      => esc_html__( 'Flip Box Height', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .container-widget' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'enable_overlay' => 'yes',
					'hover_style'    => 'flip-box'
				]
			]
		);

		$this->add_control(
			'flip_box_style',
			[
				'label'     => esc_html__( 'Flip Box Style', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'horizontal-rotation',
				'options'   => [
					'horizontal-rotation'         => esc_html__( 'Horizontal Rotation', 'themesflat-elementor' ),
					'reverse-horizontal-rotation' => esc_html__( 'Reverse Horizontal Rotation', 'themesflat-elementor' ),
					'vertical-rotation'           => esc_html__( 'Vertical Rotation', 'themesflat-elementor' ),
					'reverse-vertical-rotation'   => esc_html__( 'Reverse Vertical Rotation', 'themesflat-elementor' ),
				],
				'condition' => [
					'enable_overlay' => 'yes',
					'hover_style'    => 'flip-box'
				]
			]
		);

		$this->add_control(
			'enable_effect_hover_box',
			[
				'label'        => esc_html__( 'Effect Hover Box', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'No', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'heading_effect_border',
			[
				'label'     => esc_html__( 'Border', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'enable_effect_hover_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'effect_border_box',
				'label'     => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector'  => '{{WRAPPER}} .tfimagebox:hover',
				'condition' => [
					'enable_effect_hover_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'effect_border_radius_box',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tfimagebox:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'enable_effect_hover_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'heading_effect_translate',
			[
				'label'     => esc_html__( 'Translate Box', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_effect_hover_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'effect_translate',
			[
				'label'       => esc_html__( 'Translate', 'themesflat-elementor' ),
				'description' => esc_html__( 'ex: to Top (-10) or to Bottom (10)', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min'  => - 50,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .tfimagebox:hover' => '-webkit-transform: translateY( {{SIZE}}{{UNIT}} ); transform: translateY( {{SIZE}}{{UNIT}} );',
				],
				'condition'   => [
					'enable_effect_hover_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'heading_effect_shadow',
			[
				'label'     => esc_html__( 'Shadow Box', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_effect_hover_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'effect_box_shadow',
				'label'     => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector'  => '{{WRAPPER}} .tfimagebox:hover',
				'condition' => [
					'enable_effect_hover_box' => 'yes'
				]
			]
		);

		$this->end_controls_section();
		// /.End Design When Hover Style

	}


	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$migrated = isset( $settings['__fa4_migrated']['icon_button'] );
		$is_new   = empty( $settings['image_bt'] );

		$btn_animation = 'hover-default';
		if ( $settings['button_animation_options'] == 'button' ) {
			$btn_animation = 'hover-default ' . $settings['button_animation'];
		} elseif ( $settings['button_animation_options'] == 'button-overlay' ) {
			$btn_animation = 'btn ';
		}

		$target = $nofollow = '';
		if ( $settings['show_button'] == 'yes' ) {
			$target   = $settings['link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		}
		$image =  \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
		?>
		<?php if ( $settings['hover_style'] == 'flip-box' || $settings['hover_style'] == 'flip-box-3d' ) : ?>
			<div class="container-widget <?php echo esc_attr( $settings['hover_style'] ); ?> <?php echo esc_attr( $settings['flip_box_style'] ); ?>">
				<div class="tfimagebox flip-box-front <?php echo esc_attr( $settings['position'] ); ?>">
					<?php if ( $settings['enable_overlay'] == 'yes' ): ?>
						<div class="overlay <?php echo esc_attr( $settings['hover_style'] ); ?>"></div>
					<?php endif; ?>
						<div class="wrap-image <?php echo esc_attr( $settings['image_showcase'] ); ?>">
							<div class="wrap-image-inner <?php echo esc_attr( $settings['image_animation'] ); ?>">
								<?php echo $image;?>
							</div>
						</div>

					<div class="content">
						<<?php echo esc_attr( $settings['title_tag'] ); ?>
						class="title"><?php echo esc_attr( $settings['title_text'] ); ?></<?php echo esc_attr( $settings['title_tag'] ); ?>
					>
					<?php
					if ( $settings['description_text'] !== '' ) {
						echo sprintf( '<div class="description">%s</div>', $settings['description_text'] );
					}
					?>

					<?php if ( $settings['show_button'] == 'yes' ): ?>
						<div class="tf-button-container <?php echo esc_attr( $settings['button_align'] ); ?>">
							<a href="<?php echo esc_url( $settings['link']['url'] ) ?>"
							   class="tf-button <?php echo esc_attr( $settings['button_icon_position'] ); ?> <?php echo esc_attr( $btn_animation ); ?>" <?php echo esc_attr( $target ) . esc_attr( $nofollow ) ?> >
								<?php
								if ( $settings['button_icon_position'] == 'bt_image_before' ) {
									if ( $is_new || $migrated ) {
										if ( isset( $settings['icon_button']['value']['url'] ) ) {
											\Elementor\Images_Manager::render_image( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
										} else {
											echo '<i class="' . esc_attr( $settings['icon_button']['value'] ) . '" aria-hidden="true"></i>';
										}
									} else {
										echo '<i class="' . esc_attr( $settings['image_bt'] ) . ' aria-hidden="true""></i>';
									}
								}

								if ( $settings['button_text'] != '' ) {
									echo esc_attr( $settings['button_text'] );
								}

								if ( $settings['button_icon_position'] == 'bt_image_after' ) {
									if ( $is_new || $migrated ) {
										if ( isset( $settings['icon_button']['value']['url'] ) ) {
											\Elementor\Images_Manager::render_image( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
										} else {
											echo '<i class="' . esc_attr( $settings['icon_button']['value'] ) . '" aria-hidden="true"></i>';
										}
									} else {
										echo '<i class="' . esc_attr( $settings['image_bt'] ) . ' aria-hidden="true""></i>';
									}
								}

								?>
							</a>
						</div>
					<?php endif; ?>

				</div>
			</div>

			<div class="tfimagebox flip-box-back <?php echo esc_attr( $settings['position'] ); ?>">
				<?php if ( $settings['enable_overlay'] == 'yes' ): ?>
					<div class="overlay <?php echo esc_attr( $settings['hover_style'] ); ?>"></div>
				<?php endif; ?>
					<div class="wrap-image <?php echo esc_attr( $settings['image_showcase'] ); ?>">
						<div class="wrap-image-inner <?php echo esc_attr( $settings['image_animation'] ); ?>">
							<?php echo $image;?>
						</div>
					</div>

				<div class="content">
					<<?php echo esc_attr( $settings['title_tag'] ); ?>
					class="title"><?php echo esc_attr( $settings['title_text'] ); ?></<?php echo esc_attr( $settings['title_tag'] ); ?>
				>
				<?php
				if ( $settings['description_text'] !== '' ) {
					echo sprintf( '<div class="description">%s</div>', $settings['description_text'] );
				}
				?>
				<?php if ( $settings['show_button'] == 'yes' ): ?>
					<div class="tf-button-container <?php echo esc_attr( $settings['button_align'] ); ?>">
						<a href="<?php echo esc_url( $settings['link']['url'] ) ?>"
						   class="tf-button <?php echo esc_attr( $settings['button_icon_position'] ); ?> <?php echo esc_attr( $btn_animation ); ?>" <?php echo esc_attr( $target ) . esc_attr( $nofollow ) ?>>
							<?php
							if ( $settings['button_icon_position'] == 'bt_image_before' ) {
								if ( $is_new || $migrated ) {
									if ( isset( $settings['icon_button']['value']['url'] ) ) {
										\Elementor\Images_Manager::render_image( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
									} else {
										echo '<i class="' . esc_attr( $settings['icon_button']['value'] ) . '" aria-hidden="true"></i>';
									}
								} else {
									echo '<i class="' . esc_attr( $settings['image_bt'] ) . ' aria-hidden="true""></i>';
								}
							}

							if ( $settings['button_text'] != '' ) {
								echo esc_attr( $settings['button_text'] );
							}

							if ( $settings['button_icon_position'] == 'bt_image_after' ) {
								if ( $is_new || $migrated ) {
									if ( isset( $settings['icon_button']['value']['url'] ) ) {
										\Elementor\Images_Manager::render_image( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
									} else {
										echo '<i class="' . esc_attr( $settings['icon_button']['value'] ) . '" aria-hidden="true"></i>';
									}
								} else {
									echo '<i class="' . esc_attr( $settings['image_bt'] ) . ' aria-hidden="true""></i>';
								}
							}

							?>
						</a>
					</div>
				<?php endif; ?>
			</div>
			</div>
			</div>
		<?php else: ?>
			<div class="tfimagebox <?php echo esc_attr( $settings['position'] ); ?>">
				<?php if ( $settings['enable_overlay'] == 'yes' ): ?>
					<div class="overlay <?php echo esc_attr( $settings['hover_style'] ); ?>"></div>
				<?php endif; ?>
					<div class="wrap-image <?php echo esc_attr( $settings['image_showcase'] ); ?>">
						<div class="wrap-image-inner <?php echo esc_attr( $settings['image_animation'] ); ?>">
							<?php echo $image;?>
						</div>
					</div>

				<div class="content">
					<<?php echo esc_attr( $settings['title_tag'] ); ?>
					class="title"><?php echo esc_attr( $settings['title_text'] ); ?></<?php echo esc_attr( $settings['title_tag'] ); ?>
				>
				<?php
				if ( $settings['description_text'] !== '' ) {
					echo sprintf( '<div class="description">%s</div>', $settings['description_text'] );
				}
				?>

				<?php if ( $settings['show_button'] == 'yes' ): ?>
					<div class="tf-button-container <?php echo esc_attr( $settings['button_align'] ); ?>">
						<a href="<?php echo esc_url( $settings['link']['url'] ) ?>"
						   class="tf-button <?php echo esc_attr( $settings['button_icon_position'] ); ?> <?php echo esc_attr( $btn_animation ); ?>" <?php echo esc_attr( $target ) . esc_attr( $nofollow ) ?> >
							<?php
							if ( $settings['button_icon_position'] == 'bt_image_before' ) {
								if ( $is_new || $migrated ) {
									if ( isset( $settings['icon_button']['value']['url'] ) ) {
										\Elementor\Images_Manager::render_image( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
									} else {
										echo '<i class="' . esc_attr( $settings['icon_button']['value'] ) . '" aria-hidden="true"></i>';
									}
								} else {
									echo '<i class="' . esc_attr( $settings['image_bt'] ) . ' aria-hidden="true""></i>';
								}
							}

							if ( $settings['button_text'] != '' ) {
								echo esc_attr( $settings['button_text'] );
							}

							if ( $settings['button_icon_position'] == 'bt_image_after' ) {
								if ( $is_new || $migrated ) {
									if ( isset( $settings['icon_button']['value']['url'] ) ) {
										\Elementor\Images_Manager::render_image( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
									} else {
										echo '<i class="' . esc_attr( $settings['icon_button']['value'] ) . '" aria-hidden="true"></i>';
									}
								} else {
									echo '<i class="' . esc_attr( $settings['image_bt'] ) . ' aria-hidden="true""></i>';
								}
							}

							?>
						</a>
					</div>
				<?php endif; ?>

			</div>
			</div>
		<?php
		endif;
	}

}