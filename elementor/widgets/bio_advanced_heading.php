<?php


use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_advanced_heading extends \Elementor\Widget_Base {

    use basic_element_bio;


    public function get_name() {
        return 'bio_advanced_heading';
    }

    public function get_title() {
        return esc_html__('عنوان پیشرفته', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_advanced_heading';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

    protected function register_content_section_1() {
        $this->start_controls_section(
            'section_titels',
            [
                'label' => esc_html__( 'عناوین', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_control(
            'heading_one',
            [
                'label' => esc_html__( 'متن یک', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'heading_two',
            [
                'label' => esc_html__( 'متن دو', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'heading_three',
            [
                'label' => esc_html__( 'متن سه', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'background_text',
            [
                'label' => esc_html__( 'متن', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'تگ html', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'h2',
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', BIO_PLUGIN_NAME ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'heading_align',
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
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .theme-advanced-heading-tag' => 'justify-content: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'لینک', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_section_1() {
        $this->start_controls_section(
            'text_one_style_section',
            [
                'label' => esc_html__( 'متن یک', BIO_PLUGIN_NAME ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->register_text_style('text_one',  '.theme-advanced-heading-one', $align=false);

        $this->end_controls_section();
    } 

    protected function register_style_section_2() {
        $this->start_controls_section(
            'text_two_style_section',
            [
                'label' =>esc_html__( 'متن دو', BIO_PLUGIN_NAME ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->register_text_style('text_two', '.theme-advanced-heading-two', $align=false);

        $this->end_controls_section();        
    }

    protected function register_style_section_3() {
        $this->start_controls_section(
            'text_three_style_section',
            [
                'label' => esc_html__( 'متن سه', BIO_PLUGIN_NAME ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->register_text_style('text_three', '.theme-advanced-heading-three', $align=false);

        $this->end_controls_section();

    }

    protected function register_style_section_4() {
        $this->start_controls_section(
            'section_style_border',
            [
                'label' => esc_html__( 'حاشیه', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_type',
            [
                'label' => esc_html__( 'نوع حاشیه', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [ 
					'none' => esc_html__( 'هیچ کدام', BIO_PLUGIN_NAME ),
					'solid' => esc_html__( 'جامد', BIO_PLUGIN_NAME ),
					'double' => esc_html__( 'دوتایی', BIO_PLUGIN_NAME ),
					'dotted' => esc_html__( 'نقطه‌ای', BIO_PLUGIN_NAME ),
					'dashed' => esc_html__( 'خط‌چین', BIO_PLUGIN_NAME ),
					'groove' => esc_html__( 'گودال', BIO_PLUGIN_NAME ),

				],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .theme-advanced-heading-border:after' => 'border-bottom-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label' => esc_html__( 'عرض', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'condition' => [
                    'border_type!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .theme-advanced-heading-border:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_height',
            [
                'label' => esc_html__( 'ارتفاع', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 3
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'border_type!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .theme-advanced-heading-border:after' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'border_offset_toggle',
			[ 
				'label' => esc_html__( 'فاصله', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'هیچ', BIO_PLUGIN_NAME ),
				'label_on' => esc_html__( 'دلخواه', BIO_PLUGIN_NAME ),
				'return_value' => 'yes',
				'condition' => [ 
					'border_type!' => 'none',
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'border_horizontal_position',
			[ 
				'label' => esc_html__( 'موقعیت افقی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [ 
					'unit' => '%',
				],
				'range' => [ 
					'%' => [ 
						'min' => -20,
						'max' => 100,
					],
				],
				'condition' => [ 
					'border_offset_toggle' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .theme-advanced-heading-border:after' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_vertical_position',
			[ 
				'label' => esc_html__( 'موقعیت عمودی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [ 
					'unit' => '%',
				],
				'range' => [ 
					'%' => [ 
						'min' => -100,
						'max' => 100,
					],
				],
				'condition' => [ 
					'border_offset_toggle' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .theme-advanced-heading-border:after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'border_color',
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [ 
					'border_type!' => 'none',
				],
				'selectors' => [ 
					'{{WRAPPER}} .theme-advanced-heading-border:after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition' => [ 
					'border_type!' => 'none',
				],
				'selectors' => [ 
					'{{WRAPPER}} .theme-advanced-heading-border:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();
    }

    protected function register_style_section_5() {
        $this->start_controls_section(
            'text_back_style_section',
            [
                'label' => esc_html__( 'متن پس زمینه', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->register_text_style('text_back', '.theme-advanced-heading-wrap:before', $align=false);

        $this->add_control(
            'background_offset_toggle',
            [
                'label' => esc_html__( 'افست', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'هیچ', BIO_PLUGIN_NAME ),
                'label_on' => esc_html__( 'سفارشی', BIO_PLUGIN_NAME ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

		$this->add_responsive_control(
			'background_horizontal_position',
			[ 
				'label' => esc_html__( 'موقعیت افقی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [ 
					'unit' => '%',
				],
				'range' => [ 
					'%' => [ 
						'min' => -100,
						'max' => 100,
					],
				],
				'condition' => [ 
					'background_offset_toggle' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .theme-advanced-heading-wrap:before' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'background_vertical_position',
			[ 
				'label' => esc_html__( 'موقعیت عمودی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [ 
					'unit' => '%',
				],
				'range' => [ 
					'%' => [ 
						'min' => -100,
						'max' => 200,
					],
				],
				'condition' => [ 
					'background_offset_toggle' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .theme-advanced-heading-wrap:before' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_popover();

        $this->end_controls_section();
    }

    protected function register_controls() {

        $this->register_content_section_1();
        
        $this->register_style_section_1();
        $this->register_style_section_2();
        $this->register_style_section_3();
        $this->register_style_section_4();
        $this->register_style_section_5();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        ?>
        <<?php echo esc_attr($settings['title_tag']); ?> class="theme-advanced-heading-tag">
        <span class="theme-advanced-heading-wrap" data-background-text="<?php echo esc_attr( $settings['background_text']); ?>">
            <span class="theme-advanced-heading-one"><?php echo esc_attr( $settings[ 'heading_one' ]) ; ?></span>
            <span class="theme-advanced-heading-two"><?php echo  esc_attr($settings[ 'heading_two' ]) ; ?></span>
            <span class="theme-advanced-heading-three"><?php echo  esc_attr($settings[ 'heading_three' ]) ; ?></span>
            <span class="theme-advanced-heading-border"></span>
        </span>
        <?php
        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'link', $settings['link'] );
            $this->add_render_attribute('link', 'class', "theme-advanced-heading-link");

            echo '<a ';
            $this->print_render_attribute_string( 'link' );
            echo '></a>';
        }
        ?>
        </<?php echo esc_attr($settings['title_tag']); ?>>
        <?php
    }

}