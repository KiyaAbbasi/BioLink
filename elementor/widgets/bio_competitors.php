<?php

use handler\basic_element_bio;

class bio_competitors extends \Elementor\Widget_Base {

	use basic_element_bio;

    public function get_name() {
        return 'ar_competitors';
    }

    public function get_title() {
        return esc_html__('رقبا', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_competitors';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

	protected function register_content_section_1() {
		$this->start_controls_section(
            'header-section',
            [
                'label' => __('سربرگ', BIO_PLUGIN_NAME),
            ]
        );

        $repeater_header = new \Elementor\Repeater();

        $repeater_header->add_control(
            'header',
            [
                'label' => __( 'نام', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater_header->add_control(
            'main',
            [
                'label' => esc_html__( 'اصلی؟', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'بله', BIO_PLUGIN_NAME ),
                'label_off' => __( 'خیر', BIO_PLUGIN_NAME ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'header-content',
            [
                'label' => __( 'سربرگ', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_header->get_controls(),
                'default' => [],
                'title_field' => '{{{ header }}}',
            ]
        );

        $this->end_controls_section();
	}
	
	protected function register_content_section_2() {
		$this->start_controls_section(
            'section_features',
            [
                'label' => __( 'امکانات', BIO_PLUGIN_NAME),
            ]
        );

        $repeater_body = new \Elementor\Repeater();

        $repeater_body->add_control(
            'show-feature',
            [
                'label' => esc_html__( 'ویژگی یا مقدار', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'ویژگی', BIO_PLUGIN_NAME ),
                'label_off' => esc_html__( 'مقدار', BIO_PLUGIN_NAME ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater_body->add_control(
            'feature-value',
            [
                'label' => esc_html__( 'بله یا خیر؟', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'بله', BIO_PLUGIN_NAME ),
                'label_off' => __( 'خیر', BIO_PLUGIN_NAME ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show-feature' => 'yes',
                ],
            ]
        );

        $repeater_body->add_control(
            'body',
            [
                'label' => __( 'ویژگی', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show-feature' => '',
                ],
            ]
        );

        $this->add_control(
            'body-content',
            [
                'label' => __( 'ویژگی ها', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_body->get_controls(),
                'default' => [],
                'title_field' => '{{{ body }}}',
            ]
        );

        $this->end_controls_section();
	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'settings',
			[
				'label' => esc_html__( 'سربرگ', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_tab',
			[
				'label' => esc_html__( 'عادی', BIO_PLUGIN_NAME ),
			]
		);

		$this->register_text_style('normal',  '.competitors thead th');
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_main_tab',
			[
				'label' => esc_html__( 'اصلی', BIO_PLUGIN_NAME ),
			]
		);

		$this->register_text_style('main',  '.competitors thead th.main-head');

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_first_tab',
			[
				'label' => esc_html__( 'اولین', BIO_PLUGIN_NAME ),
			]
		);

		$this->register_text_style('first',  '.competitors thead th:first-child');

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();


	}

	protected function register_style_section_2() {
		$this->start_controls_section(
			'settings-body',
			[
				'label' =>  esc_html__( 'بدنه', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_table_style('table',  '.competitors',);

        $this->add_control(
			'icon-size',
			[
				'label' => __( 'سایز ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .competitors i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'first-icon',
			[
				'label' => esc_html__( 'رنگ ایکون اول', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .competitors .isax-tick-circle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sec-icon',
			[
				'label' => esc_html__( 'رنگ ایکون دوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .competitors .isax-close-circle4' => 'color: {{VALUE}}',
				],
			]
		);


        $this->end_controls_section();
	}

    protected function register_controls() {    

		$this->register_content_section_1();
		$this->register_content_section_2();

        $this->register_style_section_1();
        $this->register_style_section_2();
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<div class="competitors">';
        echo '<table>';
        echo '<thead><tr>';
        foreach ($settings['header-content'] as $header_item) {
            echo '<th ';
            echo '' . ($header_item['main'] === 'yes' ? 'class="main-head"' : ''). '>' ;
            echo $header_item['header'];
            echo '</th>';
        }
        echo '</tr></thead>';

        echo '<tbody>';
        $header_count = count($settings['header-content']);
        $count = 0;
        echo '<tr>';
        foreach ($settings['body-content'] as $index => $body_item) {
            if ($body_item['show-feature'] === 'yes') {
                echo '<td>' . ($body_item['feature-value'] === 'yes' ? '<i class="isax isax-tick-circle">' : '<i class="isax isax-close-circle4">') . '</td>';
            } else {
                echo '<td><p>' . $body_item['body'] . '</p></td>';
            }
            $count +=1;
            if($count == $header_count){
                echo '</tr>';
                $count = 0;
            }
        }
        echo '</tbody></table>';
        echo '</div>';
    }
}
