<?php
namespace handler;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\basic_element_bio;

trait swiper_bio {

	use basic_element_bio;

	protected function render_carousel_header() {
		$settings = $this->get_settings_for_display();

		if ( isset( $settings['layout'] ) ) {
			if ( $settings['layout'] !== 'carousel' ) {
				return; // Exit the function if $settings['layout'] is not 'carousel'
			}
		}

		$id = 'theme-carousel-' . $this->get_id();
		$elementor_vp_lg = get_option( 'elementor_viewport_lg' );
		$elementor_vp_md = get_option( 'elementor_viewport_md' );
		$viewport_lg = ! empty( $elementor_vp_lg ) ? intval( $elementor_vp_lg ) - 1 : 1023;
		$viewport_md = ! empty( $elementor_vp_md ) ? intval( $elementor_vp_md ) - 1 : 767;

		if ( $settings['carousel_pagination'] ) {
			$pagination_type = $settings['carousel_pagination_type'];
		} else {
			$pagination_type = '';
		}
		$carousel_settings = [ 
			"autoplay" => ( "yes" == $settings["carousel_autoplay"] ) ? [ "delay" => $settings["carousel_autoplay_speed"] ] : false,
			"loop" => ( $settings["carousel_loop"] == "yes" ),
			"speed" => $settings["carousel_speed"]["size"],
			"pauseOnMouseEnter" => ( $settings["carousel_pauseonhover"] == "yes" ),
			"slidesPerView" => ! empty( $settings["columns_mobile"] ) ? intval( $settings["columns_mobile"] ) : 1,
			"slidesPerGroup" => ! empty( $settings["carousel_slides_to_scroll_mobile"] ) ? intval( $settings["carousel_slides_to_scroll_mobile"] ) : 1,
			"spaceBetween" => ! empty( $settings["column_gap_mobile"]["size"] ) ? $settings["column_gap_mobile"]["size"] : 20,
			"centeredSlides" => ( $settings["carousel_centered_slides"] == "yes" ),
			"grabCursor" => ( $settings["carousel_grab_cursor"] == "yes" ),
			"freeMode" => ( $settings["free_mode"] == "yes" ),
			"observer" => ( $settings["carousel_observer"] == "yes" ),
			"observeParents" => ( $settings["carousel_observer"] == "yes" ),
			"direction" => $settings['carousel_direction'],
			"keyboard" => [ 
				"enabled" => $settings["keyboard"] == "yes",
				"onlyInViewport" => 1
			],
			"mousewheel" => [ 
				"enabled" => $settings["mousewheel"] == "yes",
				"onlyInViewport" => 1
			],
			"navigation" => [ 
				"nextEl" => "#" . $id . " .carousel-nav-next",
				"prevEl" => "#" . $id . " .carousel-nav-prev",
			],
			"pagination" => [ 
				"el" => "#" . $id . " .carousel-pagination",
				"type" => $pagination_type,
				"clickable" => "true",
				'dynamicBullets' => ( $settings["carousel_dynamic_bullets"] == "yes" ),
			],

		];
		switch ( $settings['carousel_effect'] ) {
			case 'slide':
				$carousel_settings['effect'] = 'slide';
				$carousel_settings["breakpoints"] = [ 
					0 => [ 
						"slidesPerView" => ! empty( $settings["slide_slides_per_view_slide_mobile"]["size"] ) ? (float) $settings["slide_slides_per_view_slide_mobile"]["size"] : "auto",
						"spaceBetween" => ! empty( $settings["slide_space_between_slide_mobile"]["size"] ) ? $settings["slide_space_between_slide_mobile"]["size"] : "auto",
					],
					600 => [ 
						"slidesPerView" => ! empty( $settings["slide_slides_per_view_slide_tablet"]["size"] ) ? (float) $settings["slide_slides_per_view_slide_tablet"]["size"] : "auto",
						"spaceBetween" => ! empty( $settings["slide_space_between_slide_tablet"]["size"] ) ? (float) $settings["slide_space_between_slide_tablet"]["size"] : "auto",
					],
					900 => [ 
						"slidesPerView" => ! empty( $settings["slide_slides_per_view_slide"]["size"] ) ? (float) $settings["slide_slides_per_view_slide"]["size"] : "auto",
						"spaceBetween" => ! empty( $settings["slide_space_between_slide"]["size"] ) ? (float) $settings["slide_space_between_slide"]["size"] : "auto",
					]
				];
				break;
			case 'creative':
				$carousel_settings['effect'] = 'creative';
				$carousel_settings['creativeEffect'] = [ 
					'prev' => [ 
						'shadow' => true,
						'translate' => [ $settings["carousel_creative_prev_translateX"]["size"], $settings["carousel_creative_prev_translateY"]["size"], $settings["carousel_creative_prev_translateZ"]["size"] ],
					],
					'next' => [ 
						'translate' => [ $settings["carousel_creative_next_translateX"]["size"], $settings["carousel_creative_next_translateY"]["size"], $settings["carousel_creative_next_translateZ"]["size"] ],
					],
				];
				break;

			case 'cards':
				$carousel_settings['effect'] = 'cards';

				break;

			case 'coverflow':
				$carousel_settings['slidesPerView'] = "auto";
				$carousel_settings['effect'] = 'coverflow';
				$carousel_settings['coverflowEffect'] = [ 
					'depth' => $settings['cover_flow_depth']['size'],
					'modifier' => $settings['cover_flow_modifier']['size'],
					'rotate' => $settings['cover_flow_rotate']['size'],
					'scale' => $settings['cover_flow_scale']['size'],
					'slideShadows' => $settings['cover_flow_slideShadows'] == 'yes',
					'stretch' => intval( $settings['cover_flow_stretch']['size'] ),
				];
				$carousel_settings["breakpoints"] = [ 
					0 => [ 
						"slidesPerView" => ! empty( $settings["slide_slides_per_view_coverflow_mobile"]["size"] ) ? (float) $settings["slide_slides_per_view_coverflow_mobile"]["size"] : "auto",
						"spaceBetween" => ! empty( $settings["slide_space_between_coverflow_mobile"]["size"] ) ? $settings["slide_space_between_coverflow_mobile"]["size"] : "auto",
					],
					600 => [ 
						"slidesPerView" => ! empty( $settings["slide_slides_per_view_coverflow_tablet"]["size"] ) ? (float) $settings["slide_slides_per_view_coverflow_tablet"]["size"] : "auto",
						"spaceBetween" => ! empty( $settings["slide_space_between_coverflow_tablet"]["size"] ) ? (float) $settings["slide_space_between_coverflow_tablet"]["size"] : "auto",
					],
					900 => [ 
						"slidesPerView" => ! empty( $settings["slide_slides_per_view_coverflow"]["size"] ) ? (float) $settings["slide_slides_per_view_coverflow"]["size"] : "auto",
						"spaceBetween" => ! empty( $settings["slide_space_between_coverflow"]["size"] ) ? (float) $settings["slide_space_between_coverflow"]["size"] : "auto",
					]
				];
				break;


			// Add cases for other effects if needed

			default:
				// Handle default case if necessary
				break;
		}
		?>
		<div id="<?php echo $id ?>" class="theme-posts-carousel-wrapper"
			data-settings="<?php echo esc_attr( wp_json_encode( array_filter( $carousel_settings ) ) ); ?>"
			style="overflow: hidden;">

			<div class="swiper swiper-container">
				<div class="swiper-wrapper">
					<?php
	}

