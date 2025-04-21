<?php

use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_promo_box extends \Elementor\Widget_Base {

    use basic_element_bio;

    public function get_name() {
        return 'bio-promo-box';
    }

    public function get_title() {
        return esc_html__('باکس تبلیغات', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_promo_box';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }
    
    protected function register_content_section_1(){
        $this->start_controls_section(
            'section_promo_content',
            [
                'label' => esc_html__( 'محتوا', BIO_PLUGIN_NAME),
            ]
        );

        $this->add_control(
            'promo_image',
            [
                'label' => esc_html__('تصویر', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'promo_image_size',
                'default' => 'large',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'promo_heading',
            [
                'label' => esc_html__('عنوان', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'promo_link',
            [
                'label' => esc_html__( 'لینک', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'promo_content',
            [
                'label' => esc_html__('بدنه', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $this->end_controls_section();
    }


    protected function register_style_section_1() {
        $this->start_controls_section(
            'section_promo_settings',
            [
                'label' => esc_html__('افکت', BIO_PLUGIN_NAME),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'promo_effect',
            [
                'label' => esc_html__('افکت', BIO_PLUGIN_NAME),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'effect-1',
                'options' => [
                    'effect-1'  => esc_html__('سبک 1', BIO_PLUGIN_NAME),
                    'effect-2'  => esc_html__('سبک 2', BIO_PLUGIN_NAME),
                    'effect-3'  => esc_html__('سبک 3', BIO_PLUGIN_NAME),
                    'effect-4'  => esc_html__('سبک 4', BIO_PLUGIN_NAME),
                    'effect-5'  => esc_html__('سبک 5', BIO_PLUGIN_NAME),
                    'effect-6'  => esc_html__('سبک 6', BIO_PLUGIN_NAME),
                    'effect-7'  => esc_html__('سبک 7', BIO_PLUGIN_NAME),
                    'effect-8'  => esc_html__('سبک 8', BIO_PLUGIN_NAME),
                    'effect-9'  => esc_html__('سبک 9', BIO_PLUGIN_NAME),
                    'effect-10' => esc_html__('سبک 10', BIO_PLUGIN_NAME),
                    'effect-11' => esc_html__('سبک 11', BIO_PLUGIN_NAME),
                    'effect-12' => esc_html__('سبک 12', BIO_PLUGIN_NAME),
                    'effect-13' => esc_html__('سبک 13', BIO_PLUGIN_NAME),
                    'effect-14' => esc_html__('سبک 14', BIO_PLUGIN_NAME),
                    'effect-15' => esc_html__('سبک 15', BIO_PLUGIN_NAME),
                    'effect-16' => esc_html__('سبک 16', BIO_PLUGIN_NAME),
                ],
            ]
        );

        $this->register_container_style('figure', '.theme-promo-box figure');

        $this->end_controls_section();
    }

    protected function register_style_section_2() {
        $this->start_controls_section(
            'section_promo_styles',
            [
                'label' => esc_html__('عناوین', BIO_PLUGIN_NAME),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

	    $this->add_control(
		    'title_heading',
		    [
			    'label' => esc_html__( 'هیدینگ ها', BIO_PLUGIN_NAME ),
			    'type' => \Elementor\Controls_Manager::HEADING,
		    ]
	    );


	    $this->register_text_style('promo-title', '.promo-title');

	    $this->add_control(
		    'title_content',
		    [
			    'label' =>  esc_html__( 'بدنه', BIO_PLUGIN_NAME ),
			    'type' => \Elementor\Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

        $this->register_text_style('promo-p', 'p');

        $this->end_controls_section();
    }

    protected function register_controls() {

        $this->register_content_section_1();

        $this->register_style_section_1();
        $this->register_style_section_2();        
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

                
        ?>
        <div class="theme-promo-box">
            <figure class="<?php echo esc_attr($settings['promo_effect']); ?>">
                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'promo_image_size', 'promo_image' ); ?>
                <figcaption>
                    <div>
                        <?php if (!empty($settings['promo_heading'])) : ?>
                            <div class="promo-title"><span><?php echo esc_attr($settings['promo_heading']); ?></span></div>
                        <?php endif; ?>

                        <?php echo wp_kses_post(wpautop($settings['promo_content'])); ?>
                    </div>
                    <?php
                    if ( ! empty( $settings['promo_link']['url'] ) ) {
                        $this->add_link_attributes( 'promo_link', $settings['promo_link'] );

                        echo '<a ';
                        $this->print_render_attribute_string( 'promo_link' );
                        echo '></a>';
                    }
                    ?>
                </figcaption>
            </figure>
        </div>
        <?php
    }

}