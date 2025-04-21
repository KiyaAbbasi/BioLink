<?php


use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_share extends \Elementor\Widget_Base {

    use basic_element_bio;


    public function get_name() {
        return 'bio_share';
    }

    public function get_title() {
        return esc_html__('اشتراک گذاری صفحه', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_share';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

    protected function register_content_section_1(){

        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__( 'چیدمان', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__( 'عنوان دکمه', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'ایکون دکمه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);


        $this->add_control(
            'telegram',
            [
                'label'     => esc_html__( 'تلگرام', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );
        
        $this->add_control(
            'whatsapp',
            [
                'label'     => esc_html__( 'واتساپ', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );
        
        $this->add_control(
            'twitter',
            [
                'label'     => esc_html__( 'توییتر', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );
        
        $this->add_control(
            'email',
            [
                'label'     => esc_html__( 'ایمیل', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );
        
        $this->add_control(
            'facebook',
            [
                'label'     => esc_html__( 'فیس بوک', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );
        
        $this->add_control(
            'linkedin',
            [
                'label'     => esc_html__( 'لینکداین', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'pinterest',
            [
                'label'     => esc_html__( 'پینترست', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => esc_html__( 'لینک', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->end_controls_section();

    } 

    protected function register_style_section_1() {
        $this->start_controls_section(
            'btn-text',
            [
                'label' => esc_html__( 'متن', BIO_PLUGIN_NAME ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'btn-text-style' );

        $this->start_controls_tab(
            'text-normal',
            [
                'label' => esc_html__( 'عادی', BIO_PLUGIN_NAME ),
            ]
        );
        
        $this->register_text_style('btn_text',  '.share-text', $align=false);


        $this->add_control(
            'icon-separator',
            [
                'label'     => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->register_text_style('btn_icon',  '.share-icon i', $align=false);


        $this->end_controls_tab();

        $this->start_controls_tab(
            'text-hover',
            [
                'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
            ]
        );

        $this->register_text_style('btn_hover_text',  'box-share-btn:hover', $align=false);

		$this->add_control(
			'text-hover',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->register_text_style( 'btn_text', 'box-share-btn:hover .share-text', $align = false );

        $this->add_control(
            'icon-hover',
            [
                'label'     => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->register_text_style('btn_hover_text',  'box-share-btn:hover .share-icon i', $align=false);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'چینش',
            [
                'label'     => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'text_align', [
                'label' => esc_html__('چینش', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [

                    'left' => [
                        'title' => esc_html__('چپ', BIO_PLUGIN_NAME),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'راست', BIO_PLUGIN_NAME),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .box-share-btn' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    } 

    protected function register_style_section_2() {
        $this->start_controls_section(
            'post_style_section',
            [
                'label' => esc_html__( 'کانتینر', BIO_PLUGIN_NAME ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->register_container_style('box',  '.single-share-box-container');

		$this->add_control(
			'social-icon',
			[ 
				'label' => esc_html__( 'ایکن شبکه های اجتماعی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->register_text_style( 'text', '.social-icon', $align = false );

		$this->end_controls_section();

	} 

    protected function register_controls() {
        $this->register_content_section_1();
        $this->register_style_section_1();
        $this->register_style_section_2();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="box-share-btn">
                <p class="share-text"><?php echo esc_html($settings['btn_title']);?></p>
                <div class="share-icon d-flex">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
            <div class="single-share-box-container">
                <?php
                global $post;
                $share_url = get_permalink();
                $share_title = htmlspecialchars(get_the_title(), ENT_COMPAT, 'UTF-8');
                $post_id = get_the_ID();
                $share_media = wp_get_attachment_url( get_post_thumbnail_id($post_id), 'full' );
                ?>
                <div class="single-share-box">
                    <?php if( $settings['telegram'] ){ ?>
                        <a class="social-icon" href="https://t.me/share/?url=<?php echo esc_url($share_url); ?>&text=<?php echo urlencode($share_title); ?>" target="_blank"><i class="isax isax-send-2"></i></a>
                    <?php } 
                    if( $settings['whatsapp'] ){ ?>
                        <a class="social-icon" href="https://api.whatsapp.com/send?text=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <?php }
                    if( $settings['twitter'] ){ ?>
                        <a class="social-icon" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($share_title); ?>&url=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fab fa-x-twitter"></i></a>
                    <?php }
                    if( $settings['email'] ){ ?>
                        <a class="social-icon" href="mailto:?subject=<?php echo urlencode($share_title); ?>&body=<?php echo esc_url($share_url); ?>" target="_blank"><i class="isax isax-directbox-send4"></i></a>
                    <?php }
                    if( $settings['facebook'] ){ ?>
                        <a class="social-icon" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <?php }
                    if( $settings['linkedin'] ){ ?>
                        <a class="social-icon" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($share_url); ?>&title=<?php echo urlencode($share_title); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <?php }
                    if( $settings['pinterest'] ){ ?>
                        <a class="social-icon" href="https://pinterest.com/pin/create/link/?url=<?php echo esc_url($share_url); ?>&media=<?php echo esc_url($share_media); ?>&description=<?php echo urlencode($share_title); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                    <?php } ?>
                </div>
                <?php if( $settings['link'] ){ ?>
                    <div class="share-box-link">
                        <div class="form-content">
                            <button type="submit" class="share-link-btn">
                                <i class="isax isax-document-copy4"></i>
                                <span class="copied-popup-text"><?php esc_html_e('لینک کپی شد!', BIO_PLUGIN_NAME) ?></span>
                            </button>
                            <input type="text" name="url" value="<?php echo urldecode( get_the_permalink() ); ?>" class="share-link-text" readonly>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php
    }
}