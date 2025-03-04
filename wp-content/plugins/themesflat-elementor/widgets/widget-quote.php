<?php

class TFQuote_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tfquote';
	}

	public function get_title() {
		return esc_html__( 'TF Quote', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-blockquote';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}


	protected function register_controls() {
		// Start Image        
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . "assets/img/placeholder.jpg",
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'include' => [],
				'default' => 'full',
			]
		);

		$this->end_controls_section();
		// /.End Image

		// Start Content
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Title', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Cosmetic Dentistry', 'themesflat-elementor' ),
			]
		);


		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => 'The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog MTV quiz graced',
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// /.End Content

		// Start Content Style
		$this->start_controls_section(
			'section_style_wrapper',
			[
				'label' => esc_html__( 'Wrapper', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-quote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wrapper_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wrapper_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-quote' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		// Start Image Style
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-quote .image, {{WRAPPER}} .tf-quote .image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_padding',
			[
				'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-quote .image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-quote .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// /.End Image Style

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
					'{{WRAPPER}} .tf-quote .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tf-quote .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_control(
			'wrap_heading',
			[
				'label'   => esc_html__( 'Wrap Heading', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h4',
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

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-quote .title',
			]
		);


		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-quote .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-quote .title:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacer',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-quote .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label'    => esc_html__( 'Typography', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-quote .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-quote .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_spacer',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-quote .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// /.End Content Style
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$image = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );

		$html_title  = $html_description = $html_image_overlay = $button = $icon_button = '';
		$image_quote = '<div class="image-quote"><img src="' . esc_url( URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . 'assets/img/comma.png' ) . '"  alt=""></div>';


		if ( $image ) {
			$image = sprintf( '<div class="image">%1$s %2$s %3$s</div>', $image, $html_image_overlay, $image_quote );
		}

		if ( $settings['title'] != '' ) {
			$html_title = sprintf( '<%2$s class="title">%1$s</%2$s>', $settings['title'], $settings['wrap_heading'] );
		}

		if ( $settings['description'] != '' ) {
			$html_description = sprintf( '<div class="description">%1$s</div>', $settings['description'] );
		}

		echo sprintf(
			'<div class="tf-quote"> 
                %1$s
                <div class="content">               
					%2$s
	                %3$s
				</div>
            </div>',
			$image,
			$html_title,
			$html_description
		);

	}

}