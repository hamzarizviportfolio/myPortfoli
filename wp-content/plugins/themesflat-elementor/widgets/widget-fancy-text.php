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

class TFFancy_text_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tf-fancy-text';
	}

	public function get_title() {
		return esc_html__( 'TF Fancy Text', 'themesflat-elementor' );
	}

	public function get_style_depends() {
		return [ 'tf-fancy-text' ];
	}

	public function get_script_depends() {
		return [ 'textition-script', 'typer-script', 'tf-fancy-text' ];
	}

	public function get_icon() {
		return 'eicon-animated-headline';
	}

	protected function register_controls() {
		$this->general_section();
		$this->option_section();
		$this->style_prefix_section();
		$this->style_text_animation_section();
	}

	protected function general_section() {
		$this->start_controls_section( 'general_section', [
			'label' => esc_html__( 'General', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'text_fancy_style', [
			'label'   => esc_html__( 'Style', 'themesflat-elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				'style-01' => esc_html__( 'Style 01', 'themesflat-elementor' ),
				'style-02' => esc_html__( 'Style 02', 'themesflat-elementor' ),
				'style-03' => esc_html__( 'Style 03', 'themesflat-elementor' ),
			),
			'default' => 'style-01',
		] );

		$this->add_control( 'text_fancy_prefix', [
			'label'   => esc_html__( 'Prefix', 'themesflat-elementor' ),
			'type'    => Controls_Manager::TEXTAREA,
			'dynamic' => [
				'active' => true,
			],
		] );

		$repeater = new Repeater();

		$repeater->add_control(
			'fancy_text_field_animated',
			[
				'label'   => esc_html__( 'Text', 'themesflat-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Better', 'themesflat-elementor' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'fancy_text_field_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{CURRENT_ITEM}} .text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'fancy_text_animated_text',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'label'       => esc_html__( 'Animated Text', 'themesflat-elementor' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => [
					[ 'fancy_text_field_animated' => esc_html__( 'WordPress', 'themesflat-elementor' ),
					  'fancy_text_field_color' => '' ],
					[ 'fancy_text_field_animated' => esc_html__( 'Laravel', 'themesflat-elementor' ),
					'fancy_text_field_color' => '' ],
					[ 'fancy_text_field_animated' => esc_html__( 'Joomla', 'themesflat-elementor' ),
					'fancy_text_field_color' => '' ],
				],
				'title_field' => '{{{ fancy_text_field_animated }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function option_section() {
		$this->start_controls_section( 'option_section', [
			'label' => esc_html__( 'Option', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'fancy_text_speed',
			array(
				'label'       => esc_html__( 'Speed', 'themesflat-elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Enter animation speed for your text Ex : 3000 (ms)', 'themesflat-elementor' ),
			)
		);

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

		$this->end_controls_section();
	}

	protected function style_prefix_section() {
		$this->start_controls_section( 'prefix_style_section', [
			'label'     => esc_html__( 'Prefix', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'text_fancy_prefix!' => '',
			],
		] );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'prefix_typography',
				'selector' => '{{WRAPPER}} .tf-funcy-text-prefix',
			]
		);

		$this->add_control(
			'prefix_text_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .tf-funcy-text-prefix' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control( 'prefix_spacing_hover', [
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
				'{{WRAPPER}} .prefix-is-block .tf-funcy-text-prefix'                     => 'margin-bottom : {{SIZE}}{{UNIT}} !important',
				'{{WRAPPER}} .tf-fancy-text:not(.prefix-is-block) .tf-funcy-text-prefix' => 'margin-right : {{SIZE}}{{UNIT}} !important',
			],
		] );

		$this->end_controls_section();
	}

	protected function style_text_animation_section() {
		$this->start_controls_section( 'fancy_text_style_section', [
			'label' => esc_html__( 'Fancy Text', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'fancy_text_typography',
				'selector' => '{{WRAPPER}} .tf-funcy-text-inner',
			]
		);

		$this->add_control(
			'fancy_text_text_color',
			[
				'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .tf-funcy-text-inner' => 'color: {{VALUE}};' ],
			]
		);

		$this->end_controls_section();
	}

	protected function render_functy_text( $settings ) {
		$html        = '';
		$text_fields = array();$i = 1;
		foreach ( $settings['fancy_text_animated_text'] as $key => $item ) {
			
			if ( $settings['text_fancy_style'] == 'style-01' ) {
				$html .= sprintf( '<span class="text text'.$i.'">%1$s</span>', wp_kses_post( $item['fancy_text_field_animated'] ) );
			}
			if ( $settings['text_fancy_style'] == 'style-02' ) {
				$text_fields[] = $item['fancy_text_field_animated'];
			}
			if ( $settings['text_fancy_style'] == 'style-03'  ) {
				$text_fields[] = $item['fancy_text_field_animated'];
			}
			$i = $i + 1;
		} 
		if ( $settings['text_fancy_style'] == 'style-02' ) {
			$data_words = implode( ',', $text_fields );
			$data_delay = '100';
			if ( $settings['fancy_text_speed'] != '' ) {
				$data_delay = $settings['fancy_text_speed'];
			}
			$this->add_render_attribute( 'typer_attr', array(
				'data-delay'       => $data_delay,
				'data-words'       => $data_words,
				'data-deleteDelay' => "1000",
				'class'            => "tf-typer",
			) );
			$html .= sprintf( '<span %1$s></span>', $this->get_render_attribute_string( 'typer_attr' ) );
			$html .= '<span class="cursor" data-owner="main" style="transition: all 0.1s ease 0s; opacity: 1;">_</span>';
		}
		if ($settings['text_fancy_style'] == 'style-03' ) {
			$data_words = implode( ',', $text_fields );
			$data_delay = '100';
			if ( $settings['fancy_text_speed'] != '' ) {
				$data_delay = $settings['fancy_text_speed'];
			}
			$this->add_render_attribute( 'typer_attr', array(
				'data-delay'       => $data_delay,
				'data-words'       => $data_words,
				'data-deleteDelay' => "1000",
				'class'            => "tf-typer",
			) );
			$html .= sprintf( '<span %1$s></span>', $this->get_render_attribute_string( 'typer_attr' ) );
		}
		printf( '%1$s', $html );

	}

	public function render() {
		$settings      = $this->get_settings_for_display();
		$wrapper_class = array(
			'tf-fancy-text',
			$settings['text_fancy_style']
		);

		$this->add_render_attribute( 'wrapper_attr', 'class', $wrapper_class );

		if ( $settings['text_fancy_style'] == 'style-01' ) {
			$data_delay = 3;
			if ( $settings['fancy_text_speed'] != '' ) {
				$data_delay = round( $settings['fancy_text_speed'] / 1000, 0 );
			}
			$this->add_render_attribute( 'wrapper_attr', 'data-speed', $data_delay );
		}

		?>

        <div <?php echo $this->get_render_attribute_string( 'wrapper_attr' ) ?>>
			<?php if ( $settings['text_fancy_prefix'] !== '' ): ?>
                <span class="tf-funcy-text-prefix">
					<?php echo wp_kses_post( $settings['text_fancy_prefix'] ). '     ' ?>
                </span>
			<?php endif; ?>
            <span class="tf-funcy-text-inner ">
				<?php $this->render_functy_text( $settings ) ?>
            </span>
        </div>
		<?php
	}
}