<?php

use handler\basic_element_bio;

class bio_plans extends \Elementor\Widget_Base {

	use basic_element_bio;

    public function get_name() {
        return 'bio_plans';
    }

    public function get_title() {
        return __('پلن ها', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_plans';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

	protected function register_content_section_1() {
		$this->start_controls_section(
            'section_features',
            [
                'label' => __('پلن ها', BIO_PLUGIN_NAME),
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
			'attr-name',
			[ 
				'label' => __( 'نام ویژگی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [ 
					'show-feature' => 'yes',
				],
			]
		);

		$repeater_body->add_control(
			'attr-icon',
			[ 
				'label' => __( 'ایکون ویژگی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [ 
					'show-feature' => 'yes',
				],
			]
		);

        $repeater_body->add_control(
            'name',
            [
                'label' => __( 'نام پلن', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show-feature' => '',
                ],
            ]
        );

		$repeater_body->add_control(
            'main-feature',
            [
                'label' => esc_html__( 'پلن ویژه؟', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'بله', BIO_PLUGIN_NAME ),
                'label_off' => __( 'خیر', BIO_PLUGIN_NAME ),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'show-feature' => '',
                ],
            ]
        );

		$repeater_body->add_control(
            'price',
            [
                'label' => __( 'قیمت پلن', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show-feature' => '',
                ],
            ]
        );

		$repeater_body->add_control(
            'post-text',
            [
                'label' => __( 'پسوند', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show-feature' => '',
                ],
            ]
        );

		$repeater_body->add_control(
			'plan-sec-title',
			[ 
				'label' => __( 'عنوان دوم پلن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [ 
					'show-feature' => '',
				],
			]
		);

		$repeater_body->add_control(
			'plan-attr-count',
			[ 
				'label' => __( 'تعداد ویژگی ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'condition' => [ 
					'show-feature' => '',
				],
			]
		);

		$repeater_body->add_control(
            'show-btn',
            [
                'label' => esc_html__( 'نمایش دکمه؟', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'بله', BIO_PLUGIN_NAME ),
                'label_off' => __( 'خیر', BIO_PLUGIN_NAME ),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'show-feature' => '',
					'main-feature' => 'yes',
                ],
            ]
        );

		$repeater_body->add_control(
            'btn-text',
            [
                'label' => __( 'متن دکمه', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show-btn' => 'yes',
					'show-feature' => '',
					'main-feature' => 'yes',
                ],
            ]
        );

		$repeater_body->add_control(
			'btn-link',
			[
				'label' => esc_html__( 'لینک دکمه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', BIO_PLUGIN_NAME ),
				'default' => [
					'url' => '',
				],
				'condition' => [
                    'show-btn' => 'yes',
					'show-feature' => '',
					'main-feature' => 'yes',
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
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'normal-plan',
			[
				'label' => esc_html__( 'پلن ساده', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style('plan-title',  '.plan-title', $align=false);

		$this->add_control(
			'plan-price-body-sep',
			[ 
				'label' => esc_html__( 'بدنه پلن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'plan-price-body', '.plan-price-body');

		$this->add_control(
			'plan-price-sep',
			[
				'label' => esc_html__( 'قیمت پلن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style('plan-price',  '.plan-price', $align=false);

		$this->add_control(
			'unit-plan-sep',
			[
				'label' => esc_html__( 'واحد پلن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style('unit-plan',  '.unit-plan', $align=false);

		$this->add_control(
			'sec-title-sep',
			[ 
				'label' => esc_html__( 'عنوان دوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'sec-plan', '.sub-text');

		$this->add_control(
			'normal-plan-sep',
			[
				'label' => esc_html__( 'پلن عادی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style('normal-plan-body',  '.normal-plan');

		$this->add_control(
			'attr-name',
			[ 
				'label' => esc_html__( 'نام ویژگی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'attr-name', '.attr-name', $align=false );

		$this->add_control(
			'attr-icon-1',
			[ 
				'label' => esc_html__( 'ایکون 1', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'attr-icon-1', '.isax-arrow-left-35' );


		$this->add_control(
			'attr-icon-2',
			[ 
				'label' => esc_html__( 'ایکون 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'attr-icon-2', '.isax-tick-square1-path2' );

		$this->end_controls_section();

	}

	protected function register_style_section_2() {
		$this->start_controls_section(
			'offer-plan',
			[ 
				'label' => esc_html__( 'پلن پیشنهادی', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'main-plan-title', '.plans .offer-plan .plan-details .plan-title', $align = false );

		$this->add_control(
			'plan-price-body-sep-active',
			[ 
				'label' => esc_html__( 'بدنه قیمت', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'plan-price-body-active', '.plans .offer-plan .plan-price-body' );

		$this->add_control(
			'offer-plan-price-sep',
			[ 
				'label' => esc_html__( 'قیمت', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'main-plan-price', '.plans .offer-plan .plan-details .plan-price', $align = false );

		$this->add_control(
			'offer-unit-plan-sep',
			[ 
				'label' => esc_html__( 'واحد', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'main-unit-plan', '.plans .offer-plan .plan-details  .unit-plan', $align = false );

		$this->add_control(
			'sec-title-sep-active',
			[ 
				'label' => esc_html__( 'عنوان دوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'sec-plan-active', '.plans .offer-plan .sub-text' );

		$this->add_control(
			'offer-plan-sep',
			[ 
				'label' => esc_html__( 'پلن پیشنهادی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'main-plan-body-active', '.offer-plan' );

		$this->add_control(
			'offer-plan-btn',
			[ 
				'label' => esc_html__( 'دکمه ویژگی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'main-plan-btn', '.plans .offer-plan .buy', $align = false );

		$this->add_control(
			'attr-name-active',
			[ 
				'label' => esc_html__( 'نام ویژگی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'attr-name-active', '.offer-plan .attr-name', $align = false );

		$this->add_control(
			'attr-icon-1-active',
			[ 
				'label' => esc_html__( 'ایکون ویژگی 1', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'attr-icon-1-active', '.offer-plan .isax-arrow-left-35' );

		$this->add_control(
			'attr-icon-2-active',
			[ 
				'label' => esc_html__( 'ایکون ویژگی 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'attr-icon-2-active', '.offer-plan .isax-tick-square1-path2' );

		$this->end_controls_section();

	}

    protected function register_controls() {    

		$this->register_content_section_1();

        $this->register_style_section_1();
        $this->register_style_section_2();
    }

    protected function render() {
		$settings = $this->get_settings();

		echo '<div class="plans">';
		$count = -1;
		$is_offer = false;
		foreach ($settings['body-content'] as $plan) {
			$show_feature = $plan['show-feature'] === 'yes';
			$main_feature = $plan['main-feature'] === 'yes';
			$main_attr = $plan['attr-icon'] === 'yes';
			if(!$show_feature){
				$feature_count = $plan['plan-attr-count'];
			}
			if($show_feature == false){
				echo '<div class="' . ($main_feature ? 'offer-plan' : 'normal-plan') . '">';
					echo '<div class="plan-details">';
					echo '<p class="plan-title">' . esc_html($plan['name']) . '</p>';
					echo '<div class="plan-price-body">';
						echo '<p class="plan-price">' . esc_html($plan['price']) . '</p>';
						echo '<p class="unit-plan">' . esc_html__($plan['post-text']) . '</p>';
					echo '</div>';
					echo '<p class="sub-text">' . esc_html__( $plan['plan-sec-title'] ) . '</p>';
				echo '</div>';
				echo '<div class="plan-item">';
				if ($main_feature == true and $plan['show-btn'] === 'yes'){
					$is_offer = true;
					$btn_text = esc_html($plan['btn-text']);
					$btn_link = esc_html($plan['btn-link']['url']);
				}
			}
			if($show_feature === true and $count != -1){
				if( $plan['attr-name']){
					echo '<div class="d-flex align-items-center">';
					if($main_attr){
						echo '<i aria-hidden="true" class="isax isax-arrow-left-35"></i>';
					}
					else{
						echo '<i aria-hidden="true" class="isax isax-tick-square1-path2"></i>';
					}
					echo '<p class="attr-name">' . esc_html($plan['attr-name']) . '</p>';
					echo '</div>';
				} 
			}

			$count += 1;
            if(intval($count) === intval($feature_count)){
	
				echo '</div>';
				if($is_offer === true){
					echo '<hr>';
					echo '<div class="buy-btn">';
						echo '<a href="'. $btn_link .'" class="buy">' . $btn_text . '</a>';
					echo '</div>';
					$is_offer = false;
				}
				echo '</div>';
				$count = -1;

			}


		}
		echo '</div>';
	}
}
