<?php

use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


class bio_ajax_search extends \Elementor\Widget_Base {
	use basic_element_bio;

	public function get_name() {
		return 'bio_ajax_search';
	}

	public function get_title() {
		return esc_html__( 'جستجو ایجکس', BIO_PLUGIN_NAME );
	}

	public function get_icon() {
		return 'bio_ajax_search';
	}

	public function get_categories() {
		return [ 'bio-elementor-elements' ];
	}

	protected function register_content_section_1() {
		$this->start_controls_section(
			'section_settings',
			[ 
				'label' => esc_html__( 'تنظیمات', BIO_PLUGIN_NAME ),
			]
		);

		$this->add_control(
			'search_type',
			[ 
				'label' => esc_html__( 'نوع سرچ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'popup',
				'options' => [ 
					'popup' => esc_html__( 'پاپ آپ', BIO_PLUGIN_NAME ),
					'inline' => esc_html__( 'خطی', BIO_PLUGIN_NAME ),
				],
			]
		);

		$this->add_control(
			'popup_style',
			[ 
				'label' => esc_html__( 'سبک پاپ اپ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [ 
					'style-1' => esc_html__( 'سبک 1', BIO_PLUGIN_NAME ),
					'style-2' => esc_html__( 'سبک 2', BIO_PLUGIN_NAME ),
				],
				'condition' => [ 'search_type' => 'popup' ],
			]
		);

		$this->add_control(
			'inline_btn_title',
			[ 
				'label' => esc_html__( 'عنوان دکمه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'search_type' => 'inline' ],
			]
		);

		$this->add_responsive_control(
			'text_align', [ 
				'label' => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [ 

					'left' => [ 
						'title' => esc_html__( 'چپ', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [ 
						'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [ 
						'title' => esc_html__( 'راست', BIO_PLUGIN_NAME ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-opener-wrapper' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .inline-search-form-wrapper' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();
	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'section_style',
			[ 
				'label' => esc_html__( 'دکمه', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'Button', '.inline-search-form .submit' );
		$this->register_text_style( 'Button-icon', '.inline-search-form .submit i', $align = false );



		$this->end_controls_section();
	}

	protected function register_style_section_2() {
		$this->start_controls_section(
			'section_inline_form_style',
			[ 
				'label' => esc_html__( 'فرم', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [ 'search_type' => 'inline' ],
			]
		);

		$this->add_control(
			'inline_form_width',
			[ 
				'label' => esc_html__( 'عرض', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 150,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [ 
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .inline-search-form' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'inline_input_padding',
			[ 
				'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .inline-search-form .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[ 
				'name' => 'inline_form_border',
				'label' => esc_html__( 'حاشیه', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} .inline-search-form',
			]
		);

		$this->add_control(
			'inline_form_border_radius',
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .inline-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'inline_form_color',
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .inline-search-form .search-field' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'inline_form_placeholder_color',
			[ 
				'label' => esc_html__( 'رنگ نگه دارنده متن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .inline-search-form .search-field::-webkit-input-placeholder, {{WRAPPER}} .inline-search-form .search-field::placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'search_field_bg',
			[ 
				'label' => esc_html__( 'پس زمینه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .inline-search-form .search-field' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'inline_form_box_shadow',
				'label' => esc_html__( 'سایه جعبه', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} .inline-search-form',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name' => 'inline_form_search_field_typography',
				'label' => esc_html__( 'تایپوگرافی', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} .inline-search-form .search-field',
			] );

		$this->end_controls_section();
	}

	protected function register_style_section_3() {
		$this->start_controls_section(
			'section_popup_container_style',
			[ 
				'label' => esc_html__( 'فضای پاپ آپ', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [ 'search_type' => 'popup' ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[ 
				'name' => 'popup_container_bg',
				'label' => esc_html__( 'پس زمینه', BIO_PLUGIN_NAME ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .popup-search .popup-search-container',
			]
		);

		$this->add_control(
			'popup_container_closer_color',
			[ 
				'label' => esc_html__( 'رنگ دکمه بستن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-closer' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'popup_container_title_color',
			[ 
				'label' => esc_html__( 'رنگ عنوان', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-title-wrapper h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name' => 'popup_container_title_typography',
				'label' => esc_html__( 'تایپوگرافی عنوان', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} .popup-search-title-wrapper h3',
			] );


		$this->add_control(
			'popup_container_form_width',
			[ 
				'label' => esc_html__( 'عرض فرم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 150,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [ 
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-form-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'popup_container_form_padding',
			[ 
				'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-form .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[ 
				'name' => 'popup_container_form_border',
				'label' => esc_html__( 'حاشیه', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} .popup-search-form .search-field',
			]
		);

		$this->add_control(
			'popup_container_form_border_radius',
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-form .search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'popup_container_input_color',
			[ 
				'label' => esc_html__( 'رنگ فرم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-form .search-field' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'popup_container_placeholder_color',
			[ 
				'label' => esc_html__( 'رنگ نگه دارنده متن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-form .search-field::-webkit-input-placeholder, {{WRAPPER}} .popup-search-form .search-field::placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'popup_container_input_bg',
			[ 
				'label' => esc_html__( 'پس زمینه فرم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-form .search-field' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'popup_container_form_icon_color',
			[ 
				'label' => esc_html__( 'رنگ ایکن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .popup-search-form .submit' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_section_4() {
		$this->start_controls_section(
			'icon-style-section',
			[ 
				'label' => esc_html__( 'استایل ایکن', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [ 'search_type' => 'popup' ],
			]
		);

		$this->register_text_style( 'icon', '.popup-search-opener i' );

		$this->end_controls_section();
	}

	protected function register_controls() {

		$this->register_content_section_1();

		$this->register_style_section_1();
		$this->register_style_section_2();
		$this->register_style_section_3();
		$this->register_style_section_4();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$search_type = ( isset( $settings['search_type'] ) && $settings['search_type'] == 'inline' ) ? 'inline' : 'popup';
		?>
			<?php if ( $search_type == 'popup' ) : ?>
				<?php $style = ( ! empty( $settings['popup_style'] ) ) ? $settings['popup_style'] : 'style-1'; ?>
				<div class="popup-search-wrapper <?php echo esc_html( $style ); ?>">
					<div class="popup-search-opener-wrapper">
						<span class="popup-search-opener"><i class="isax isax-search-normal-1"></i></span>
					</div>
					<div class="popup-search">
						<div class="popup-search-container">
							<span class="popup-search-closer"></span>
							<div class="popup-search-content">
								<div class="popup-search-title-wrapper">
									<h3><?php esc_html_e( 'تایپ کنید و اینتر بزنید', BIO_PLUGIN_NAME ); ?></h3>
								</div>
								<div class="popup-search-form-wrapper">
									<form action="<?php echo home_url( '/' ); ?>" method="get" class="popup-search-form ajax_search_form" id="head-search" role="search" >
										<div class="search-form-ajax">
											<input autocomplete="off" data-swplive="true" name="s" type="text" class="form-control search-input search-field"  aria-label="Search" placeholder="<?php esc_html_e( 'Search ...', BIO_PLUGIN_NAME ); ?>"" required>
											<div class="input-group-append">
												<button type="submit" class="submit" aria-label="Submit">
													<i class="isax isax-search-normal-1"></i>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php else : ?>
				<div class="inline-search-form-wrapper">
					<form action="<?php echo home_url( '/' ); ?>" method="get" class="popup-search-form ajax_search_form" id="head-search"
						role="search">
						<div class="search-form-ajax">
							<input autocomplete="off" data-swplive="true" name="s" type="text"class="form-control search-input search-field" aria-label="Search" placeholder="<?php esc_html_e( 'Search ...', BIO_PLUGIN_NAME ); ?>"" required>
							<div class=" input-group-append">
								<button type="submit" class="submit" aria-label="Submit">
									<i class="isax isax-search-normal-1"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			<?php endif;
	}
    
}
