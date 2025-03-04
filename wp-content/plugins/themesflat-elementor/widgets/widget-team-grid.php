<?php

use Elementor\Controls_Manager;

class TFTeamGrid_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-team-grid';
	}

	public function get_title() {
		return esc_html__( 'TF Team Grid', 'themesflat-elementor' );
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

	protected function register_controls() {
		$this->setting();
		$this->register_layout();
		$this->general_style();
		$this->image_style();
		$this->content_style();
		$this->title_style();
		$this->social_style();
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

	protected function register_layout() {

		// Start Carousel
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'themesflat-elementor' ),
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
				'{{WRAPPER}} .tf-team-grid .item' => '--tf-team-gap: {{VALUE}}px;',
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
			'item_margin',
			[
				'label'      => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-team-grid .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		$this->end_controls_section();
	}

	protected function render( $instance = [] ) {
		$settings       = $this->get_settings_for_display();

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
		$hover_classes='';
		if ( ! empty( $settings['hover_image_animation'] ) ) {
			$hover_classes = 'tf-hover-' . $settings['hover_image_animation'];
		}

		$this->add_render_attribute( 'tf_team', [
			'id'                 => "tf-team-{$this->get_id()}",
			'class'              => [ 'tf-team-grid row','tf-team-wrapper',$hover_classes ],
			'data-tabid'         => $this->get_id(),
		] );
		?>
        <div <?php echo $this->get_render_attribute_string( 'tf_team' ) ?>>
			<?php foreach ( $settings['team_list'] as $item ):
				?>
                <div class="item <?php echo esc_attr($item_classes)?>">
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