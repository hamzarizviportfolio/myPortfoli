<?php

class TFTeam_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-team';
	}

	public function get_title() {
		return esc_html__( 'TF Team', 'themesflat-elementor' );
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

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . "assets/img/default-team.jpg",
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'default' => 'full',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Watson Mendela', 'themesflat-elementor' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// /.End Tab Setting

		// Start Social Icons
		$this->start_controls_section( 'section_social_icon',
			[
				'label' => esc_html__( 'Social Icons', 'themesflat-elementor' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label'            => esc_html__( 'Icon', 'themesflat-elementor' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default'          => [
					'value'   => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
				'recommended'      => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'elementor',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mix',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px',
					],
					'fa-solid'  => [
						'envelope',
						'link',
						'rss',
					],
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'themesflat-elementor' ),
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
			'social_icon_list',
			[
				'label'       => esc_html__( 'Social Icons', 'themesflat-elementor' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'social_icon' => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
			]
		);

		$this->end_controls_section();
		// /.End Social Icons
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
				'label'   => esc_html__( 'Hover Image Effect', 'themesflat-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''             => esc_html__( 'Choose Animation', 'themesflat-elementor' ),
					'gray-scale'   => esc_html__( 'Gray Scale', 'themesflat-elementor' ),
					'opacity'      => esc_html__( 'Opacity', 'themesflat-elementor' ),
					'shine'        => esc_html__( 'Shine', 'themesflat-elementor' ),
					'circle'       => esc_html__( 'Circle', 'themesflat-elementor' ),
					'flash'        => esc_html__( 'Flash', 'themesflat-elementor' ),
					'zoom-in'      => esc_html__( 'Zoom In', 'themesflat-elementor' ),
					'zoom-out'     => esc_html__( 'Zoom Out', 'themesflat-elementor' ),
					'rotate'       => esc_html__( 'Rotate', 'themesflat-elementor' ),
					'slide-left'   => esc_html__( 'Slide Left', 'themesflat-elementor' ),
					'slide-right'  => esc_html__( 'Slide Right', 'themesflat-elementor' ),
					'slide-top'    => esc_html__( 'Slide Top', 'themesflat-elementor' ),
					'slide-bottom' => esc_html__( 'Slide Bottom', 'themesflat-elementor' ),
				]
			]
		);
		$this->add_control(
			'border_radius_image',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-team .image-team .inner-image, {{WRAPPER}} .tf-team .image-team img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$settings      = $this->get_settings_for_display();
		$hover_classes = '';
		if ( ! empty( $settings['hover_image_animation'] ) ) {
			$hover_classes = 'tf-hover-' . $settings['hover_image_animation'];
		}

		$this->add_render_attribute( 'tf_team', [
			'id'         => "tf-team-{$this->get_id()}",
			'class'      => [ 'tf-team','tf-team-wrapper', $hover_classes ],
			'data-tabid' => $this->get_id()
		] );

		$title = $title = $social_html = $social = $image_html = $content = '';

		if ( $settings['title'] != '' ) {
			$title = '<h3 class="title">' . $settings['title'] . '</h3>';
		}

		foreach ( $settings['social_icon_list'] as $index => $item ) {
			$target   = $item['link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';

			$social .= '<a href="' . $item['link']['url'] . '" ' . $target . $nofollow . '>' . \Elementor\Addon_Elementor_Icon_manager_zoyot::render_icon( $item['social_icon'] ) . '</a>';
		}
		$social_html = '<div class="social">' . $social . '</div>';

		$image = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );

		$image_html = sprintf( '<div class="image-team">
									%1$s									
								</div>', $image );

		$content = sprintf( '<div class="wrap-team">
								%1$s
								<div class="content">
								%2$s
								%3$s
								</div>
							</div>', $image_html, $title, $social_html );

		echo sprintf(
			'<div %1$s> 
				%2$s                
            </div>',
			$this->get_render_attribute_string( 'tf_team' ),
			$content
		);

	}

}