	protected function render_carousel_footer() {
		$settings = $this->get_settings_for_display();

		if ( isset( $settings['layout'] ) ) {
			if ( $settings['layout'] !== 'carousel' ) {
				return; // Exit the function if $settings['layout'] is not 'carousel'
			}
		}

		?>
				</div> <!-- .swiper-wrapper -->
			</div><!-- .swiper-container -->
			<?php
			// Arrows
			if ( $settings['carousel_arrows'] ) {
				$carousel_nav_cls = 'carousel-nav-wrapper';
				$carousel_nav_cls .= ' theme-position-' . esc_html( $settings['carousel_arrows_position'] );
				$carousel_nav_cls .= $settings['carousel_arrow_show_on_hover'] ? ' show-on-hover' : '';
				$carousel_nav_cls .= $settings['carousel_hide_arrow_mobile'] ? ' elementor-hidden-mobile' : '';

				?>
				<div class="<?php echo esc_html( $carousel_nav_cls ); ?>">
					<a href="" class="carousel-nav-next">
						<i class="<?php echo esc_html( $settings['carousel_arrows_icon'] ); ?>"></i>
					</a>
					<a href="" class="carousel-nav-prev">
						<i class="<?php echo esc_html( $settings['carousel_arrows_icon'] ); ?>"></i>
					</a>
				</div>
				<?php
			}

			// Pagination
			if ( $settings['carousel_pagination'] ) {
				$pagination_cls = 'carousel-pagination-wrapper';
				$pagination_cls .= ' type-' . esc_html( $settings['carousel_pagination_type'] );
				$pagination_cls .= ' theme-position-' . esc_html( $settings['carousel_pagination_position'] );

				?>
				<div class="<?php echo esc_html( $pagination_cls ); ?>">
					<div class="carousel-pagination"></div>
				</div>
				<?php
			}

			?>
		</div>
		<?php
	}

