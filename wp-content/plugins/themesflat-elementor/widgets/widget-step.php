<?php
class TFStep_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-step';
    }
    
    public function get_title() {
        return esc_html__( 'TF Step', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-form-vertical';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-step'];
	}

	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Setting', 'themesflat-elementor'),
	            ]
	        );

	        $this->add_control(
				'styles',
				[
					'label' => esc_html__( 'Style', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'label_block' => true,
					'default' => 'style1',
					'options' => [
						'style1' => esc_html__( 'Style 1', 'themesflat-elementor' ),
						// 'style2' => esc_html__( 'Style 2 ( Max 3 Steps )', 'themesflat-elementor' ),
						// 'style3' => esc_html__( 'Style 3 ( Max 4 Steps )', 'themesflat-elementor' ),
					],
				]
			);

	        $repeater = new \Elementor\Repeater();

	        $repeater->add_control(
				'icon_content',
				[
					'label' => esc_html__( 'Icon ', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value'   => 'fas fa-star',
						'library' => 'solid',
					],
				]
			);
	        $repeater->add_control(
				'heading',
				[
					'label' => esc_html__( 'Heading', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::TEXT,					
					'default' => esc_html__( 'Diploma in Algorythm', 'themesflat-elementor' ),
					'label_block' => true,
				]
			);
			$repeater->add_control(
				'time',
				[
					'label' => esc_html__( 'Time', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => esc_html__( '2013-2015', 'themesflat-elementor' ),
					'label_block' => true,
				]
			);
			
			$repeater->add_control(
				'company',
				[
					'label' => esc_html__( 'Company', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'UNIVERSITY OF RAJSHAHI', 'themesflat-elementor' ),
					'label_block' => true,
				]
			);
			$repeater->add_control(
				'text',
				[
					'label' => esc_html__( 'Content', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia mollit anim id est laborum.', 'themesflat-elementor' ),
					'label_block' => true,
				]
			);
			
			$this->add_control(
				'list_step',
				[
					'label' => esc_html__( 'List Step', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'show_label' => true,
					'fields' => $repeater->get_controls(),
					'default' => [
						[								
							'heading' => esc_html__( 'Diploma in Algorythm', 'themesflat-elementor' ),
							'time' => esc_html__( '2013-2015', 'themesflat-elementor' ),
							'company' => esc_html__( 'UNIVERSITY OF RAJSHAHI', 'themesflat-elementor' ),
							'text' => esc_html__( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia mollit anim id est laborum.', 'themesflat-elementor' ),
						],
						[								
							'heading' => esc_html__( 'Bachelor in Computer Seience', 'themesflat-elementor' ),
							'time' => esc_html__( '2010-2013', 'themesflat-elementor' ),
							'company' => esc_html__( 'UNIVERSITY OF DHAKA', 'themesflat-elementor' ),
							'text' => esc_html__( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia mollit anim id est laborum.', 'themesflat-elementor' ),
						],
						[								
							'heading' => esc_html__( 'Diploma in Graphic Design', 'themesflat-elementor' ),
							'time' => esc_html__( '2008-2010', 'themesflat-elementor' ),
							'company' => esc_html__( 'NEW YORK COLLAGE', 'themesflat-elementor' ),
							'text' => esc_html__( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia mollit anim id est laborum.', 'themesflat-elementor' ),
						],
						
					],
					'title_field' => '{{{ heading }}}',
				]
			);			
	        
			$this->end_controls_section();
        // /.End List Setting  

	    // Start Style Style
			$this->start_controls_section(
				'section_style',
				[
					'label' => esc_html__( 'Style', 'themesflat-elementor' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'h_general',
				[
					'label' => esc_html__( 'General', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_responsive_control( 'padding',
	            [
	                'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', 'em', '%'],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-step .item-step' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );			
			$this->add_control(
				'background_color',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tf-step .step' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'h_heading',
				[
					'label' => esc_html__( 'Heading', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'heading_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-step .step .heading' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'heading_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-step .step .heading',
				]
			);

			$this->add_control(
				'h_time',
				[
					'label' => esc_html__( 'Time', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'time_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-step .step .time' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'time_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-step .step .time',
				]
			);


			$this->add_control(
				'h_text',
				[
					'label' => esc_html__( 'Text', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'text_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-step .step .text' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-step .step .text',
				]
			);

			$this->add_control(
				'h_button',
				[
					'label' => esc_html__( 'Company', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'button_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-step .step .company' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'button_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-step .step .company',
				]
			);

			$this->add_control(
				'h_icon_content',
				[
					'label' => esc_html__( 'Icon Content', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'icon_size',
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
					'selectors'  => [
						'{{WRAPPER}} .tf-step .step .icon-block i'                                               => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-step .step .icon-block svg,{{WRAPPER}} .tf-step .step .icon-block img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
	
			$this->add_control(
				'wrap_icon_size',
				[
					'label'      => esc_html__( 'Wrap Icon Size', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-step .step .icon-block .icon-box'  => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};  line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
	
			$this->add_control(
				'icon_content_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-step .step .icon-block i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-step .step .icon-block svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_content_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-step .step .icon-block .icon-box' => 'background: {{VALUE}}',
					],
				]
			);

			
			$this->add_control(
				'border_icon_content_color',
				[
					'label' => esc_html__( 'Border Line Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-step li:not(:last-child)::after' => 'background: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'border_icon_size',
				[
					'label'      => esc_html__( 'Border Line Left', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .item-step li:not(:last-child)::after'  => 'left: {{SIZE}}{{UNIT}};',
						
					],
				]
			);

			$this->add_control(
				'border_icon_size_r',
				[
					'label'      => esc_html__( 'Border Line Top', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .item-step li:not(:last-child)::after'  => 'top: {{SIZE}}{{UNIT}};',
						
					],
				]
			);


			$this->end_controls_section();
		// /.End Style 
	}	

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();		

		$this->add_render_attribute( 'tf_step', ['id' => "tf-step-{$this->get_id()}", 'class' => ['tf-step', $settings['styles']], 'data-tabid' => $this->get_id() ] );
		
        ?>
        <div <?php echo $this->get_render_attribute_string('tf_step') ?>>
	       	<div class="step">
			   <ul class="item-step">	   
					<?php foreach ( $settings['list_step'] as $key => $step ): ++$key; ?>		
						<?php if ($settings['styles'] == "style1"): ?>
							<li class="d-flex align-items-start">
								<div class="icon-block">
									<div class="icon-box"><?php \Elementor\Icons_Manager::render_icon( $step['icon_content'], [ 'aria-hidden' => 'true' ] ); ?></div>
								</div>
								<div class="content-wrapper">
									<h4 class="heading"><?php echo esc_attr($step['heading']); ?> <span class="time"><?php echo esc_attr($step['time']); ?></span></h4>
									<h5 class="company"><?php echo esc_attr($step['company']); ?></h5>
									<p class="text">
										<?php printf($step['text']); ?>
									</p>
								</div>
								
							</li>
							
						<?php elseif ($settings['styles'] == "style2"): ?>
							<div class="inner">
								<div class="image">
									<div class="inner-image">
										<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $step, 'thumbnail', 'image'); ?>
									</div>
									<span class="number"><?php echo '0'.esc_attr($key); ?></span>
								</div>
								<div class="content">
									<h2 class="heading"><?php echo esc_attr($step['heading']); ?></h2>
									<div class="text"><?php printf($step['text']); ?></div>
								</div>
							</div>
						<?php elseif ($settings['styles'] == "style3"): ?>
							<div class="inner">
								<div class="image">
									<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $step, 'thumbnail', 'image'); ?>
									<span class="number"><?php echo '0'.esc_attr($key); ?></span>
								</div>
								<div class="content">
									<div class="icon"><?php \Elementor\Icons_Manager::render_icon( $step['icon_content'], [ 'aria-hidden' => 'true' ] ); ?></div>
									<div class="inner-content">
										<h2 class="heading"><?php echo esc_attr($step['heading']); ?></h2>
										<div class="content-hide">
											<div class="text"><?php printf($step['text']); ?></div>
											<a href="#" class="button-step"><?php echo esc_attr($step['button_text']); ?><i class="zingbox-icon-long-arrow-right2"></i></a>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
							
					<?php endforeach; ?>
				</ul>		 
	        </div>
	    </div>
        <?php 		
	}

}