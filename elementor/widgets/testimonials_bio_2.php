<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\swiper_bio;
use handler\basic_element_bio;

class testimonials_bio_2 extends \Elementor\Widget_Base {

	use swiper_bio;
	use basic_element_bio;

	public function is_active(){
		return true;
	}
	
    public function get_name() {
        return 'testimonials_bio_2';
    }

    public function get_title() {
        return esc_html__( 'نظرات مشتریان 2', BIO_PLUGIN_NAME );
    }

    public function get_icon() {
        return 'testimonials_bio_2';
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
            'testimonials_section',
            [
                'label' => __( 'نظرات', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'avatar_name',
            [
                'label' => __( 'نام', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

		$repeater->add_control(
			'description',
			[ 
				'label' => __( 'توصیف', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
            'avatar-desc',
            [
                'label' => __( 'نظر', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

		$repeater->add_control(
			'avatar-image',
			[
				'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
            'testimonials_bio',
            [
                'label' => __( 'نظرات', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ avatar_name }}}',
            ]
        );

        $this->end_controls_section();
    }

	protected function register_style_section_1(){
		$this->start_controls_section(
			'container',
			[ 
				'label' =>  esc_html__( 'بدنه', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'container', 'article' );

		$this->add_control(
			'image',
			[ 
				'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_image_style( 'image', 'img' );

		$this->add_control(
			'name',
			[ 
				'label' => esc_html__( 'نام', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'name', '.name', $align = false );

		$this->add_control(
			'descriptions',
			[ 
				'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'descriptions-style', '.description' );

		$this->add_control(
			'description',
			[ 
				'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'description', '.body' );

		$this->end_controls_section();
	} 
	protected function register_controls() {

		$this->register_content_section_1();
		$this->register_content_section_2();

		$this->register_style_section_1();

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
					foreach ( $settings['testimonials_bio'] as $index => $item ) :
                        $post_item_cls = 'post-item';
                        if( $settings['layout'] == 'carousel' ) {
                            $post_item_cls = ' swiper-slide';
                        }
                        ?>
                        <div class="<?php echo esc_html($post_item_cls); ?>">
                            <article <?php post_class( array( 'post-wrapper', 'cart-hover-' . $settings['hover'] ) ); ?>>
								<div class="d-flex flex-row algin-item-start">
									<div class="img"><img src="<?php echo esc_url( $item['avatar-image']['url'] ); ?>"></div>
									<div class="d-flex flex-column">
										<p class="name"><?php echo esc_html( $item['avatar_name'] ); ?></p>
										<p class="description"><?php echo esc_html( $item['description'] ); ?></p>
									</div>
								</div>
								<p class="body"><?php echo esc_html( $item['avatar-desc'] ); ?></p>
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