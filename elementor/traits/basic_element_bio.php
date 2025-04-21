<?php
namespace handler;

if ( ! defined( 'ABSPATH' ) ) { exit; } 


trait basic_element_bio {

    protected function theme_is_edit_mode(){
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
            return true;
        }
        return false;
    }
    
    protected function register_text_style($name, $selector , $align=true, $important=false) {
		if ($important){
			$important_text = '!important';
		}
		else{
			$important_text = '';
		}
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography_'  . $name,
                'selector' => '{{WRAPPER}} ' . $selector,
            ]
        );

        if($align == true) {
            $this->add_responsive_control(
                'text_aligin_' . $name,
                [
                    'label' => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'right' => [
                            'title' => esc_html__( 'راست', BIO_PLUGIN_NAME ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'center' => [
                            'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'left' => [
                            'title' => esc_html__( 'چپ', BIO_PLUGIN_NAME ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'تراز', BIO_PLUGIN_NAME ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'default' => 'right',
                    'toggle' => false,
                    'selectors' => [
                        '{{WRAPPER}} ' . $selector => 'text-align: {{VALUE}}' . $important_text
                    ]
                ]
            );
        }

        $this->add_responsive_control(
            'text_color_' . $name,
            [
                'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector  => 'color: {{VALUE}}' . $important_text ,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow_'  . $name,
                'label' => esc_html__( 'سایه متن', BIO_PLUGIN_NAME ),
                'selector' => '{{WRAPPER}} ' . $selector,
            ]
        );

        $this->add_responsive_control(
            'text_padding_'  . $name,
            [
                'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'. $important_text . ';',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_margin_'  . $name,
            [
                'label' => esc_html__( 'فاصله خارجی', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' . $important_text . ';',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'text_background_' . $name,
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} ' . $selector ,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'text_border_' . $name,
                'selector' => '{{WRAPPER}} ' . $selector,
            ]
        );

        $this->add_responsive_control(
            'text_border_radius_' . $name,
            [
                'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ' . $important_text . ';',
                ],
            ]
        );

        $this->add_group_control(
		    \Elementor\Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'text_box_shadow_' . $name,
			    'selector' => '{{WRAPPER}} '  . $selector,
		    ]
        );
    }

    protected function register_image_style($name, $selector, $important = false) {
		if ( $important ) {
			$important_text = '!important';
		} else {
			$important_text = '';
		}
        $this->add_responsive_control(
            'image_margin_' . $name,
            [
                'label' => esc_html__('فاصله خارجی', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ' . $important_text . ';',
            ],
        ]);

        $this->add_responsive_control(
            'image_padding_' . $name,
            [
                'label' => esc_html__('فاصله داخلی', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' . $important_text . ';',
            ],
        ]);

        $this->add_responsive_control(
		    'image_width' . $name,
		    [
                'label' => esc_html__('طول', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'width: {{SIZE}}{{UNIT}}' . $important_text . ';',
                ],
            ]
	    );

	    $this->add_responsive_control(
		    'image_height' . $name,
		    [
                'label' => esc_html__('ارتفاع', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'height: {{SIZE}}{{UNIT}}' . $important_text . ';',
                ],
            ]
	    );

        $this->add_responsive_control(
		    'image_opacity_' . $name,
		    [
			    'label'     => esc_html__( 'شفافیت', BIO_PLUGIN_NAME ),
			    'type'      => \Elementor\Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 0,
					    'max' => 1,
					    'step' => 0.01,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} ' . $selector => 'opacity: {{SIZE}}' . $important_text . ';',
			    ],
		    ]
	    );

        $this->add_group_control(
		    \Elementor\Group_Control_Border::get_type(),
		    [
			    'name' => 'image_border_' . $name ,
			    'selector' => '{{WRAPPER}} ' . $selector,
            ]
        );

        $this->add_responsive_control(
            'image_border_radius_' . $name,
		    [
			    'label' => esc_html__('انحنای حاشیه', BIO_PLUGIN_NAME),
			    'type' => \Elementor\Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} ' . $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' . $important_text . ';',
			    ],
		    ]
        );

        $this->add_group_control(
		    \Elementor\Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'image_box_shadow_' . $name,
			    'selector' => '{{WRAPPER}} '  . $selector,
		    ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'custom_css_filters_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector,
			]
		);

        $this->add_responsive_control(
            'animation_duration_' . $name,
            [
                'label' => esc_html__('زمان انیمیشن', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1, 
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'transition-duration: {{VALUE}}s ' . $important_text . ';',
                ],
            ]
        );
    }

    protected function register_container_style($name, $selector, $important = false) {
		if ($important){
			$important_text = '!important';
		}
		else{
			$important_text = '';
		}
        $this->add_responsive_control(
            'container_margin_' . $name,
            [
                'label' => esc_html__('فاصله خارجی', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' . $important_text . ';',
            ],
        ]);

        $this->add_responsive_control(
            'container_padding_' . $name,
            [
                'label' => esc_html__('فاصله داخلی', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' . $important_text . ';',
            ],
        ]);
        

        $this->add_responsive_control(
		    'container_min_width' . $name,
		    [
                'label' => esc_html__('حداقل عرض', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'min-width: {{SIZE}}{{UNIT}}' . $important_text . ';',
                ],
            ]
	    );

        $this->add_responsive_control(
		    'container_width' . $name,
		    [
                'label' => esc_html__('عرض', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'width: {{SIZE}}{{UNIT}}' . $important_text . ';',
                ],
            ]
	    );

	    $this->add_responsive_control(
		    'container_min_height' . $name,
		    [
                'label' => esc_html__('حداقل ارتفاع', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' , 'vh', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'min-height: {{SIZE}}{{UNIT}}' . $important_text . ';',
                ],
            ]
	    );

        $this->add_responsive_control(
		    'container_height' . $name,
		    [
                'label' => esc_html__('ارتفاع', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' , 'vh', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'height: {{SIZE}}{{UNIT}}' . $important_text . ';',
                ],
            ]
	    );

        $this->add_responsive_control(
		    'container_opacity_' . $name,
		    [
			    'label'     => esc_html__( 'شفافیت', BIO_PLUGIN_NAME ),
			    'type'      => \Elementor\Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 0,
					    'max' => 1,
					    'step' => 0.01,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} ' . $selector => 'opacity: {{SIZE}}' . $important_text . ';',
			    ],
		    ]
	    );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background_' . $name,
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} ' . $selector ,
            ]
        );

        $this->add_group_control(
		    \Elementor\Group_Control_Border::get_type(),
		    [
			    'name' => 'container_border_' . $name ,
			    'selector' => '{{WRAPPER}} ' . $selector,
            ]
        );

        $this->add_responsive_control(
            'container_border_radius_' . $name,
		    [
			    'label' => esc_html__('انحنای حاشیه', BIO_PLUGIN_NAME),
			    'type' => \Elementor\Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} ' . $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' . $important_text . ';',
			    ],
		    ]
        );

        $this->add_group_control(
		    \Elementor\Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'container_box_shadow_' . $name,
			    'selector' => '{{WRAPPER}} '  . $selector,
		    ]
        );

    }

    protected function register_table_style($name, $selector) {

        $this->add_responsive_control(
		    'tbale_header_' . $name,
		    [
			    'label'     => esc_html__( 'سر برگ', BIO_PLUGIN_NAME ),
			    'type'      => \Elementor\Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tbale_header_typography_'  . $name,
                'selector' => '{{WRAPPER}} ' . $selector  .' th',
            ]
        );

        $this->add_responsive_control(
            'tbale_header_aligin_' . $name,
            [
                'label' => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'right' => [
                        'title' => esc_html__( 'راست', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'center' => [
                        'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'left' => [
                        'title' => esc_html__( 'چپ', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'تراز', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'right',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector .' th' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'tbale_header_text_color_' . $name,
            [
                'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector  .' th'  => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'tbale_header_text_shadow_'  . $name,
                'label' => esc_html__( 'سایه متن', BIO_PLUGIN_NAME ),
                'selector' => '{{WRAPPER}} ' . $selector  .' th',
            ]
        );

        $this->add_responsive_control(
            'tbale_header_text_padding_'  . $name,
            [
                'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector  .' th'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
            
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tbale_header_text_background_' . $name,
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} ' . $selector  .' th',
            ]
        );

        $this->add_responsive_control(
            'tbale_header_text_border_radius_' . $name,
            [
                'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector  .' th' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
		    \Elementor\Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'tbale_header_text_box_shadow_' . $name,
			    'selector' => '{{WRAPPER}} '  . $selector  .' th',
		    ]
        );

        $this->add_responsive_control(
		    'table_body_' . $name,
		    [
			    'label'     => esc_html__( 'بدنه', BIO_PLUGIN_NAME ),
			    'type'      => \Elementor\Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

        $this->add_responsive_control(
            'tbale_header_spacing_'  . $name,
            [
                'label' => esc_html__( 'فاصله بوردر', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'border-spacing: {{RIGHT}}{{UNIT}} {{TOP}}{{UNIT}};',
                ],
            ]
        );
        
        $this->start_controls_tabs( 'table_odd_even' . $name );

        // Tab 1: Odd Row
        $this->start_controls_tab(
            'odd_row' . $name,
            [
                'label' => esc_html__( 'ردیف فرد', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'table_odd_row_' . $name,
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} ' . $selector  .' tr:nth-child(odd)',
            ]
        );






		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name' => 'table_table_odd_row_text_typography_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' tr:nth-child(odd)',
			]
		);

		$this->add_responsive_control(
			'table_odd_row_text_align_' . $name,
			[ 
				'label' => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [ 
					'right' => [ 
						'title' => esc_html__( 'راست', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-right',
					],
					'center' => [ 
						'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-center',
					],
					'left' => [ 
						'title' => esc_html__( 'چپ', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-left',
					],
					'justify' => [ 
						'title' => esc_html__( 'تراز', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'right',
				'toggle' => false,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' tr:nth-child(odd)' => 'text-align: {{VALUE}} !important'
				]
			]
		);

		$this->add_responsive_control(
			'table_odd_row_text_color_' . $name,
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' tr:nth-child(odd)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'table_odd_row_text_shadow_' . $name,
				'label' => esc_html__( 'سایه متن', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} ' . $selector . ' tr:nth-child(odd)',
			]
		);

		$this->add_responsive_control(
			'table_odd_row_text_padding_' . $name,
			[ 
				'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' tr:nth-child(odd)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'table_odd_row_text_margin_' . $name,
			[ 
				'label' => esc_html__( 'فاصله خارجی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' tr:nth-child(odd)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'table_odd_row_text_box_shadow_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' tr:nth-child(odd)',
			]
		);






        $this->end_controls_tab();

        // Tab 2: Even Row
        $this->start_controls_tab(
            'even_row' . $name,
            [
                'label' => esc_html__( 'ردیف زوج', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'table_even_row_' . $name,
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} ' . $selector  .' tr:nth-child(even)',
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name' => 'table_table_even_row_text_typography_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' tr:nth-child(even)',
			]
		);

		$this->add_responsive_control(
			'table_even_row_text_align_' . $name,
			[ 
				'label' => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [ 
					'right' => [ 
						'title' => esc_html__( 'راست', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-right',
					],
					'center' => [ 
						'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-center',
					],
					'left' => [ 
						'title' => esc_html__( 'چپ', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-left',
					],
					'justify' => [ 
						'title' => esc_html__( 'تراز', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'right',
				'toggle' => false,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' tr:nth-child(even)' => 'text-align: {{VALUE}} !important'
				]
			]
		);

		$this->add_responsive_control(
			'table_even_row_text_color_' . $name,
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' tr:nth-child(even)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'table_even_row_text_shadow_' . $name,
				'label' => esc_html__( 'سایه متن', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} ' . $selector . ' tr:nth-child(even)',
			]
		);

		$this->add_responsive_control(
			'table_even_row_text_padding_' . $name,
			[ 
				'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' tr:nth-child(even)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'table_even_row_text_margin_' . $name,
			[ 
				'label' => esc_html__( 'فاصله خارجی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' tr:nth-child(even)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'table_even_row_text_box_shadow_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' tr:nth-child(even)',
			]
		);

        $this->end_controls_tab();

        // Tab 3: Odd Column
        $this->start_controls_tab(
            'odd_col' . $name,
            [
                'label' => esc_html__( 'ستون فرد', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'table_odd_col_' . $name,
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} ' . $selector  .' td:nth-child(odd), {{WRAPPER}} ' . $selector  .' th:nth-child(odd)',
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name' => 'table_table_odd_col_text_typography_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' td:nth-child(odd)',
			]
		);

		$this->add_responsive_control(
			'table_odd_col_text_align_' . $name,
			[ 
				'label' => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [ 
					'right' => [ 
						'title' => esc_html__( 'راست', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-right',
					],
					'center' => [ 
						'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-center',
					],
					'left' => [ 
						'title' => esc_html__( 'چپ', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-left',
					],
					'justify' => [ 
						'title' => esc_html__( 'تراز', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'right',
				'toggle' => false,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(odd)' => 'text-align: {{VALUE}} !important'
				]
			]
		);

		$this->add_responsive_control(
			'table_odd_col_text_color_' . $name,
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(odd)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'table_odd_col_text_shadow_' . $name,
				'label' => esc_html__( 'سایه متن', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} ' . $selector . ' td:nth-child(odd)',
			]
		);

		$this->add_responsive_control(
			'table_odd_col_text_padding_' . $name,
			[ 
				'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(odd)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'table_odd_col_text_margin_' . $name,
			[ 
				'label' => esc_html__( 'فاصله خارجی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(odd)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[ 
				'name' => 'table_odd_col_text_border' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' td:nth-child(odd)',
			]
		);

		$this->add_responsive_control(
			'table_odd_col_text_border_radius_' . $name,
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(odd)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'table_odd_col_text_box_shadow_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' td:nth-child(odd)',
			]
		);

        $this->end_controls_tab();

        // Tab 4: Even Column
        $this->start_controls_tab(
            'even_col' . $name,
            [
                'label' => esc_html__( 'ستون زوج', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'table_even_col_' . $name,
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} ' . $selector  .' td:nth-child(even), {{WRAPPER}} ' . $selector  .' th:nth-child(even)',
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name' => 'table_table_even_col_text_typography_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' td:nth-child(even)',
			]
		);

		$this->add_responsive_control(
			'table_even_col_text_align_' . $name,
			[ 
				'label' => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [ 
					'right' => [ 
						'title' => esc_html__( 'راست', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-right',
					],
					'center' => [ 
						'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-center',
					],
					'left' => [ 
						'title' => esc_html__( 'چپ', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-left',
					],
					'justify' => [ 
						'title' => esc_html__( 'تراز', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'right',
				'toggle' => false,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(even)' => 'text-align: {{VALUE}} !important'
				]
			]
		);

		$this->add_responsive_control(
			'table_even_col_text_color_' . $name,
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(even)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'table_even_col_text_shadow_' . $name,
				'label' => esc_html__( 'سایه متن', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} ' . $selector . ' td:nth-child(even)',
			]
		);

		$this->add_responsive_control(
			'table_even_col_text_padding_' . $name,
			[ 
				'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(even)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'table_even_col_text_margin_' . $name,
			[ 
				'label' => esc_html__( 'فاصله خارجی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(even)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[ 
				'name' => 'table_even_col_text_border' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' td:nth-child(even)',
			]
		);

		$this->add_responsive_control(
			'table_even_col_text_border_radius_' . $name,
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ' td:nth-child(even)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'table_even_col_text_box_shadow_' . $name,
				'selector' => '{{WRAPPER}} ' . $selector . ' td:nth-child(even)',
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

}
