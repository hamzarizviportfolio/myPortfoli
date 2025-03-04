<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Repeater;

class TFSocialIcon_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tfsocialicon';
	}

	public function get_title() {
		return esc_html__( 'TF Social Icon', 'themesflat-elementor' );
	}

	public function get_icon() {
		return 'eicon-social-icons';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	protected function register_controls() {
		$this->register_section_content();
		$this->register_section_icon();
	}


	private function register_section_content() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Social Icon', 'themesflat-elementor' )
			]
		);

		$this->add_control(
			'social_icon_shape',
			[
				'label'   => esc_html__( 'Shape', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => [
					'classic' => esc_html__( 'Classic', 'themesflat-elementor' ),
					'text'    => esc_html__( 'Text', 'themesflat-elementor' ),
					'rounded' => esc_html__( 'Rounded', 'themesflat-elementor' ),
					'square'  => esc_html__( 'Square', 'themesflat-elementor' ),
					'circle'  => esc_html__( 'Circle', 'themesflat-elementor' ),
				],
			]
		);

		$this->add_control(
			'social_icon_outline',
			[
				'label'        => esc_html__( 'Use Outline', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => '',
				'conditions'   => [
					'terms' => [
						[
							'name'     => 'social_icon_shape',
							'operator' => 'in',
							'value'    => [
								'rounded',
								'square',
								'circle',
							]
						]
					]
				]
			]
		);


		$this->add_control(
			'social_size',
			[
				'label'   => esc_html__( 'Size', 'themesflat-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => array(
					'xs' => esc_html__( 'Extra Small', 'themesflat-elementor' ),
					'sm' => esc_html__( 'Small', 'themesflat-elementor' ),
					'md' => esc_html__( 'Medium', 'themesflat-elementor' ),
					'lg' => esc_html__( 'Large', 'themesflat-elementor' ),
					'xl' => esc_html__( 'Extra Large', 'themesflat-elementor' ),
				),
			]
		);

		$this->add_control(
			'social_switcher_tooltip',
			[
				'label'        => esc_html__( 'Use Tooltip', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'social_position',
			[
				'label'     => esc_html__( 'Position', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'top'    => esc_html__( 'Top', 'themesflat-elementor' ),
					'bottom' => esc_html__( 'Bottom', 'themesflat-elementor' ),
					'left'   => esc_html__( 'Left', 'themesflat-elementor' ),
					'right'  => esc_html__( 'Right', 'themesflat-elementor' ),
				),
				'condition' => [
					'social_switcher_tooltip' => 'yes'
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label'            => esc_html__( 'Icon', 'themesflat-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'label_block'      => true,
				'default'          => [
					'value'   => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
			]
		);

		$repeater->add_control(
			'social_icon_link',
			[
				'label'       => esc_html__( 'Link', 'themesflat-elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'is_external' => 'true',
				],
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'your-link', 'themesflat-elementor' ),
			]
		);

		$repeater->add_control( 'social_title', [
			'label'       => esc_html__( 'Custom Text', 'themesflat-elementor' ),
			'placeholder' => esc_html__( 'Title Social', 'themesflat-elementor' ),
			'default'     => '',
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'label_block' => true,
		] );

		$repeater->add_control(
			'social_icon_switcher',
			[
				'label'        => esc_html__( 'Custom Color', 'themesflat-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => '',
				'description'  => esc_html__( 'Please enable if you want to customize color', 'themesflat-elementor' ),
			]
		);

		$repeater->add_control(
			'social_icon_item_color',
			[
				'label'     => esc_html__( 'Text Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}} !important'
				],
				'condition' => [
					'social_icon_switcher' => 'yes'
				],
			]
		);

		$repeater->add_control(
			'social_icon_item_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.tf-social-outline)' => 'background-color: {{VALUE}}!important'
				],
				'condition' => [
					'social_icon_switcher' => 'yes'
				],
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label'       => esc_html__( 'Social Icons', 'themesflat-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'social_icon' => [
							'value'   => 'fab fa-facebook',
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
							'value'   => 'fab fa-linkedin',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social_title, true )}}}',
			]
		);

		$this->add_responsive_control(
			'social_icon_align',
			[
				'label'        => esc_html__( 'Alignment', 'themesflat-elementor' ),
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
			]
		);

		$this->end_controls_section();
	}

	private function register_section_icon() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'themesflat-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'social_icon_size',
			[
				'label'     => esc_html__( 'Size', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-social-icons li' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_width',
			[
				'label'      => esc_html__( 'Width', 'themesflat-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'selectors'  => [
					'{{WRAPPER}} .tf-social-icons li' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'social_icon_shape',
							'operator' => 'in',
							'value'    => [
								'rounded',
								'square',
								'circle',
							]
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-social-icons li + li' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_spacing',
			[
				'label'     => esc_html__( 'Spacing Text', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-text-social' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'social_icon_shape' => 'text' ]
			]
		);

		$this->add_responsive_control(
			'border_outline_width',
			[
				'label'     => esc_html__( 'Border Width', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-social-icons li' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'social_icon_outline' => 'yes' ]
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tf-social-icons li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'social_icon_shape',
							'operator' => 'in',
							'value'    => [
								'rounded',
								'square',
								'circle',
							]
						]
					]
				]
			]
		);

		$this->start_controls_tabs( 'tabs_icon_social',
			[
				'separator' => 'before',
			]
		);

		$this->start_controls_tab(
			'tab_icon_social_normal',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			]
		);
		$this->add_control(
			'social_icon_style_color',
			[
				'label'     => esc_html__( 'Text Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-social-icons li' => 'color: {{VALUE}} !important;',
				],
			]
		);


		$this->add_control(
			'social_icon_style_bg_color',
			[
				'label'      => esc_html__( 'BackGround Color', 'themesflat-elementor' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '',
				'selectors'  => [
					'{{WRAPPER}} .tf-social-icons li' => 'background-color: {{VALUE}} !important;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'social_icon_shape',
							'operator' => 'in',
							'value'    => [
								'rounded',
								'square',
								'circle',
							],
						],
						[
							'name'     => 'social_icon_outline',
							'operator' => '==',
							'value'    => '',
						]
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'       => 'image_border',
				'selector'   => '{{WRAPPER}} .tf-social-icons li',
				'conditions' => [
					'terms' => [
						[
							'name'     => 'social_icon_shape',
							'operator' => 'in',
							'value'    => [
								'rounded',
								'square',
								'circle',
							]
						],
						[
							'name'     => 'social_icon_outline',
							'operator' => '==',
							'value'    => '',
						]
					]
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_icon_social_hover',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
		);

		$this->add_control(
			'social_style_color_hover',
			[
				'label'     => esc_html__( 'Text Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-social-icons li:hover' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'social_icon_outline' => ''
				],
			]
		);


		$this->add_control(
			'social_style_bg_color_hover',
			[
				'label'      => esc_html__( 'BackGround Color', 'themesflat-elementor' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '',
				'selectors'  => [
					'{{WRAPPER}} .tf-social-icons li:hover' => 'background-color: {{VALUE}} !important;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'social_icon_shape',
							'operator' => 'in',
							'value'    => [
								'rounded',
								'square',
								'circle',
							],
						],
						[
							'name'     => 'social_icon_outline',
							'operator' => '==',
							'value'    => '',
						]
					]
				]
			]
		);

		$this->add_control(
			'social_icon_border_hover',
			[
				'label'      => esc_html__( 'Border Color', 'themesflat-elementor' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .tf-social-icons li:hover' => 'border-color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'social_icon_shape',
							'operator' => 'in',
							'value'    => [
								'rounded',
								'square',
								'circle',
							]
						],
						[
							'name'     => 'social_icon_outline',
							'operator' => '==',
							'value'    => '',
						]
					]
				]
			]
		);

		$this->add_control(
			'socail_icon_filter',
			[
				'label'     => esc_html__( 'Filter', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0.8,
						'max'  => 1.5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-social-icons li:hover' => '-webkit-filter:brightness({{SIZE}});filter: brightness({{SIZE}});'
				]
			]
		);

		$this->add_control(
			'social_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'themesflat-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tab();

		$this->end_controls_section();
	}

	public function render() {
		$social_items_color = $social_items_bg = $social_animation = $social_icon_outline = $social_id = '';

		$settings            = $this->get_settings_for_display();
		$social_icon_classes = array(
			'tf-social-icons',
			'tf-social-' . $settings['social_icon_shape'],
			'tf-social-' . $settings['social_size'],
		);

		$this->add_render_attribute( 'social_icon', 'class', $social_icon_classes );

		if ( ! empty( $settings['social_hover_animation'] ) ) {
			$social_animation = 'elementor-animation-' . $settings['social_hover_animation'];
		}

		if ( $settings['social_icon_outline'] === 'yes' && $settings['social_icon_shape'] !== 'text' && $settings['social_icon_shape'] !== 'classic' ) {
			$social_icon_outline = 'tf-social-outline';
		}
		?>
        <ul <?php echo $this->get_render_attribute_string( 'social_icon' ) ?>>
			<?php foreach ( $settings['social_icon_list'] as $index => $item ) : ?>

				<?php $social = '';
				if ( $item['social_title'] == '' ) {
					if ( 'svg' !== $item['social_icon']['library'] ) {
						$social = explode( ' ', $item['social_icon']['value'] );
						if ( empty( $social[1] ) ) {
							$social = '';
						} else {
							$social = str_replace( 'fa-', '', $social[1] );
						}
						$social_icon = 'tf-social-' . $social;
					} else {
						$social_icon = 'tf-social-svg';
					}
				} else {
					$social_icon = 'tf-social-' . $item['social_title'];
				}


				$social_icon_tag = 'span';

				$social_items_classes = $this->get_repeater_setting_key( 'social_classes', 'social_icon_list', $index );
				$social_items_links   = $this->get_repeater_setting_key( 'social_link', 'social_icon_list', $index );

				if ( $item['social_icon_link']['url'] !== '' ) {
					$this->add_link_attributes( $social_items_links, $item['social_icon_link'] );
					$social_icon_tag = 'a';
				}

				$social_classes = array( $social_icon, 'elementor-repeater-item-' . $item['_id'] );
				if ( ! empty( $social_items_color ) ) {
					$social_classes[] = $social_items_color;
				}
				if ( ! empty( $social_items_bg ) ) {
					$social_classes[] = $social_items_bg;
				}
				if ( ! empty( $social_icon_outline ) ) {
					$social_classes[] = $social_icon_outline;
				}
				if ( ! empty( $social_animation ) ) {
					$social_classes[] = $social_animation;
				}

				if ( $item['social_title'] == '' ) {
					$socials_title = $social;
				} else {
					$socials_title = $item['social_title'];
				}

				if ( ( $settings['social_switcher_tooltip'] === '' ) ) {
					$this->add_render_attribute( $social_items_classes, 'class', $social_classes );
					$this->add_render_attribute( $social_items_links, array(
						'class' => 'tf-social-icon-icon',
						'title' => $socials_title,
					) );
				} else {
					$this->add_render_attribute( $social_items_classes, array(
						'class'             => $social_classes,
						'title'             => $socials_title,
						'data-bs-toggle'    => 'tooltip',
						'data-bs-placement' => $settings['social_position'],
					) );
					$this->add_render_attribute( $social_items_links, 'class', 'tf-social-icon-icon' );
				}

				?>
                <li <?php echo $this->get_render_attribute_string( $social_items_classes ); ?>>
					<?php printf( '<%1$s %2$s>', $social_icon_tag, $this->get_render_attribute_string( $social_items_links ) );
					Icons_Manager::render_icon( $item['social_icon'] ); ?>
					<?php if ( $settings['social_icon_shape'] === 'text' && $item['social_title'] == '' ) : ?>
                        <span class="tf-text-social"><?php echo esc_html( $social ); ?></span>
					<?php endif; ?>
					<?php if ( $settings['social_icon_shape'] === 'text' && $item['social_title'] !== '' ) : ?>
                        <span class="tf-text-social"><?php echo $item['social_title']; ?></span>
					<?php endif;
					printf( '</%1$s>', $social_icon_tag ); ?>
                </li>
			<?php endforeach; ?>
        </ul>
		<?php

	}
}