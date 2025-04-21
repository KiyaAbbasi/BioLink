<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\basic_element_bio;

class socials_bio_3 extends \Elementor\Widget_Base {

	use basic_element_bio;

	public function get_name() {
		return 'socials_bio_3';
	}

	public function get_title() {
		return esc_html__( 'شبکه های اجتماعی 3', BIO_PLUGIN_NAME );
	}

	public function get_icon() {
		return 'socials_bio_3';
	}

	public function get_categories() {
		return [ 'bio-elementor-elements' ];
	}

	public function get_script_depends() {
		return [ 'socials_bio_3' ];
	}

	protected function register_content_section_1() {
		$this->start_controls_section(
			'section_content',
			[ 
				'label' => esc_html__( 'اجتماعی', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'title',
			[ 
				'label' => esc_html__( 'عنوان', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'sub-title',
			[ 
				'label' => esc_html__( 'زیر عنوان', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);


		$repeater->add_control(
			'link',
			[ 
				'label' => esc_html__( 'لینک', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', BIO_PLUGIN_NAME ),
				'default' => [ 
					'url' => '',
				],
			]
		);

		$repeater->add_control(
			'title-2',
			[ 
				'label' => esc_html__( 'عنوان 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'sub-title-2',
			[ 
				'label' => esc_html__( 'زیر عنوان 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'icon-2',
			[ 
				'label' => esc_html__( 'ایکون 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'items',
			[ 
				'label' => esc_html__( 'اجتماعی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',

			]
		);

		$this->end_controls_section();
	}

	protected function register_content_section_2() {
		$this->start_controls_section(
			'setting_section',
			[ 
				'label' => esc_html__( 'تنظیمات', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'delay',
			[ 
				'label' => esc_html__( 'تاخیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 500,
				'default' => 2500,
			]
		);

		$this->add_control(
			'lazy',
			[ 
				'label' => esc_html__( 'تنبل', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', BIO_PLUGIN_NAME ),
				'label_off' => __( 'خیر', BIO_PLUGIN_NAME ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'navigation',
			[ 
				'label' => esc_html__( 'ناوبری', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', BIO_PLUGIN_NAME ),
				'label_off' => __( 'خیر', BIO_PLUGIN_NAME ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'keyboard',
			[ 
				'label' => esc_html__( 'حرکت با کیبرد', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', BIO_PLUGIN_NAME ),
				'label_off' => __( 'خیر', BIO_PLUGIN_NAME ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'mousewheel',
			[ 
				'label' => esc_html__( 'حرکت با موس', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', BIO_PLUGIN_NAME ),
				'label_off' => __( 'خیر', BIO_PLUGIN_NAME ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'spaceBetween',
			[ 
				'label' => esc_html__( 'فاصله بین', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 400,
				'step' => 10,
				'default' => 100,
			]
		);

		$this->end_controls_section();
	}

	protected function register_content_section_3() {
		$this->start_controls_section(
			'link-container',
			[ 
				'label' => esc_html__( 'استایل لینک', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->register_container_style( 'container', 'a.social-item' );

		$this->add_control(
			'row-1_heading',
			[ 
				'label' => esc_html__( 'پارت 1', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'row-1', '.row-1' );

		$this->add_control(
			'row-2_heading',
			[ 
				'label' => esc_html__( 'پارت 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'row-2', '.row-2' );

		$this->add_control(
			'text_heading',
			[ 
				'label' => esc_html__( 'نام', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'name', '.name' );

		$this->add_control(
			'sub-text_heading',
			[ 
				'label' => esc_html__( 'زیر نام', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'sub-name', '.sub-name' );

		$this->add_control(
			'icon_1_heading',
			[ 
				'label' => esc_html__( 'ایکون اول', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'icon', '.icon-1', $align = false );

		$this->add_control(
			'text_2_heading',
			[ 
				'label' => esc_html__( 'نام 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'name-2', '.name-2' );

		$this->add_control(
			'sub-text_2_heading',
			[ 
				'label' => esc_html__( 'زیر نام 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'sub-name-2', '.sub-name-2' );

		$this->add_control(
			'icon_2_heading',
			[ 
				'label' => esc_html__( 'ایکون دوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'icon2', '.icon-2', $align = false );

		$this->end_controls_section();
	}

	protected function register_content_section_4() {
		$this->start_controls_section(
			'nav-container',
			[ 
				'label' => esc_html__( 'استایل ناوبری', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'navigition', '.social-swiper .navigition i', $align = false );


		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_content_section_1();
		$this->register_content_section_2();
		$this->register_content_section_3();
		$this->register_content_section_4();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="preview">';
		echo '<div class="swiper social-swiper">';
		echo '<div class="swiper pic-swiper">';

		echo '<div class="swiper-container row-swiper" id="row1">';
		echo '<div class="swiper-wrapper">';

		foreach ( $settings['items'] as $item ) { ?>
			<div class="swiper-slide">
				<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="social-item d-flex flex-row justify-content-between">
					<div class="row-1 d-flex flex-row">
						<div class="icon-1 d-flex align-items-center justify-content-center justify-content-between">
							<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
						<div class="d-flex flex-column">
							<p class="name">
								<?php echo esc_html( $item['title'] ); ?>
							</p>
							<p class="sub-name">
								<?php echo esc_html( $item['sub-title'] ); ?>
							</p>
						</div>
					</div>
					<div class="row-2 d-flex flex-row">
						<div class="d-flex flex-column">
							<p class="name-2">
								<?php echo esc_html( $item['title-2'] ); ?>
							</p>
							<p class="sub-name-2">
								<?php echo esc_html( $item['sub-title-2'] ); ?>
							</p>
						</div>
						<div class="icon-2 d-flex align-items-center justify-content-center">
							<?php \Elementor\Icons_Manager::render_icon( $item['icon-2'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					</div>
				</a>
			</div>
			<?php
		}

		echo '</div>';
		echo '</div>';

		echo '<div class="swiper-container row-swiper" id="row2">';
		echo '<div class="swiper-wrapper">';

		foreach ( $settings['items'] as $item ) { ?>
			<div class="swiper-slide">
				<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="social-item d-flex flex-row justify-content-between">
					<div class="row-1 d-flex flex-row">
						<div class="icon-1 d-flex align-items-center justify-content-center justify-content-between">
							<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
						<div class="d-flex flex-column">
							<p class="name">
								<?php echo esc_html( $item['title'] ); ?>
							</p>
							<p class="sub-name">
								<?php echo esc_html( $item['sub-title'] ); ?>
							</p>
						</div>
					</div>
					<div class="row-2 d-flex flex-row">
						<div class="d-flex flex-column">
							<p class="name-2">
								<?php echo esc_html( $item['title-2'] ); ?>
							</p>
							<p class="sub-name-2">
								<?php echo esc_html( $item['sub-title-2'] ); ?>
							</p>
						</div>
						<div class="icon-2 d-flex align-items-center justify-content-center">
							<?php \Elementor\Icons_Manager::render_icon( $item['icon-2'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					</div>
				</a>
			</div>
			<?php
		}

		echo '</div>';
		echo '</div>';

		echo '<div class="swiper-container row-swiper" id="row3">';
		echo '<div class="swiper-wrapper">';

		foreach ( $settings['items'] as $item ) { ?>
			<div class="swiper-slide">
				<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="social-item d-flex flex-row justify-content-between">
					<div class="row-1 d-flex flex-row">
						<div class="icon-1 d-flex align-items-center justify-content-center justify-content-between">
							<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
						<div class="d-flex flex-column">
							<p class="name">
								<?php echo esc_html( $item['title'] ); ?>
							</p>
							<p class="sub-name">
								<?php echo esc_html( $item['sub-title'] ); ?>
							</p>
						</div>
					</div>
					<div class="row-2 d-flex flex-row">
						<div class="d-flex flex-column">
							<p class="name-2">
								<?php echo esc_html( $item['title-2'] ); ?>
							</p>
							<p class="sub-name-2">
								<?php echo esc_html( $item['sub-title-2'] ); ?>
							</p>
						</div>
						<div class="icon-2 d-flex align-items-center justify-content-center">
							<?php \Elementor\Icons_Manager::render_icon( $item['icon-2'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					</div>
				</a>
			</div>
			<?php
		}



		echo '</div>';
		echo '</div>';
		if ( $settings['navigation'] == 'yes' ){
			echo '<div class="swiper-button-next navigition preview-next-btn"><i aria-hidden="true" class="isax isax-arrow-right-1"></i></div>';
			echo '<div class="swiper-button-prev navigition preview-prev-btn"><i aria-hidden="true" class="isax isax-arrow-left"></i></div>';
		}
			echo '</div>';
		echo '</div>';
		echo '</div>';
		?>
		<script>
			jQuery(document).ready(function($) {
				var rowSwipers = [];
				document.querySelectorAll(".row-swiper").forEach(function (e, i) {
					var t = {
							spaceBetween: <?php echo $settings['spaceBetween'] ?>,
							slidesPerView: 'auto',
							spaceBetween: 20,
							loop: !0,
							lazy: { enabled: <?php if( $settings['lazy'] == 'yes'){ echo 'true';  } else { echo 'false'; } ?> },
							mousewheel: { enabled: <?php if( $settings['mousewheel'] == 'yes'){ echo 'true';  } else { echo 'false'; }?>, invert: !0, eventsTarget: ".preview", releaseOnEdges: !0, sensitivity: 1 },
							touchMove: { eventsTarget: ".preview", threshold: 10 },
							keyboard: { enabled: <?php if( $settings['keyboard'] == 'yes'){ echo 'true';  } else { echo 'false'; } ?>, onlyInViewport: !0 },
							touchReleaseOnEdges: !0,
							slidesOffsetBefore: -200 * i,
							direction: "horizontal",
							navigation: { enabled: <?php if( $settings['navigation'] == 'yes'){ echo 'true';  } else { echo 'false'; } ?>, nextEl: i % 2 == 0 ? ".swiper-button-prev" : ".swiper-button-next", prevEl: i % 2 == 0 ? ".swiper-button-next" : ".swiper-button-prev" },
							autoplay: {<?php if( 'yes' == 'yes'){ echo 'enabled: true , "delay":' . $settings["delay"] . ', disableOnInteraction: !1, reverseDirection: i % 2 == 0 ';  } else { echo 'enabled:false'; } ?> },
							pagination: { el: ".swiper-pagination-row", clickable: !0 },
							
						},
						s = new Swiper(e, t);
						e.addEventListener("mouseenter", function () {
							s.autoplay.stop();
						}),
						e.addEventListener("mouseleave", function () {
							true === <?php if( $settings['navigation'] == 'yes'){ echo 'true';  } else { echo 'false'; } ?> && s.autoplay.start();
						}),
						rowSwipers.push(s);
				});
			} );
		</script>
		<?php
	}
}
