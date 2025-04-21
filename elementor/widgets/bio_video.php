<?php


use handler\basic_element_bio;
use handler\video_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_video extends \Elementor\Widget_Base {

    use basic_element_bio;
    use video_bio;


    public function get_name() {
        return 'bio_video';
    }

    public function get_title() {
        return esc_html__('ویدئو بایو', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_video';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

    protected function register_content_section_1() {
        $this->start_controls_section(
            'login_form_labels_section',
            [
                'label' => __( 'ویدئو', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,

            ]
        );

        $this->add_control(
            'poster',
            [
                'label' => esc_html__( 'پوستر', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => [ 'image' ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'video',
            [
                'label' => esc_html__( 'ویدئو', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => [ 'video' ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->end_controls_section();
    } 

    protected function register_controls() {

        $this->register_content_section_1();
        $this->register_style_video_controls();

        $this->register_video_controls();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $plyr_id = $this->get_id();
        $video = $settings['video']['url'];
        $poster = $settings['poster']['url'];

        $this->render_video($plyr_id, $video, $poster);
    }

}