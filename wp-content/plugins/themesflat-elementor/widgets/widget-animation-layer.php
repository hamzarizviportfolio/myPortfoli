<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class TFAnimation_Layer_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tf-animation-layer';
	}

	public function get_title() {
		return esc_html__( 'TF Animation Layer', 'themesflat-elementor' );
	}

	public function get_style_depends() {
		return [ 'tf-animation-layer' ];
	}

	public function get_script_depends() {
		return [ 'particles-script', 'mgglitch-script', 'tf-animation-layer','parallax_js' ];
	}

	public function get_icon() {
		return 'eicon-animation';
	}

	protected function register_controls() {
		$this->general_section();
		$this->particles_option();
		$this->image_option();
		$this->general_section_style();
	}

	protected function general_section() {
		$this->start_controls_section( 'general_section', [
			'label' => esc_html__( 'General', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'type_layer', [
			'label'   => esc_html__( 'Type Layer', 'themesflat-elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				'particles'   => esc_html__( 'Particles', 'themesflat-elementor' ),
				'image'       => esc_html__( 'Image', 'themesflat-elementor' ),
				'ball-random' => esc_html__( 'Ball Random', 'themesflat-elementor' ),
				'list-image' => esc_html__( 'List Image animation', 'themesflat-elementor' ),
			),
			'default' => 'particles',
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'image_background_color',
				'label'     => esc_html__( 'Background', 'themesflat-elementor' ),
				'selector'  => '{{WRAPPER}} .glitch-img',
				'condition' => [
					'type_layer' => 'image',
				],
			]
		);

		$this->add_control(
			'particles_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => [
					'type_layer' => 'particles',
				],
			]
		);

		$this->add_control(
			'ball_number',
			[
				'label'     => esc_html__( 'Number Ball', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'condition' => [
					'type_layer' => 'ball-random',
				],
			]
		);

		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'hero_image',
			[
				'label'     => esc_html__( 'Choose Image', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-envato.png",
				],
			]
		);


		$this->add_control(
			'image_list',
			[
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'hero_image'        => ['url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-envato.png"],
					],
					[
						'hero_image'        => ['url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-ai.png"],
					],
					[
						'hero_image'        => ['url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-figma.png"],
					],
					[
						'hero_image'        => ['url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-fiverr.png"],
					],
					[
						'hero_image'        => ['url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-joomla.png"],
					],
					[
						'hero_image'        => ['url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-ps.png"],
					],
					[
						'hero_image'        => ['url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-upwork.png"],
					],
					[
						'hero_image'        => ['url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/hero/hero-parallax-wp.png"],
					],
				],
				
			]
		);

		$this->end_controls_section();
	}

	protected function general_section_style() {
		$this->start_controls_section( 'general_section_style', [
			'label' => esc_html__( 'General', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'animation_layer_height', [
			'label'          => esc_html__( 'Height', 'themesflat-elementor' ),
			'type'           => Controls_Manager::SLIDER,
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
					'min' => 0,
					'max' => 2000,
				],
			],

			'selectors' => [
				'{{WRAPPER}} .tf-animation-layer-inner' => 'height: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_control(
			'particles_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tf-animation-layer-type-particles #particles-js'               => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tf-animation-layer-type-ball-random .tf-animation-layer-inner' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'type_layer!' => 'image',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function image_option() {
		$this->start_controls_section( 'image_option', [
			'label'     => esc_html__( 'Image Option', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
			'condition' => [
				'type_layer' => 'image',
			],
		] );

		$this->add_control(
			'show_image_line',
			[
				'label'        => esc_html__( 'Line Animation', 'themesflat-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function particles_option() {
		$this->start_controls_section( 'particles_option', [
			'label'     => esc_html__( 'Particles Option', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
			'condition' => [
				'type_layer' => 'particles',
			],
		] );

		$this->add_control(
			'particles_number',
			[
				'label'     => esc_html__( 'Number Particles', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'condition' => [
					'type_layer' => 'particles',
				],
			]
		);

		$this->add_control(
			'particles_speed',
			[
				'label'     => esc_html__( 'Speed', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'condition' => [
					'type_layer' => 'particles',
				],
			]
		);

		$this->end_controls_section();

	}

	public function render() {
		$settings      = $this->get_settings_for_display();
		$wrapper_class = array(
			'tf-animation-layer',
			'tf-animation-layer-type-' . $settings['type_layer']
		);

		$wrapper_attr = array(
			'class' => $wrapper_class,
		);


		if ( $settings['type_layer'] == 'ball-random' ) {
			if ( $settings['ball_number'] !== "" ) {
				$wrapper_attr['data-ballnumber'] = $settings['ball_number'];
			}
		}

		if ( $settings['type_layer'] == 'particles' ) {
			if ( $settings['particles_color'] !== "" ) {
				$wrapper_attr['data-particlesColor'] = $settings['particles_color'];
			}
			if ( $settings['particles_number'] !== "" ) {
				$wrapper_attr['data-particlesNumber'] = $settings['particles_number'];
			}

			if ( $settings['particles_speed'] !== "" ) {
				$wrapper_attr['data-particlesSpeed'] = $settings['particles_speed'];
			}
		}

		$this->add_render_attribute( 'wrapper_attr', $wrapper_attr );

		?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper_attr' ) ?>>
			<?php if ( $settings['type_layer'] == 'particles' ): ?>
                <div id="particles-js" class="tf-animation-layer-inner"></div>
			<?php endif; ?>
			<?php if ( $settings['type_layer'] == 'image' ): ?>
                <div class="tf-animation-layer-inner">
					<?php if ( $settings['show_image_line'] == 'yes' ): ?>
                        <div class="line-wrapper">
                            <div class="lines">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>
					<?php endif; ?>
                    <div class="glitch-img"></div>
                </div>
			<?php endif; ?>
			<?php if ( $settings['type_layer'] == 'ball-random' ): ?>
                <div class="tf-animation-layer-inner"></div>
			<?php endif; ?>
			<?php if ( $settings['type_layer'] == 'list-image' ): ?>
                <div id="scene" class="hero-parallax">
				<?php $i = 1; foreach ( $settings['image_list'] as $index => $image ): ?>
					<?php if($i == 1) { ?>
						<div data-depth="0.2"><img class="img-fluid" src="<?php echo esc_attr($image['hero_image']['url']); ?>" alt="hero parallax adobe envato"></div>
					<?php } if($i == 2) { ?>
						<div data-depth="0.1"><img class="img-fluid" src="<?php echo esc_attr($image['hero_image']['url']); ?>" alt="hero parallax adobe envato"></div>
					<?php } if ($i == 3) { ?>
						<div data-depth="0.3"><img class="img-fluid" src="<?php echo esc_attr($image['hero_image']['url']); ?>" alt="hero parallax adobe envato"></div>
					<?php } $i = $i + 1;  if($i > 3) { $i = 1; }; endforeach; ?>
				</div> <!-- .hero-parallax -->
			<?php endif; ?>
        </div>
		<?php
	}
}