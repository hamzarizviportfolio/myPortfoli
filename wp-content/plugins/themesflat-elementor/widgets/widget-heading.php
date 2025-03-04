<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

class TFHeading_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tf-heading';
	}

	public function get_title() {
		return esc_html__( 'TF Heading', 'themesflat-elementor' );
	}

	public function get_style_depends() {
		return [ 'tf-heading' ];
	}

	public function get_icon() {
		return 'eicon-heading';
	}

	protected function register_controls() {

		$options_tag_html = array(
			'h1'   => esc_html__( 'H1', 'themesflat-elementor' ),
			'h2'   => esc_html__( 'H2', 'themesflat-elementor' ),
			'h3'   => esc_html__( 'H3', 'themesflat-elementor' ),
			'h4'   => esc_html__( 'H4', 'themesflat-elementor' ),
			'h5'   => esc_html__( 'H5', 'themesflat-elementor' ),
			'h6'   => esc_html__( 'H6', 'themesflat-elementor' ),
			'div'  => esc_html__( 'div', 'themesflat-elementor' ),
			'span' => esc_html__( 'span', 'themesflat-elementor' ),
			'p'    => esc_html__( 'p', 'themesflat-elementor' ),
		);

		$this->start_controls_section( 'heading_content_section', [
			'label' => esc_html__( 'Heading', 'themesflat-elementor' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'heading_title', [
			'label'       => esc_html__( 'Text', 'themesflat-elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => esc_html__( 'Enter your title', 'themesflat-elementor' ),
			'default'     => esc_html__( 'Add Your Heading Text Here', 'themesflat-elementor' ),
			'description' => esc_html__( 'Wrap any words with &lt;mark&gt;&lt;/mark&gt; tag to make them highlight.', 'themesflat-elementor' ),
		] );

		$this->add_control( 'heading_title_link', [
			'label'     => esc_html__( 'Link', 'themesflat-elementor' ),
			'type'      => Controls_Manager::URL,
			'separator' => 'before',
			'dynamic'   => [
				'active' => true,
			],
		] );

		$this->add_control( 'heading_title_size', [
			'label'   => esc_html__( 'Size', 'themesflat-elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				''    => esc_html__( 'Default', 'themesflat-elementor' ),
				'sm'  => esc_html__( 'Small', 'themesflat-elementor' ),
				'md'  => esc_html__( 'Medium', 'themesflat-elementor' ),
				'lg'  => esc_html__( 'Large', 'themesflat-elementor' ),
				'xl'  => esc_html__( 'Extra Large', 'themesflat-elementor' ),
				'xxl' => esc_html__( 'Extra Extra Large', 'themesflat-elementor' ),
			),
			'default' => '',
		] );

		$this->add_control( 'heading_title_tag', [
			'label'   => esc_html__( 'HTML Tag', 'themesflat-elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $options_tag_html,
			'default' => 'h2',
		] );
		$this->add_control( 'heading_style', [
			'label'   => esc_html__( 'Style', 'themesflat-elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				'style-01' => esc_html__( 'Style 01', 'themesflat-elementor' ),
				'style-02' => esc_html__( 'Style 02', 'themesflat-elementor' ),
			),
			'default' => 'style-01',
		] );


		$this->end_controls_section();

		$this->start_controls_section( 'heading_description_content_section', [
			'label' => esc_html__( 'Description', 'themesflat-elementor' ),
		] );

		$this->add_control( 'heading_description', [
			'label' => esc_html__( 'Text', 'themesflat-elementor' ),
			'type'  => Controls_Manager::WYSIWYG,
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'heading_sub_title_content_section', [
			'label' => esc_html__( 'Sub Heading', 'themesflat-elementor' ),
		] );

		$this->add_control( 'heading_sub_title_text', [
			'label'   => esc_html__( 'Text', 'themesflat-elementor' ),
			'type'    => Controls_Manager::TEXTAREA,
			'dynamic' => [
				'active' => true,
			],
		] );

		$this->add_control( 'heading_sub_title_tag', [
			'label'   => esc_html__( 'HTML Tag', 'themesflat-elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $options_tag_html,
			'default' => 'h6',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'heading_wrapper_style_section', [
			'tab'   => Controls_Manager::TAB_STYLE,
			'label' => esc_html__( 'Wrapper', 'themesflat-elementor' ),
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
					'max' => 2000,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .tf-heading' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'heading_alignment', [
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
				'heading_max_width[size]!' => '',
			],

			'selectors' => [
				'{{WRAPPER}} .elementor-widget-container' => 'display: -webkit-box; display: -ms-flexbox ; display: flex; -webkit-box-pack:{{VALUE}};-ms-flex-pack:{{VALUE}};justify-content:{{VALUE}}',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'heading_title_style_section', [
			'label'     => esc_html__( 'Heading', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'heading_title!' => '',
			],
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
			'label'     => esc_html__( 'Description', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'heading_description!' => '',
			],
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
			'label'     => esc_html__( 'Sub Heading', 'themesflat-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'heading_sub_title_text!' => '',
			],
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

	public function render() {
		$settings      = $this->get_settings_for_display();
		$heading_class = array( 'tf-heading', 'tf-heading-' . $settings['heading_style'] );

		$tag_html_title = $settings['heading_title_tag'];
		$tag_html_sub   = $settings['heading_sub_title_tag'];


		$title_class = array( 'tf-heading-title' );
		if ( $settings['heading_title_size'] !== '' ) {
			$title_class[] = 'tf-heading-size-' . $settings['heading_title_size'];
		}

		$this->add_render_attribute( 'heading_attr', 'class', $heading_class );
		$this->add_render_attribute( 'title_attr', 'class', $title_class );
		$this->add_render_attribute( 'description_attr', 'class', 'tf-heading-description' );
		$this->add_render_attribute( 'sub_title_attr', 'class', 'tf-heading-sub-title' );
		?>
        <div <?php echo $this->get_render_attribute_string( 'heading_attr' ) ?>>
			<?php
			if ( $settings['heading_sub_title_text'] !== '' ) {
				printf( '<%1$s %2$s >%3$s</%1$s>', $tag_html_sub, $this->get_render_attribute_string( 'sub_title_attr' ), wp_kses_post( $settings['heading_sub_title_text'] ) );
			}
			if ( $settings['heading_title'] !== '' ) {
				$heading_title = $settings['heading_title'];
				if ( $settings['heading_title_link']['url'] !== '' ) {
					$this->add_link_attributes( 'link_title_atrr', $settings['heading_title_link'] );
					$heading_title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'link_title_atrr' ), wp_kses_post( $settings['heading_title'] ) );
				}
				printf( '<%1$s %2$s>%3$s</%1$s>', $tag_html_title, $this->get_render_attribute_string( 'title_attr' ), $heading_title );
			}
			if ( $settings['heading_description'] !== '' ) {
				printf( '<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'description_attr' ), wp_kses_post( $settings['heading_description'] ) );
			}
			?>
        </div>
		<?php
	}

}