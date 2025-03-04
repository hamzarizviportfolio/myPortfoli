<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class TF_Adv_Video_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tf_adv_video_popup';
	}

	public function get_title() {
		return esc_html__( 'TF Advanced Video', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-youtube';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	public function get_style_depends() {
		return [ 'magnific-popup', 'tf-video', 'tf-adv-video' ];
	}

	public function get_script_depends() {
		return [ 'magnific-popup', 'tf-video', 'tf-adv-video' ];
	}

	protected function register_controls() {
		$this->register_section_repeater();
		$this->slider_option();
		$this->register_section_style_video();
		$this->register_section_style_dot();
		$this->register_section_style_heading();
	}

	protected function register_section_repeater() {
		$this->start_controls_section(
			'list_video',
			[
				'label' => esc_html__( 'List Video', 'themesflat-elementor' )
			]
		);

		$repeater = new Repeater();
		$this->register_section_video( $repeater );
		$this->register_section_heading( $repeater );
		$this->default_repeater( $repeater );
		$this->end_controls_section();
	}

	protected function register_section_heading( $repeater ) {
		$repeater->add_control( 'heading_title', [
			'label'       => esc_html__( 'Heading', 'themesflat-elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => esc_html__( 'Enter your title', 'themesflat-elementor' ),
			'separator'   => 'before',
			'description' => esc_html__( 'Wrap any words with &lt;mark&gt;&lt;/mark&gt; tag to make them highlight.', 'themesflat-elementor' ),
		] );

		$repeater->add_control( 'heading_description', [
			'label'       => esc_html__( 'Description', 'themesflat-elementor' ),
			'placeholder' => esc_html__( 'Enter your description', 'themesflat-elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
		] );

		$repeater->add_control( 'heading_sub_title_text', [
			'label'   => esc_html__( 'Sub Title', 'themesflat-elementor' ),
			'type'    => Controls_Manager::TEXTAREA,
			'dynamic' => [
				'active' => true,
			],
		] );
	}

	protected function register_section_video( $repeater ) {
		$repeater->add_control(
			'video_type',
			[
				'label'   => esc_html__( 'Source', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => [
					'youtube' => esc_html__( 'YouTube', 'themesflat-elementor' ),
					'vimeo'   => esc_html__( 'Vimeo', 'themesflat-elementor' ),
				],
			]
		);
		$repeater->add_control(
			'youtube_url',
			[
				'label'       => esc_html__( 'Link', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your URL', 'themesflat-elementor' ) . ' (YouTube)',
				'default'     => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
				'condition'   => [
					'video_type' => 'youtube',
				],
			]
		);

		$repeater->add_control(
			'vimeo_url',
			[
				'label'       => esc_html__( 'Link', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your URL', 'themesflat-elementor' ) . ' (Vimeo)',
				'default'     => 'https://vimeo.com/235215203',
				'label_block' => true,
				'condition'   => [
					'video_type' => 'vimeo',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_background',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .tf-video-popup',
			]
		);
	}

	protected function default_repeater( $repeater ) {
		$this->add_control(
			'video_repeater',
			[
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ heading_title }}}',
			]
		);
	}

	protected function slider_option() {
		$this->start_controls_section( 'section_slider_option',
			[
				'label' => esc_html__( 'Slider Option', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'slider_auto_play',
			[
				'label'        => esc_html__( 'Auto Play', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
			]
		);

		$this->add_responsive_control(
			'slider_autoplaySpeed',
			array(
				'label'     => esc_html__( 'Auto Play Speed', 'themesflat-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'condition' => [
					'slider_auto_play' => 'yes',
				],
			)
		);
		$this->add_control(
			'slider_infinite',
			[
				'label'        => esc_html__( 'Infinite', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'slider_fade',
			[
				'label'        => esc_html__( 'Fade', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
			]
		);

		$this->add_responsive_control(
			'slider_item_dot_show',
			array(
				'label' => esc_html__( 'Thumbnail Show', 'themesflat-elementor' ),
				'type'  => Controls_Manager::NUMBER,
			)
		);

		$this->end_controls_section();
	}


	protected function render( $instance = [] ) {
		$settings      = $this->get_settings_for_display();
		$video_classes = array(
			'tf-adv-video',
		);

		$slick_options = array(
			'infinite'      => $settings['slider_infinite'] === 'yes',
			'autoplay'      => $settings['slider_auto_play'] === 'yes',
			'fade'          => $settings['slider_fade'] === 'yes',
			'autoplaySpeed' => intval( $settings['slider_autoplaySpeed'] ),
		);


		$mobile_breakpoint_value = \Elementor\Plugin::$instance->breakpoints->get_breakpoints( 'mobile' )->get_value();
		$tablet_breakpoint_value = \Elementor\Plugin::$instance->breakpoints->get_breakpoints( 'tablet' )->get_value();

		$slides_to_show = empty( $settings['slider_item_dot_show'] ) ? 5 : $settings['slider_item_dot_show'];
		if ( isset( $settings['slider_item_dot_show_tablet'] ) && $settings['slider_item_dot_show_tablet'] != '' ) {
			$slides_to_show_tablet = $settings['slider_item_dot_show_tablet'];
		} else {
			$slides_to_show_tablet = $slides_to_show;
		}
		if ( isset( $settings['slider_item_dot_show_mobile'] ) && $settings['slider_item_dot_show_mobile'] != '' ) {
			$slides_to_show_mobile = $settings['slider_item_dot_show_mobile'];
		} else {
			$slides_to_show_mobile = $slides_to_show_tablet;
		}

		$tablet_settings = array(
			'slidesToShow' => intval( $slides_to_show_tablet ),
		);

		$mobile_settings = array(
			'slidesToShow' => intval( $slides_to_show_mobile ),
		);

		$dot_options = array(
			'slidesToShow' => $slides_to_show,
		);

		$responsive                = array(
			array(
				'breakpoint' => ( $tablet_breakpoint_value + 1 ),
				'settings'   => $tablet_settings
			),
			array(
				'breakpoint' => ( $mobile_breakpoint_value + 1 ),
				'settings'   => $mobile_settings
			)
		);
		$dot_options['responsive'] = $responsive;

		$this->add_render_attribute( 'video_attr', 'class', $video_classes );
		$this->add_render_attribute( 'main_attr', [
			'class'              => 'tf-adv-video-main',
			'data-slick-options' => json_encode( $slick_options ),
		] );

		$this->add_render_attribute( 'dot_attr', [
			'class'            => 'tf-adv-video-dot',
			'data-dot-options' => json_encode( $dot_options )
		] );
		?>
        <div <?php echo $this->get_render_attribute_string( 'video_attr' ); ?>>
            <div <?php echo $this->get_render_attribute_string( 'main_attr' ); ?>>
				<?php foreach ( $settings['video_repeater'] as $index => $item ) {
					$key_item_classes        = $this->get_repeater_setting_key( 'video_repeater_classes', 'video_repeater', $index );
					$video_attr_item_classes = array(
						'tf-adv-video-item',
						'elementor-repeater-item-' . $item['_id'],
					);
					$this->add_render_attribute( $key_item_classes, 'class', $video_attr_item_classes );

					?>
                    <div <?php echo $this->get_render_attribute_string( $key_item_classes ); ?>>
						<?php $this->render_heading( $item ) ?>
						<?php $this->render_video( array(
							'class' => 'tf-video-popup tf-video-popup-' . $this->get_id(),
                            'data_tabid'=>$this->get_id(),
                            'url'=>$item['video_type'] . '_url'
						) ) ?>
                    </div>
				<?php } ?>
            </div>
            <div <?php echo $this->get_render_attribute_string( 'dot_attr' ); ?>>
				<?php foreach ( $settings['video_repeater'] as $index => $item ) : ?>
					<?php
					$key_item_classes        = $this->get_repeater_setting_key( 'video_repeater_dot_classes', 'video_repeater', $index );
					$video_attr_item_classes = array(
						'tf-adv-video-dot-item',
						'elementor-repeater-item-' . $item['_id'],
					);
					$this->add_render_attribute( $key_item_classes, 'class', $video_attr_item_classes );
					?>
                    <div <?php echo $this->get_render_attribute_string( $key_item_classes ); ?>>
						<?php $this->render_video(  array(
							'class' => 'tf-video-popup tf-video-popup-' . $this->get_id(),
							'data_tabid'=>$this->get_id(),
							'url'=>$item['video_type'] . '_url'
						) ) ?>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
		<?php
	}

	protected function register_section_style_video() {
		$this->start_controls_section( 'section_style_video',
			[
				'label' => esc_html__( 'Video', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'video_width',
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
					'{{WRAPPER}} .tf-adv-video-main .popup-video' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'video_height',
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
					'{{WRAPPER}} .tf-adv-video-main  .popup-video' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .tf-video-popup .popup-video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'video_btn_tabs' );

		$this->start_controls_tab(
			'video_btn_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'video_btn_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-video-popup .video-icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'video_btn_background',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-video-popup .video-icon',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'tf_border',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-video-popup .popup-video',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'video_btn_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'video_btn_color_hover',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-video-popup .video-icon:hover' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'video_btn_background_hover',
				'label'    => esc_html__( 'Background', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-video-popup .video-icon:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'tf_border_hover',
				'label'    => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-video-popup .popup-video:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_section_style_dot() {
		$this->start_controls_section( 'section_style_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail', 'themesflat-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control( 'section_style_thumbnail_spacing', [
			'label'      => esc_html__( 'Spacing', 'themesflat-elementor' ),
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
				'{{WRAPPER}} .tf-adv-video-dot' => 'margin-top : {{SIZE}}{{UNIT}} !important',
			],
		] );

		$this->add_control(
			'section_style_thumbnail_overlay',
			[
				'label'     => esc_html__( 'Overlay', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'before',
				'selectors' => [ '{{WRAPPER}} .tf-adv-video-dot .tf-video-popup:before' => 'background: {{VALUE}};' ],
			]
		);

		$this->end_controls_section();

	}

	protected function register_section_style_heading() {
		$this->start_controls_section( 'heading_wrapper_style_section', [
			'tab'   => Controls_Manager::TAB_STYLE,
			'label' => esc_html__( 'Heading Wraaper', 'themesflat-elementor' ),
		] );

		$this->add_responsive_control(
			'heading_align',
			[
				'label'        => esc_html__( 'Text Align', 'themesflat-elementor' ),
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
			]
		);

		$this->add_responsive_control( 'heading_max_width', [
			'label'          => esc_html__( 'Max Width', 'themesflat-elementor' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'size_units'     => [ 'px', '%' ],
			'range'          => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 400,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .tf-heading' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->end_controls_section();
		$this->start_controls_section( 'heading_title_style_section', [
			'label' => esc_html__( 'Heading', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'heading_title_margin', [
			'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
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

		$this->end_controls_section();


		$this->start_controls_section( 'heading_description_style_section', [
			'label' => esc_html__( 'Description', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_description_typography',
				'selector' => '{{WRAPPER}} .tf-heading-description',
			]
		);

		$this->add_control(
			'heading_description_text_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .tf-heading-description' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control( 'heading_description_margin', [
			'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .tf-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
			],
		] );
		$this->end_controls_section();


		$this->start_controls_section( 'heading_sub_title_style_section', [
			'label' => esc_html__( 'Sub Heading', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

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

	protected function render_heading( $item ) {
		if ( $item['heading_sub_title_text'] == '' && $item['heading_title'] == '' && $item['heading_description'] == '' ) {
			return;
		}
		?>
        <div class="tf-heading-inner">
            <div class="tf-heading">
				<?php
				if ( $item['heading_sub_title_text'] !== '' ) {
					?>
                    <h6 class="tf-heading-sub-title"><?php echo wp_kses_post( $item['heading_sub_title_text'] ) ?></h6>
					<?php
				}
				if ( $item['heading_title'] !== '' ) {
					?>
                    <h4 class="tf-heading-title"><?php echo wp_kses_post( $item['heading_title'] ) ?></h4>
					<?php
				}
				if ( $item['heading_description'] !== '' ) {
					?>
                    <div class="tf-heading-description"><?php echo wp_kses_post( $item['heading_description'] ) ?></div>
					<?php
				}
				?>
            </div>
        </div>
		<?php
	}

	protected function render_video( $item ) {
		extract($item);
		?>
        <div class="<?php echo esc_attr($class)?>" data-tabid="<?php echo esc_attr($data_tabid)?>">
            <div class="wrap-icon">
                <a class="video-icon popup-video" href="<?php echo esc_url( $url ) ?>">
                    <i class="fas fa-play"></i>
                </a>
            </div>
        </div>
		<?php
	}
}