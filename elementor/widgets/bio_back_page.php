<?php


use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_back_page extends \Elementor\Widget_Base {

    use basic_element_bio;


    public function get_name() {
        return 'bio_back_page';
    }

    public function get_title() {
        return esc_html__('دکمه بازگشت به عقب', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_back_page';
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
        
        $this->register_text_style('btn_text',  'a', $align=false);


        $this->end_controls_tab();

        $this->start_controls_tab(
            'text-hover',
            [
                'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
            ]
        );

        $this->register_text_style('btn_hover_text',  'a:hover', $align=false);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    } 

    protected function register_controls() {
        $this->register_content_section_1();
        $this->register_style_section_1();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <a class="d-flex align-items-center share-link-btn" href="javascript:history.back()">
            <?php echo esc_html($settings['btn_title']);?>
        </a>
        <?php
    }
}