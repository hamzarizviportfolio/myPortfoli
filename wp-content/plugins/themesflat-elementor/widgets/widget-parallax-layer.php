<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Repeater;

class TFParallax_layer_text_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tf-parallax-layer';
	}

	public function get_title() {
		return esc_html__( 'TF Parallax Layer', 'themesflat-elementor' );
	}

	public function get_style_depends() {
		return [ 'tf-parallax-layer' ];
	}

	public function get_script_depends() {
		return [ 'vanilla-script', 'tf-parallax-layer' ];
	}

	public function get_icon() {
		return 'eicon-parallax';
	}

	protected function register_controls() {
		$this->content_section();
		$this->option_parallax();
	}

	protected function content_section() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'themesflat-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control( 'layer_max_width', [
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
					'max' => 2000,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .image-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'layer_alignment', [
			'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
			'type'      => Controls_Manager::CHOOSE,
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
			'condition' => [
				'layer_max_width[size]!' => '',
			],

			'selectors' => [
				'{{WRAPPER}} .tf-parallax-layer' => 'display: -webkit-box; display: -ms-flexbox ; display: flex; -webkit-box-pack:{{VALUE}};-ms-flex-pack:{{VALUE}};justify-content:{{VALUE}}',
			],
		] );

		$repeater = new Repeater();
		$this->layer_type( $repeater );
		$this->layer_image( $repeater );
		$this->layer_icon( $repeater );
		$this->layer_shape( $repeater );
		$this->layer_info( $repeater );
		$this->layer_position( $repeater );
		$this->layer_custom_class( $repeater );
		$this->layer_z_index( $repeater );
		$this->install_repeater( $repeater );


		$this->end_controls_section();
	}

	protected function layer_type( $repeater ) {
		$repeater->add_control(
			'layer_type',
			[
				'label'          => esc_html__( 'Type Layer', 'themesflat-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'image',
				'options'        => [
					'image' => esc_html__( 'Image', 'themesflat-elementor' ),
					'info'  => esc_html__( 'Information', 'themesflat-elementor' ),
					'shape' => esc_html__( 'Shape', 'themesflat-elementor' ),
					'icon'  => esc_html__( 'Icon', 'themesflat-elementor' ),
				],
				'style_transfer' => true,
			]
		);
	}

	protected function layer_icon( $repeater ) {
		$repeater->add_control(
			'layer_icon',
			[
				'label'            => esc_html__( 'Icon', 'themesflat-elementor' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon_',
				'default'          => [
					'value'   => 'fab fa-wordpress-simple',
					'library' => 'solid',
				],
				'condition'        => [
					'layer_type' => 'icon',
				],
			]
		);

		$repeater->add_responsive_control( 'size_icon', [
			'label'      => esc_html__( 'Font Size', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .layer-icon-inner' => 'font-size : {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'layer_type' => 'icon',
			],
		] );

		$repeater->add_responsive_control( 'size_box_icon', [
			'label'      => esc_html__( 'Size Box', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .layer-icon-inner' => '--tf-box-icon-size: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'layer_type' => 'icon',
			],
		] );

		$repeater->add_responsive_control( 'rotate_icon', [
			'label'      => esc_html__( 'Rotate', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range'      => [
				'%' => [
					'min' => - 360,
					'max' => 360,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .layer-icon-inner' => '-webkit-transform: rotate({{SIZE}}deg)',
			],
			'condition'  => [
				'layer_type' => 'icon',
			],
		] );

		$repeater->add_responsive_control( 'rotate_icon_when_hover', [
			'label'      => esc_html__( 'Rotate When Hover', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range'      => [
				'%' => [
					'min' => - 360,
					'max' => 360,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .image-wrapper:hover {{CURRENT_ITEM}} .layer-icon-inner' => '-webkit-transform: rotate({{SIZE}}deg)',
			],
			'condition'  => [
				'layer_type' => 'icon',
			],
		] );

		$repeater->add_control(
			'bg_icon',
			[
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-icon-inner' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'layer_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'color_icon',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-icon-inner' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layer_type' => 'icon',
				],
			]
		);
	}

	protected function layer_position( $repeater ) {
		$repeater->add_control(
			'layer_position',
			[
				'label'     => esc_html__( 'Position', 'themesflat-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'relative',
				'options'   => [
					'relative' => esc_html__( 'Default', 'themesflat-elementor' ),
					'absolute' => esc_html__( 'Absolute', 'themesflat-elementor' ),
				],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'horizontal_orientation',
			[
				'label'     => esc_html__( 'Horizontal Orientation', 'themesflat-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'options'   => [
					'left'  => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'layer_position' => 'absolute',
				],
				'default'   => 'left',
			]
		);

		$repeater->add_responsive_control( 'offset_horizontal_right', [
			'label'          => esc_html__( 'Offset Horizontal', 'themesflat-elementor' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
				'size' => '0',
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
					'min' => - 2000,
					'max' => 2000,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}}',
			],
			'condition'      => [
				'horizontal_orientation' => 'right',
				'layer_position'         => 'absolute',
			],
		] );

		$repeater->add_responsive_control( 'offset_horizontal_left', [
			'label'          => esc_html__( 'Offset Horizontal', 'themesflat-elementor' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
				'size' => '0',
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
					'min' => - 2000,
					'max' => 2000,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}}',
			],
			'condition'      => [
				'horizontal_orientation' => 'left',
				'layer_position'         => 'absolute',
			],
		] );

		$repeater->add_control(
			'vertical_orientation',
			[
				'label'     => esc_html__( 'Vertical Orientation', 'themesflat-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'options'   => [
					'top'    => [
						'title' => esc_html__( 'Top', 'themesflat-elementor' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'themesflat-elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
					'layer_position' => 'absolute',
				],
				'default'   => 'top',
			]
		);

		$repeater->add_responsive_control( 'offset_vertical_top', [
			'label'          => esc_html__( 'Offset Vertical', 'themesflat-elementor' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
				'size' => '0',
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
					'min' => - 2000,
					'max' => 2000,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}}',
			],
			'condition'      => [
				'vertical_orientation' => 'top',
				'layer_position'       => 'absolute',
			],
		] );

		$repeater->add_responsive_control( 'offset_vertical_bottom', [
			'label'          => esc_html__( 'Offset Vertical', 'themesflat-elementor' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
				'size' => '0',
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
					'min' => - 2000,
					'max' => 2000,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}}',
			],
			'condition'      => [
				'vertical_orientation' => 'bottom',
				'layer_position'       => 'absolute',
			],
		] );
	}

	protected function layer_shape( $repeater ) {

		$repeater->add_responsive_control( 'width_shape', [
			'label'      => esc_html__( 'Width', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 2000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .layer-shape-inner' => 'width: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'layer_type' => 'shape',
			],
		] );

		$repeater->add_responsive_control( 'height_shape', [
			'label'      => esc_html__( 'Height', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 2000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .layer-shape-inner' => 'height: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'layer_type' => 'shape',
			],
		] );

		$repeater->add_responsive_control( 'rotate_shape', [
			'label'      => esc_html__( 'Rotate', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range'      => [
				'%' => [
					'min' => - 360,
					'max' => 360,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .layer-shape-inner' => '-webkit-transform: rotate({{SIZE}}deg)',
			],
			'condition'  => [
				'layer_type' => 'shape',
			],
		] );

		$repeater->add_responsive_control( 'rotate_shape_when_hover', [
			'label'      => esc_html__( 'Rotate When Hover', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range'      => [
				'%' => [
					'min' => - 360,
					'max' => 360,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .image-wrapper:hover {{CURRENT_ITEM}} .layer-shape-inner' => '-webkit-transform: rotate({{SIZE}}deg)',
			],
			'condition'  => [
				'layer_type' => 'shape',
			],
		] );

		$repeater->add_control(
			'bg_shape',
			[
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-shape-inner' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'layer_type' => 'shape',
				],
			]
		);

		$repeater->add_responsive_control(
			'radius_shape',
			[
				'label'     => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-shape-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'layer_type' => 'shape',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'border_shape',
				'label'     => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .layer-shape-inner',
				'condition' => [
					'layer_type' => 'shape',
				],
			]
		);
	}

	protected function layer_image( $repeater ) {
		$repeater->add_control(
			'layer_image',
			[
				'label'     => esc_html__( 'Choose Image', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'layer_type' => 'image',
				],
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'layer_image_size',
				'include'   => [],
				'default'   => 'full',
				'condition' => [
					'layer_type' => 'image',
				],
			]
		);

		$repeater->add_responsive_control(
			'image_align',
			[
				'label'     => esc_html__( 'Align', 'themesflat-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
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
				'condition' => [
					'layer_type' => 'image',
				],
				'selectors' => [
					'{{WRAPPER}} .layer-type-image' => 'text-align: {{VALUE}};',
				],
				'default'   => '',
			]
		);
	}

	protected function layer_custom_class( $repeater ) {
		$repeater->add_control(
			'custom_class_layer',
			[
				'label'       => esc_html__( 'Custom Class', 'themesflat-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'separator'   => 'before',
				'placeholder' => esc_html__( 'Enter custom class', 'themesflat-elementor' ),
			]
		);
	}

	protected function layer_z_index( $repeater ) {
		$repeater->add_control(
			'z_index_layer',
			[
				'label'       => esc_html__( 'Z-index', 'themesflat-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'separator'   => 'before',
				'selectors'   => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'z-index: {{value}}',
				],
				'placeholder' => esc_html__( 'Enter custom z-index', 'themesflat-elementor' ),
			]
		);
	}

	protected function layer_info( $repeater ) {
		$repeater->add_control( 'featured_info', [
			'label'       => esc_html__( 'Featured', 'themesflat-elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => esc_html__( 'Enter Featured', 'themesflat-elementor' ),
			'default'     => esc_html__( '5k', 'themesflat-elementor' ),
			'separator'   => 'before',
			'condition'   => [
				'layer_type' => 'info',
			],
		] );

		$repeater->add_control( 'title_info', [
			'label'       => esc_html__( 'Title', 'themesflat-elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => esc_html__( 'Enter Title', 'themesflat-elementor' ),
			'default'     => esc_html__( 'Total Project', 'themesflat-elementor' ),
			'condition'   => [
				'layer_type' => 'info',
			],
		] );
		$repeater->add_control(
			'bg_info',
			[
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-infor-inner' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'layer_type' => 'info',
				],
			]
		);
		$repeater->add_control(
			'color_info',
			[
				'label'     => esc_html__( 'Color Number', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-infor-inner .info-featured' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layer_type' => 'info',
				],
			]
		);
		$repeater->add_control(
			'color_info_de',
			[
				'label'     => esc_html__( 'Color Title', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-infor-inner .info-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layer_type' => 'info',
				],
			]
		);
	}

	protected function install_repeater( $repeater ) {
		$this->add_control(
			'layer_repeater',
			[
				'label'   => '',
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'layer_type' => 'image',
					],
				],
			]
		);
	}

	protected function option_parallax() {

		$this->start_controls_section(
			'option_section',
			[
				'label' => esc_html__( 'Parallax Options', 'themesflat-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( 'parallax_enable', [
			'label'   => esc_html__( 'Enable Parallax', 'themesflat-elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'parallax_speed', [
			'label'      => esc_html__( 'Speed', 'themesflat-elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '' ],
			'condition'  => [
				'parallax_enable' => 'yes',
			],
		] );

		$this->end_controls_section();
	}

	protected function render_shape() {
		?>
        <div class="layer-shape-inner">
        </div>
		<?php
	}

	protected function render_info( $item ) {
		?>
        <div class="layer-infor-inner d-flex align-items-center">
			<?php if ( $item['featured_info'] != "" ) : ?>
                <div class="info-featured">
					<?php echo wp_kses_post( $item['featured_info'] ) ?>
                </div>
			<?php endif; ?>
			<?php if ( $item['title_info'] != "" ) : ?>
                <div class="info-title">
					<?php echo wp_kses_post( $item['title_info'] ) ?>
                </div>
			<?php endif; ?>
        </div>
		<?php
	}

	protected function render_icon( $item ) {
		if ( $item['layer_icon']['value'] == "" ) {
			return;
		}
		?>
        <div class="layer-icon-inner">
			<?php \Elementor\Icons_Manager::render_icon( $item['layer_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
		<?php
	}

	public function render() {
		$settings      = $this->get_settings_for_display();
		$wrapper_class = array(
			'tf-parallax-layer',
			'position-relative',
		);

		$this->add_render_attribute( 'wrapper_attr', 'class', $wrapper_class );
		$parallax_attr = array(
			'class' => "image-wrapper",
		);
		if ( $settings['parallax_enable'] == 'yes' ) {
			$parallax_attr['data-tilt']     = '';
			$parallax_attr['data-tilt-max'] = $settings['parallax_speed']['size'] ? $settings['parallax_speed']['size'] : '10';
		}
		$this->add_render_attribute( 'parallax_attr', $parallax_attr );

		?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper_attr' ) ?>>
            <ul <?php echo $this->get_render_attribute_string( 'parallax_attr' ) ?>>
				<?php foreach ( $settings['layer_repeater'] as $index => $item ) : ?>

					<?php
					$layer_type     = $item['layer_type'];
					$layer_position = $item['layer_position'];
					$item_key       = $this->get_repeater_setting_key( 'item_key', 'layer_repeater', $index );
					$item_class     = array(
						'tf-parallax-layer-item',
						'elementor-repeater-item-' . $item['_id'],
						$item_class[] = 'position-' . $layer_position,
						$item_class[] = 'layer-type-' . $item['layer_type'],
					);
					if ( $item['custom_class_layer'] !== '' ) {
						$item_class[] = $item['custom_class_layer'];
					}

					$this->add_render_attribute( $item_key, array(
						'class' => $item_class,
						'style' => 'z-index : ' . $index . '',
					) );

					echo '<li ' . $this->get_render_attribute_string( $item_key ) . '>';
					switch ( $layer_type ) {
						case "image":
							if ( $item['layer_image']['url'] !== "" ) {
								echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'layer_image_size', 'layer_image' );

							}
							break;
						case "info":
							$this->render_info( $item );
							break;

						case "shape":
							$this->render_shape();
							break;
						case "icon":
							$this->render_icon( $item );
							break;
					}
					echo '</li>'
					?>
				<?php endforeach; ?>
            </ul>
        </div>
		<?php
	}
}