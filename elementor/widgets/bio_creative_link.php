<?php

use handler\basic_element_bio;


if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_creative_link extends \Elementor\Widget_Base {

    use basic_element_bio;

    public function get_name() {
        return 'bio_creative_link';
    }

    public function get_title() {
        return esc_html__('لینک خلاقانه', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_creative_link';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

    protected function register_content_section_1() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'محتوی لینک', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'link_text',
            [
                'label'       => esc_html__( 'عنوان', BIO_PLUGIN_NAME ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'link_url',
            [
                'label'         => esc_html__( 'لینک', BIO_PLUGIN_NAME ),
                'type'          => \Elementor\Controls_Manager::URL,
            ]
        );

        $this->add_responsive_control(
            'link_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .theme-creative-link' => 'justify-content: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'animation_style',
            [
                'label'   => esc_html__( 'استایل انیمیشن', BIO_PLUGIN_NAME ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1'      => esc_html__( 'سبک 1', BIO_PLUGIN_NAME ),
                    'style-2'      => esc_html__( 'سبک 2', BIO_PLUGIN_NAME ),
                    'style-3'      => esc_html__( 'سبک 3', BIO_PLUGIN_NAME ),
                    'style-4'      => esc_html__( 'سبک 4', BIO_PLUGIN_NAME ),
                    'style-5'      => esc_html__( 'سبک 5', BIO_PLUGIN_NAME ),
                    'style-6'      => esc_html__( 'سبک 6', BIO_PLUGIN_NAME ),
                    'style-7'      => esc_html__( 'سبک 7', BIO_PLUGIN_NAME ),
                    'style-8'      => esc_html__( 'سبک 8', BIO_PLUGIN_NAME ),
                    'style-9'      => esc_html__( 'سبک 9', BIO_PLUGIN_NAME ),
                    'style-10'     => esc_html__( 'سبک 10', BIO_PLUGIN_NAME ),
                    'style-11'     => esc_html__( 'سبک 11', BIO_PLUGIN_NAME ),
                    'style-12'     => esc_html__( 'سبک 12', BIO_PLUGIN_NAME ),
                    'style-13'     => esc_html__( 'سبک 13', BIO_PLUGIN_NAME ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_section_1() {
        $this->start_controls_section(
            'section_media_style',
            [
                'label' => esc_html__( 'محتوای لینک', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
			'count_style_tabs'
	    );

	    $this->start_controls_tab(
		    'count_style_normal_tab',
		    [
			    'label' => esc_html__( 'عادی', BIO_PLUGIN_NAME ),
		    ]
	    );
		
		$this->register_text_style('link',  '.theme-creative-link a', $align=false);
	    
	    $this->end_controls_tab();

	    $this->start_controls_tab(
		    'count_style_hover_tab',
		    [
			    'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
		    ]
	    );

		$this->register_text_style('link_hover',  '.theme-creative-link a:hover', $align=false);

	    $this->end_controls_tab();
	    $this->end_controls_tabs();
   
        $this->end_controls_section();
    }
    
    protected function register_controls() {
        
        $this->register_content_section_1();

        $this->register_style_section_1();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="theme-creative-link">
            <a href="<?php echo esc_attr( $settings['link_url']['url'] ); ?>" class="theme-link-<?php echo esc_attr( $settings['animation_style'] ); ?>" data-text="<?php echo esc_attr( $settings['link_text'] ); ?>">
                <span><?php echo esc_attr( $settings['link_text'] ); ?></span>
            </a>
        </div>

        <?php
    }

}