	protected function register_carousel_controls() {

		$this->start_controls_section( 'section_carousel_settings', [ 
			'label' => esc_html__( 'Carousel Settings', BIO_PLUGIN_NAME ),
			'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
		] );

		$this->add_control(
			'carousel_direction',
			[ 
				'label' => esc_html__( 'جهت', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [ 
					'horizontal' => esc_html__( 'افقی', BIO_PLUGIN_NAME ),
					'vertical' => esc_html__( 'عمودی', BIO_PLUGIN_NAME ),
				],
				'render_type' => 'template',
			]
		);

		$this->add_responsive_control(
			'carousel_vertical_height',
			[ 
				'label' => esc_html__( 'ارتفاع کانتینر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 100,
						'max' => 1200,
						'step' => 10
					],
				],
				'default' => [ 
					'size' => 300,
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-container' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_direction' => 'vertical',
				],
			]
		);

		$this->add_control(
			'carousel_effect',
			[ 
				'label' => esc_html__( 'افکت', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [ 
					'slide' => esc_html__( 'اسلاید', BIO_PLUGIN_NAME ),
					'coverflow' => esc_html__( 'کاور فلو', BIO_PLUGIN_NAME ),
					'cards' => esc_html__( 'کارت‌ها', BIO_PLUGIN_NAME ),
					'creative' => esc_html__( 'خلاقانه', BIO_PLUGIN_NAME ),
				],
				'prefix_class' => 'theme-carousel-effect-',
				'separator' => 'before',
				'render_type' => 'template',
			]
		);

		$this->add_responsive_control(
			'slide_slides_per_view_slide',
			[ 
				'label' => esc_html__( 'تعداد اسلایدها در نمایش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'responsive' => true,
				'condition' => [ 
					'carousel_effect' => 'slide',
				],
			]
		);

		$this->add_responsive_control(
			'slide_space_between_slide',
			[ 
				'label' => esc_html__( 'فاصله بین اسلایدها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'responsive' => true,
				'condition' => [ 
					'carousel_effect' => 'slide',
				],
			]
		);

		$this->add_control(
			'cover_flow_depth',
			[ 
				'label' => esc_html__( 'عمق کاور فلو', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'condition' => [ 
					'carousel_effect' => 'coverflow',
				],
			]
		);

		$this->add_control(
			'cover_flow_slideShadows',
			[ 
				'label' => esc_html__( 'سایه اسلاید کاور فلو', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 
					'carousel_effect' => 'coverflow',
				],
			]
		);

		// start createive effects

		$this->start_controls_tabs(
			'carousel_creative_tabs'
		);

		$this->start_controls_tab(
			'carousel_creative_next_tab',
			[ 
				'label' => esc_html__( 'اسلاید بعدی', BIO_PLUGIN_NAME ),
				'condition' => [ 
					'carousel_effect' => 'creative'
				],
			],
		);

		$this->add_control(
			'carousel_creative_next_translateX',
			[ 
				'label' => esc_html__( 'حرکت X (%)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 100,
				],
				'range' => [ 
					'%' => [ 
						'min' => -180,
						'max' => 180,
						'step' => 10,
					],
				],
				'condition' => [ 
					'carousel_effect' => 'creative'
				],
			]
		);

		$this->add_control(
			'carousel_creative_next_translateY',
			[ 
				'label' => esc_html__( 'حرکت Y (پیکسل)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -500,
						'max' => 500,
						'step' => 10,
					],
				],
				'condition' => [ 
					'carousel_effect' => 'creative'
				],
			]
		);

		$this->add_control(
			'carousel_creative_next_translateZ',
			[ 
				'label' => esc_html__( 'حرکت Z (پیکسل)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -500,
						'max' => 500,
						'step' => 10,
					],
				],
				'condition' => [ 
					'carousel_effect' => 'creative'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'carousel_creative_prev_tab',
			[ 
				'label' => esc_html__( 'اسلاید قبلی', BIO_PLUGIN_NAME ),
				'condition' => [ 
					'carousel_effect' => 'creative'
				],
			]
		);

		$this->add_control(
			'carousel_creative_prev_translateX',
			[ 
				'label' => esc_html__( 'حرکت X (%)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'%' => [ 
						'min' => -180,
						'max' => 180,
						'step' => 10,
					],
				],
				'condition' => [ 
					'carousel_effect' => 'creative'
				],
			]
		);

		$this->add_control(
			'carousel_creative_prev_translateY',
			[ 
				'label' => esc_html__( 'حرکت Y (پیکسل)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -500,
						'max' => 500,
						'step' => 10,
					],
				],
				'condition' => [ 
					'carousel_effect' => 'creative'
				],
			]
		);

		$this->add_control(
			'carousel_creative_prev_translateZ',
			[ 
				'label' => esc_html__( 'حرکت Z (پیکسل)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => -100,
				],
				'range' => [ 
					'px' => [ 
						'min' => -500,
						'max' => 500,
						'step' => 10,
					],
				],
				'condition' => [ 
					'carousel_effect' => 'creative'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_58745',
			[ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [ 
					'carousel_effect' => 'creative'
				]
			]
		);

		// end createive effects

		$this->add_control(
			'carousel_autoplay',
			[ 
				'label' => esc_html__( 'پخش خودکار', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'carousel_autoplay_speed',
			[ 
				'label' => esc_html__( 'سرعت پخش خودکار', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [ 
					'carousel_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_pauseonhover',
			[ 
				'label' => esc_html__( 'توقف هنگام هاور', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'carousel_slides_to_scroll',
			[ 
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'اسلایدها برای اسکرول', BIO_PLUGIN_NAME ),
				'default' => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'options' => [ 
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
			]
		);

		$this->add_control(
			'carousel_centered_slides',
			[ 
				'label' => esc_html__( 'مرکز اسلاید', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'carousel_grab_cursor',
			[ 
				'label' => esc_html__( 'گرفتن نشانگر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'free_mode',
			[ 
				'label' => esc_html__( 'حالت آزاد', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'carousel_loop',
			[ 
				'label' => esc_html__( 'حلقه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'carousel_auto_height',
			[ 
				'label' => esc_html__( 'ارتفاع خودکار', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'carousel_speed',
			[ 
				'label' => esc_html__( 'سرعت انیمیشن (میلی‌ثانیه)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 500,
				],
				'range' => [ 
					'px' => [ 
						'min' => 100,
						'max' => 5000,
						'step' => 50,
					],
				],
			]
		);

		$this->add_control(
			'keyboard',
			[ 
				'label' => esc_html__( 'حرکت با صفحه کلید', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'mousewheel',
			[ 
				'label' => esc_html__( 'حرکت با چرخ موس', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'carousel_observer',
			[ 
				'label' => esc_html__( 'مشاهده‌کننده', BIO_PLUGIN_NAME ),
				'description' => esc_html__( 'زمانی که از کاروسل در مکان‌های مخفی مانند تب‌ها یا آکاردئون استفاده می‌کنید، این گزینه را روشن نگه دارید.', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->start_controls_section(
			'section_carousel_navigation',
			[ 
				'label' => esc_html__( 'ناوبری', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'carousel_arrows',
			[ 
				'label' => esc_html__( 'فلش‌ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'carousel_arrows_icon',
			[ 
				'label' => esc_html__( 'Arrows Icon', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'isax arrow-right',
				'options' => [ 
					'isax isax-arrow-right-34' => esc_html__( 'سبک 1', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-41' => esc_html__( 'سبک 2', BIO_PLUGIN_NAME ),
					'isax isax-direct-right4' => esc_html__( 'سبک 3', BIO_PLUGIN_NAME ),
					'isax isax-sidebar-right4' => esc_html__( 'سبک 4', BIO_PLUGIN_NAME ),
					'isax isax-tag-right4' => esc_html__( 'سبک 5', BIO_PLUGIN_NAME ),
					'isax isax-arrow-circle-right5' => esc_html__( 'سبک 6', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right5' => esc_html__( 'سبک 8', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-15' => esc_html__( 'سبک 8', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-35' => esc_html__( 'سبک 9', BIO_PLUGIN_NAME ),
					'isax isax-arrow-square-right3' => esc_html__( 'سبک 10', BIO_PLUGIN_NAME ),
					'isax isax-direct-right5' => esc_html__( 'سبک 11', BIO_PLUGIN_NAME ),
					'isax isax-sidebar-right5' => esc_html__( 'سبک 12', BIO_PLUGIN_NAME ),
					'isax isax-arrow-circle-right' => esc_html__( 'سبک 13', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right' => esc_html__( 'سبک 14', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-1' => esc_html__( 'سبک 15', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-2' => esc_html__( 'سبک 16', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-3' => esc_html__( 'سبک 17', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-4' => esc_html__( 'سبک 18', BIO_PLUGIN_NAME ),
					'isax isax-direct-right' => esc_html__( 'سبک 19', BIO_PLUGIN_NAME ),
					'isax isax-tag-right' => esc_html__( 'سبک 20', BIO_PLUGIN_NAME ),
					'isax isax-arrow-circle-right4' => esc_html__( 'سبک 21', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right4' => esc_html__( 'سبک 22', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-14' => esc_html__( 'سبک 23', BIO_PLUGIN_NAME ),
					'isax isax-arrow-right-24' => esc_html__( 'سبک 24', BIO_PLUGIN_NAME ),
					'isax isax-tag-right5' => esc_html__( 'سبک 25', BIO_PLUGIN_NAME ),
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_arrows_position',
			[ 
				'label' => esc_html__( 'موقعیت فلش‌ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [ 
					'top' => esc_html__( 'بالا', BIO_PLUGIN_NAME ),
					'bottom' => esc_html__( 'پایین', BIO_PLUGIN_NAME ),
					'center' => esc_html__( 'مرکز', BIO_PLUGIN_NAME ),
					'top-left' => esc_html__( 'بالا چپ', BIO_PLUGIN_NAME ),
					'top-center' => esc_html__( 'بالا مرکز', BIO_PLUGIN_NAME ),
					'top-right' => esc_html__( 'بالا راست', BIO_PLUGIN_NAME ),
					'bottom-left' => esc_html__( 'پایین چپ', BIO_PLUGIN_NAME ),
					'bottom-center' => esc_html__( 'پایین مرکز', BIO_PLUGIN_NAME ),
					'bottom-right' => esc_html__( 'پایین راست', BIO_PLUGIN_NAME ),
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_arrow_show_on_hover',
			[ 
				'label' => esc_html__( 'نمایش فلش‌ها هنگام حرکت نشانگر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_hide_arrow_mobile',
			[ 
				'label' => esc_html__( 'پنهان کردن فلش‌ها در موبایل', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_navigation_style_info',
			[ 
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'مسیریابی و صفحه‌بندی از تنظیمات ناوبری غیرفعال شده است.', BIO_PLUGIN_NAME ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [ 
					'carousel_arrows' => '',
					'carousel_pagination' => '',
				],
			]
		);

		$this->add_control(
			'carousel_arrows_heading',
			[ 
				'label' => esc_html__( 'فلش‌ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_arrows_vertical_offset',
			[ 
				'label' => esc_html__( 'فاصله عمودی فلش‌ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_arrow_left_offset',
			[ 
				'label' => esc_html__( 'فاصله فلش چپ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_arrow_right_offset',
			[ 
				'label' => esc_html__( 'فاصله فلش راست', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_carousel_arrows_style' );

		$this->start_controls_tab(
			'tabs_carousel_arrows_normal',
			[ 
				'label' => esc_html__( 'عادی', BIO_PLUGIN_NAME ),
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_arrows_color',
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_arrows_background',
			[ 
				'label' => esc_html__( 'پس‌زمینه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[ 
				'name' => 'carousel_arrows_border',
				'selector' => '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next',
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_arrows_border_radius',
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_arrows_padding',
			[ 
				'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_arrows_size',
			[ 
				'label' => esc_html__( 'اندازه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_carousel_arrows_hover',
			[ 
				'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_arrows_hover_color',
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_arrows_hover_background',
			[ 
				'label' => esc_html__( 'پس‌زمینه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 
					'carousel_arrows!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_arrows_hover_border_color',
			[ 
				'label' => esc_html__( 'رنگ حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'carousel_arrows_border_border!' => '',
					'carousel_arrows!' => '',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'hr_847456',
			[ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [ 
					'carousel_arrows!' => '',
					'carousel_pagination!' => '',
				],
			]
		);

		$this->end_controls_section();


	}

	protected function register_style_carousel_controls() {

		$this->start_controls_section(
			'section_carousel_pagination_style_swiper',
			[ 
				'label' => esc_html__( 'استایل', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'swiper', '.swiper' );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_pagination_style',
			[ 
				'label' => esc_html__( 'صفحه‌بندی', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'carousel_pagination',
			[ 
				'label' => esc_html__( 'صفحه‌بندی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'carousel_pagination_type',
			[ 
				'label' => esc_html__( 'نوع صفحه‌بندی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [ 
					'bullets' => esc_html__( 'نقطه‌ها', BIO_PLUGIN_NAME ),
					'fraction' => esc_html__( 'کسر', BIO_PLUGIN_NAME ),
				],
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_dynamic_bullets',
			[ 
				'label' => esc_html__( 'نقطه‌های پویا', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_control(
			'carousel_pagination_position',
			[ 
				'label' => esc_html__( 'موقعیت صفحه‌بندی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'bottom-center',
				'options' => [ 
					'top-left' => esc_html__( 'بالا چپ', BIO_PLUGIN_NAME ),
					'top-center' => esc_html__( 'بالا مرکز', BIO_PLUGIN_NAME ),
					'top-right' => esc_html__( 'بالا راست', BIO_PLUGIN_NAME ),
					'bottom-left' => esc_html__( 'پایین چپ', BIO_PLUGIN_NAME ),
					'bottom-center' => esc_html__( 'پایین مرکز', BIO_PLUGIN_NAME ),
					'bottom-right' => esc_html__( 'پایین راست', BIO_PLUGIN_NAME ),
					'center-left' => esc_html__( 'مرکز چپ', BIO_PLUGIN_NAME ),
					'center-right' => esc_html__( 'مرکز راست', BIO_PLUGIN_NAME ),
				],
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->add_control(
			'carousel_bullets_heading',
			[ 
				'label' => esc_html__( 'نقطه‌ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_pagination_vertical_offset',
			[ 
				'label' => esc_html__( 'فاصله عمودی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-pagination' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_pagination_horizontal_offset',
			[ 
				'label' => esc_html__( 'فاصله افقی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-pagination' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[ 
				'name' => 'carousel_pagination_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .carousel-pagination',
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[ 
				'name' => 'carousel_pagination_border',
				'selector' => '{{WRAPPER}} .carousel-pagination',
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_pagination_border_radius',
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-pagination' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_pagination_padding',
			[ 
				'label' => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'carousel_pagination_shadow',
				'selector' => '{{WRAPPER}} .carousel-pagination',
				'condition' => [ 
					'carousel_pagination!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_carousel_bullets_style' );

		$this->start_controls_tab(
			'tabs_carousel_bullets_normal',
			[ 
				'label' => esc_html__( 'عادی', BIO_PLUGIN_NAME ),
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);


		$this->add_control(
			'carousel_bullets_color',
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_bullets_space_between',
			[ 
				'label' => esc_html__( 'فاصله بین', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 5,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .carousel-pagination-wrapper.type-bullets .carousel-pagination' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_bullets_width_size',
			[ 
				'label' => esc_html__( 'عرض (px)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_bullets_height_size',
			[ 
				'label' => esc_html__( 'ارتفاع (px)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_bullets_border_radius',
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'carousel_bullets_box_shadow',
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_carousel_bullets_active',
			[ 
				'label' => esc_html__( 'فعال', BIO_PLUGIN_NAME ),
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_control(
			'carousel_active_bullet_color',
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_active_bullet_width',
			[ 
				'label' => esc_html__( 'عرض (px)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_active_bullet_height',
			[ 
				'label' => esc_html__( 'ارتفاع (px)', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_active_bullet_radius',
			[ 
				'label' => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'carousel_bullet_active_box_shadow',
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet-active',
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'bullets',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'carousel_fraction_heading',
			[ 
				'label' => esc_html__( 'کسر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'fraction',
				],
			]
		);

		$this->add_control(
			'carousel_fraction_color',
			[ 
				'label' => esc_html__( 'رنگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'fraction',
				],
			]
		);

		$this->add_control(
			'carousel_active_fraction_color',
			[ 
				'label' => esc_html__( 'رنگ فعال', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-current' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'fraction',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name' => 'carousel_fraction_typography',
				'label' => esc_html__( 'تایپوگرافی', BIO_PLUGIN_NAME ),
				'selector' => '{{WRAPPER}} .swiper-pagination-fraction',
				'condition' => [ 
					'carousel_pagination!' => '',
					'carousel_pagination_type' => 'fraction',
				],
			]
		);


		$this->end_controls_section();
	}
}