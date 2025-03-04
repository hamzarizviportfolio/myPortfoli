<?php
class TFCounter_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-counter';
    }
    
    public function get_title() {
        return esc_html__( 'TF Counter', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-counter';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-counter'];
	}

    public function get_script_depends() {
		return [ 'elementor-waypoints', 'jquery-numerator', 'tf-counter' ];
	}

	protected function register_controls() {
		// Start Counter        
			$this->start_controls_section( 'section_tabs',
	            [
	                'label' => esc_html__('Counter', 'themesflat-core'),
	            ]
	        );

	        $this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'style1',
					'options' => [
						'default'  => esc_html__( 'Default', 'themesflat-core' ),
						'style1'  => esc_html__( 'Style 1', 'themesflat-core' ),
						
					],
				]
			);

	        $this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value'   => 'fas fa-star',
						'library' => 'solid',
					],
					'condition' => [
						'style!' => 'default',
					],
				]
			);
	        
	        $this->add_control(
				'starting_number',
				[
					'label' => esc_html__( 'Starting Number', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 0,
				]
			);

			$this->add_control(
				'ending_number',
				[
					'label' => esc_html__( 'Ending Number', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 32,
				]
			);

			$this->add_control(
				'prefix',
				[
					'label' => esc_html__( 'Number Prefix', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
					'placeholder' => 1,
				]
			);

			$this->add_control(
				'suffix',
				[
					'label' => esc_html__( 'Number Suffix', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
					'placeholder' => esc_html__( '+', 'themesflat-core' ),
				]
			);

			$this->add_control(
				'duration',
				[
					'label' => esc_html__( 'Animation Duration', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 2000,
					'min' => 100,
					'step' => 100,
				]
			);

			$this->add_control(
				'thousand_separator_char',
				[
					'label' => esc_html__( 'Separator', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'' => 'Default',
						',' => 'Commas',
						'.' => 'Dot',
						' ' => 'Space',
					],
					'default' => '',
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'Years Experience In Our Company', 'themesflat-core' ),
				]
			);

			$this->end_controls_section();
        // /.End Counter  

        // Start General
	        $this->start_controls_section( 'section_style_general',
	            [
	                'label' => esc_html__( 'General', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        ); 

	        $this->add_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'themesflat-core' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'themesflat-core' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'themesflat-core' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'left',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .tf-counter' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'border',
					'label' => esc_html__( 'Border', 'themesflat-core' ),
					'selector' => '{{WRAPPER}} .tf-counter',
				]
			);

			$this->add_responsive_control(
				'border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding',
				[
					'label' => esc_html__( 'Padding', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'background',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter ' => 'background: {{VALUE}};',
						'{{WRAPPER}} .tf-counter.style1::after  ' => 'border-bottom-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'background_s',
				[
					'label' => esc_html__( 'Background Color After', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter.default::after  ' => 'background: {{VALUE}};',
					],
					'condition' => [
	                	'style' => ['default'],
	                ],
				]
			);

	      	$this->end_controls_section(); 
	    // /.End General          

	    // Start Style Icon
	        $this->start_controls_section( 'section_style_icon',
	            [
	                'label' => esc_html__( 'Icon', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
	                	'style' => ['style2','style3'],
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'icon_size',
				[
					'label' => esc_html__( 'Icon Font Size', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 5,
							'max' => 300,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-counter .counter-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

	        $this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .tf-counter .counter-icon svg' => 'fill: {{VALUE}};',
					],
				]
			);

	        $this->add_responsive_control(
				'margin_icon',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			        
        	$this->end_controls_section();    
	    // /.End Style Icon

        // Start Style Number
	        $this->start_controls_section( 'section_style_number',
	            [
	                'label' => esc_html__( 'Number', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control(
				'number_color',
				[
					'label' => esc_html__( 'Text Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-number-wrapper' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'number_color_pf',
				[
					'label' => esc_html__( 'Text Prefix Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-number-wrapper .counter-number-prefix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'number_color_sf',
				[
					'label' => esc_html__( 'Text Suffix Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-number-wrapper .counter-number-suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Typo Number', 'themesflat-core' ),
					'name' => 'typography_number_df',
					'selector' => '{{WRAPPER}} .tf-counter .counter-number-wrapper ',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Typo Number Suffix', 'themesflat-core' ),
					'name' => 'typography_number_df_sf',
					'selector' => '{{WRAPPER}} .tf-counter .counter-number-wrapper .counter-number-suffix ',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Typo Number Prefix', 'themesflat-core' ),
					'name' => 'typography_number_df_px',
					'selector' => '{{WRAPPER}} .tf-counter .counter-number-wrapper .counter-number-prefix ',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Typo Number Prefix', 'themesflat-core' ),
					'name' => 'typography_number',
					'selector' => '{{WRAPPER}} .tf-counter .counter-number-wrapper .counter-number-prefix',
					'condition' => [
						'style' => 'style4',
					],
				]
			);


			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Typo Number', 'themesflat-core' ),
					'name' => 'typography_number_1',
					'selector' => '{{WRAPPER}} .tf-counter .counter-number-wrapper .counter-number',
					'condition' => [
						'style' => 'style4',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Typo Number Suffix ', 'themesflat-core' ),
					'name' => 'typography_number_2',
					'selector' => '{{WRAPPER}} .tf-counter .counter-number-wrapper .counter-number-suffix',
					'condition' => [
						'style' => 'style4',
					],
				]
			);


			$this->add_group_control(
				\Elementor\Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'number_shadow',
					'selector' => '{{WRAPPER}} .tf-counter .counter-number-wrapper',
				]
			);	

			$this->add_responsive_control(
				'margin_number',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-number-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			        
        	$this->end_controls_section();    
	    // /.End Style Number

        // Start Style Title
	        $this->start_controls_section( 'section_style_title',
	            [
	                'label' => esc_html__( 'Title', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Text Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color_line',
				[
					'label' => esc_html__( 'Color Line', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-title::after' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                	'style' => ['style3'],
	                ],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography_title',
					'selector' => '{{WRAPPER}} .tf-counter .counter-title',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'title_shadow',
					'selector' => '{{WRAPPER}} .tf-counter .counter-title',
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],					
				]
			);	
			        
        	$this->end_controls_section();    
	    // /.End Style Title
		
		// Start Style Description
			$this->start_controls_section( 'section_style_description',
				[
					'label' => esc_html__( 'Description', 'themesflat-core' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'style' => ['style3'],
					],
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' => esc_html__( 'Text Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'description_color_line',
				[
					'label' => esc_html__( 'Color Line', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-description::after' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'style' => ['style3'],
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography_description',
					'selector' => '{{WRAPPER}} .tf-counter .counter-description',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'description_shadow',
					'selector' => '{{WRAPPER}} .tf-counter .counter-description',
				]
			);

			$this->add_responsive_control(
				'margin_description',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-counter .counter-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],					
				]
			);	
					
			$this->end_controls_section();    
		// End Style Description
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_counter', ['id' => "tf-counter-{$this->get_id()}", 'class' => ['tf-counter', $settings['style']], 'data-tabid' => $this->get_id()] );	

		$counter_icon = $counter_title = $counter_prefix = $counter_number = $counter_suffix = '';

		$icon = \Elementor\Addon_Elementor_Icon_manager_zoyot::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
		if ($icon) {
			$counter_icon = sprintf('%1$s',$icon);
		} 

		if ($settings['prefix']) {
			$counter_prefix = sprintf('<span class="counter-number-prefix">%1$s</span>',$settings['prefix']);
		}
		
		$counter_number = sprintf('<span class="counter-number" data-from_value="%1$s" data-to_value="%2$s" data-duration="%3$s" data-delimiter="%4$s">%1$s</span>',$settings['starting_number'],$settings['ending_number'],$settings['duration'],$settings['thousand_separator_char']);
		

		if ($settings['suffix']) {
			$counter_suffix = sprintf('<span class="counter-number-suffix">%1$s</span>',$settings['suffix']);
		}

		if ($settings['title']) {
			$counter_title = sprintf('<div class="counter-title">%1$s</div>',$settings['title']);
		}
		

		$content = sprintf( '<div class="wrap-counter">
								<div class="wrap-counter-inner">
									<div class="content">
										<div class="counter-number-wrapper">									
											%1$s
											%2$s
											%3$s
										</div>
										%4$s
									</div>
								</div>
							</div>', $counter_prefix,$counter_number,$counter_suffix,$counter_title);

		if ($settings['style'] == "style1") {
			$content = sprintf( '<div class="wrap-counter">
			<div class="wrap-counter-inner">
				<div class="icon">
					%5$s
				</div>
				%4$s
				<div class="counter-number-wrapper">									
					%1$s
					%2$s
					%3$s
				</div>
				
			</div>
		</div>', $counter_prefix,$counter_number,$counter_suffix,$counter_title,$counter_icon);
		}

		if ($settings['style'] == "style2") {
			$content = sprintf( '<div class="wrap-counter">
									%5$s
									<div class="counter-number-wrapper">
										%1$s
										%2$s
										%3$s
									</div>
									%4$s
								</div>', $counter_prefix,$counter_number,$counter_suffix,$counter_title,$counter_icon);
		}

		if ($settings['style'] == "style3") {
			$content = sprintf( '<div class="wrap-counter">
									<div class="inner-icon">
										%5$s
									</div>
									<div class="inner-content">
										<div class="counter-number-wrapper">
											%1$s
											%2$s
											%3$s
										</div>
										%4$s
									</div>
								</div>', $counter_prefix,$counter_number,$counter_suffix,$counter_title,$counter_icon);
		}

		if ($settings['style'] == "style4") {
			$content = sprintf( '<div class="wrap-counter">
									<div class="counter-number-wrapper">
										%1$s
										%2$s
										%3$s
									</div>
								</div>', $counter_prefix,$counter_number,$counter_suffix);
		}

		echo sprintf ( 
			'<div %1$s> 
				%2$s                
            </div>',
            $this->get_render_attribute_string('tf_counter'),
            $content
        );	
		
	}

}