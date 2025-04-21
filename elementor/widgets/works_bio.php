<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\swiper_bio;
use handler\basic_element_bio;

class works_bio extends \Elementor\Widget_Base {

	use swiper_bio;
	use basic_element_bio;

    public function is_active(){
		return true;
	}
    
    public function get_name() {
        return 'works_bio';
    }

    public function get_title() {
        return esc_html__( 'نمونه کار ها', BIO_PLUGIN_NAME );
    }

    public function get_icon() {
        return 'works_bio';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

	protected function register_content_section_1() {

		$this->start_controls_section(
			'section_layout',
			[ 
				'label' => esc_html__( 'چیدمان', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[ 
				'label' => esc_html__( 'چیدمان', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [ 
					'grid' => esc_html__( 'گرید', BIO_PLUGIN_NAME ),
					'carousel' => esc_html__( 'اسلایدر', BIO_PLUGIN_NAME ),
				],
				'default' => 'grid',
			]
		);

		$this->add_responsive_control(
			'columns',
			[ 
				'label' => esc_html__( 'ستون ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [ 
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'render_type' => 'template',
				'selectors' => [ 
					'{{WRAPPER}} .theme-posts-wrapper.layout-grid' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
					'{{WRAPPER}} .theme-posts-wrapper.layout-masonry .post-item' => 'width: calc(100% / {{SIZE}});',
					'{{WRAPPER}} .theme-posts-wrapper.layout-carousel .post-item' => 'width: calc(100% / {{SIZE}});',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[ 
				'label' => esc_html__( 'فاصله ستون ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => '20',
				],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'render_type' => 'template',
				'selectors' => [ 
					'{{WRAPPER}} .theme-posts-wrapper.layout-grid' => 'column-gap: {{SIZE}}{{UNIT}};',
					'body:not(.rtl) {{WRAPPER}} .theme-posts-wrapper.layout-carousel .post-item' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .theme-posts-wrapper.layout-carousel .post-item' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theme-posts-wrapper.layout-masonry' => 'margin-left: calc({{SIZE}}{{UNIT}} * -.5); margin-right: calc({{SIZE}}{{UNIT}} * -.5);',
					'{{WRAPPER}} .theme-posts-wrapper.layout-masonry .post-item' => 'padding-left: calc({{SIZE}}{{UNIT}} * .5); padding-right: calc({{SIZE}}{{UNIT}} * .5);',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[ 
				'label' => esc_html__( 'فاصله سطر ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [ 
					'size' => '20',
				],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .theme-posts-wrapper.layout-grid' => 'row-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theme-posts-wrapper.layout-masonry .post-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'layout!' => 'carousel',
				],
			]
		);

		$this->add_control(
			'hover',
			[ 
				'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => [ 
					'0' => esc_html__( ' ', BIO_PLUGIN_NAME ),
					'1' => esc_html__( 'سبک 1', BIO_PLUGIN_NAME ),
					'2' => esc_html__( 'سبک 2', BIO_PLUGIN_NAME ),
					'3' => esc_html__( 'سبک 3', BIO_PLUGIN_NAME ),
					'4' => esc_html__( 'سبک 4', BIO_PLUGIN_NAME ),
					'5' => esc_html__( 'سبک 5', BIO_PLUGIN_NAME ),
					'6' => esc_html__( 'سبک 6', BIO_PLUGIN_NAME ),
					'7' => esc_html__( 'سبک 7', BIO_PLUGIN_NAME ),
					'8' => esc_html__( 'سبک 8', BIO_PLUGIN_NAME ),
					'9' => esc_html__( 'سبک 9', BIO_PLUGIN_NAME ),
					'10' => esc_html__( 'سبک 10', BIO_PLUGIN_NAME ),
					'11' => esc_html__( 'سبک 11', BIO_PLUGIN_NAME ),
					'12' => esc_html__( 'سبک 12', BIO_PLUGIN_NAME ),
					'13' => esc_html__( 'سبک 13', BIO_PLUGIN_NAME ),
					'14' => esc_html__( 'سبک 14', BIO_PLUGIN_NAME ),
					'15' => esc_html__( 'سبک 15', BIO_PLUGIN_NAME ),
					'16' => esc_html__( 'سبک 16', BIO_PLUGIN_NAME ),
					'17' => esc_html__( 'سبک 17', BIO_PLUGIN_NAME ),
					'18' => esc_html__( 'سبک 18', BIO_PLUGIN_NAME ),
					'19' => esc_html__( 'سبک 19', BIO_PLUGIN_NAME ),
					'20' => esc_html__( 'سبک 20', BIO_PLUGIN_NAME ),
					'21' => esc_html__( 'سبک 21', BIO_PLUGIN_NAME ),
					'22' => esc_html__( 'سبک 22', BIO_PLUGIN_NAME ),
					'23' => esc_html__( 'سبک 23', BIO_PLUGIN_NAME ),
					'24' => esc_html__( 'سبک 24', BIO_PLUGIN_NAME ),
					'25' => esc_html__( 'سبک 25', BIO_PLUGIN_NAME ),
					'26' => esc_html__( 'سبک 26', BIO_PLUGIN_NAME ),
					'27' => esc_html__( 'سبک 27', BIO_PLUGIN_NAME ),
					'28' => esc_html__( 'سبک 28', BIO_PLUGIN_NAME ),
					'29' => esc_html__( 'سبک 29', BIO_PLUGIN_NAME ),
					'30' => esc_html__( 'سبک 30', BIO_PLUGIN_NAME ),
				],
			]
		);

		$this->end_controls_section();

	}

	protected function register_content_section_2() {
		$this->start_controls_section(
			'section_content',
			[ 
				'label' => esc_html__( 'نمونه کار ها', BIO_PLUGIN_NAME ),
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
			'first-image',
			[ 
				'label' => esc_html__( 'تصویر اول', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
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
				'label' => esc_html__( 'sub Title 2', BIO_PLUGIN_NAME ),
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

		$repeater->add_control(
			'sec-image',
			[ 
				'label' => esc_html__( 'تصویر دوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'socials_item',
			[ 
				'label' => esc_html__( 'نمونه کار ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',

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

		$this->add_control(
			'first_image_heading',
			[ 
				'label' => esc_html__( 'تصویر اول', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_image_style( 'first_image_style', 'img.first-image' );

		$this->add_control(
			'sec_image_heading',
			[ 
				'label' => esc_html__( 'تصویر دوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_image_style( 'sec_image_style', 'img.sec-image' );

		$this->end_controls_section();
	}

    protected function register_controls() {

		$this->register_content_section_1();
		$this->register_content_section_2();
		$this->register_content_section_3();

		$this->register_carousel_controls();
		$this->register_style_carousel_controls();

	}

    protected function render() {
        $settings = $this->get_settings_for_display();
		$element_id = $settings['_element_id'];
        ?>
        <div class="theme-posts-container theme-post-widget">
            <?php
            $post_wrapper_cls = '';
                if( $settings['layout'] == 'grid' ) {
                    $post_wrapper_cls = 'theme-posts-wrapper';
                }
            ?>
            <div class="<?php echo $post_wrapper_cls ?> layout-<?php echo $settings['layout'] ?>" >
                <?php $this->render_carousel_header(); ?>
                <?php
                     foreach ( $settings['socials_item'] as $index => $item ) :
                        $post_item_cls = 'post-item';
                        if( $settings['layout'] == 'carousel' ) {
                            $post_item_cls = ' swiper-slide';
                        }

                        ?>
                        <div class="<?php echo esc_html($post_item_cls); ?>">
                            <article <?php post_class( array( 'post-wrapper', 'cart-hover-' . $settings['hover'] ) ); ?>>
                                <a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="social-item d-flex flex-row justify-content-between">
									<div class="row-1 d-flex flex-row">
										<div class="icon-1 d-flex align-items-center justify-content-center justify-content-between">
											<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
											<?php if ( $item['first-image']['url'] ) {
												?>
												<img class="first-image" src="<?php echo esc_url( $item['first-image']['url'] ); ?>">
												<?php
											}
											?>
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
											<?php if ( $item['sec-image']['url'] ) {
												?>
												<img class="sec-image" src="<?php echo esc_url( $item['sec-image']['url'] ); ?>">
												<?php
											}
											?>
										</div>
									</div>
                                </a>
                            </article>
                        </div>
                    <?php
				    endforeach; ?>
                <?php $this->render_carousel_footer(); ?>
            </div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                // Get all elements with the class '.theme-posts-carousel-wrapper'
                var carouselPosts = $('.theme-posts-carousel-wrapper');
                
                // Iterate over each carousel element
                carouselPosts.each(function() {
                    // Get settings data for the current carousel
                    var carouselSettings = $(this).data('settings');
                    
                    // Find the swiper container within the current carousel
                    var carouselContainer = $(this).find('.swiper-container')[0];
                    
                    // Initialize Swiper for the current carousel
                    var swiper<?php echo $element_id ?> = new Swiper( carouselContainer, carouselSettings );

					$( '.swiper-prev-btn<?php echo $element_id ?>' ).on( 'click', function ()
					{
						swiper<?php echo $element_id ?>.slidePrev();
					} );

					$( '.swiper-next-btn<?php echo $element_id ?>' ).on( 'click', function ()
					{
						swiper<?php echo $element_id ?>.slideNext();

                    } );
                });
            });

        </script>
        
        <?php
    }
}