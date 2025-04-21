<?php


use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_copy_link extends \Elementor\Widget_Base {

    use basic_element_bio;


    public function get_name() {
        return 'bio_copy_link';
    }

    public function get_title() {
        return esc_html__('کپی لینک', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_copy_link';
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
			'link',
			[ 
				'label' => esc_html__( 'لینک', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::URL,
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
        
        $this->register_text_style('btn_text',  'p', $align=false);

        $this->add_control(
            'icon',
            [
                'label'     => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->register_text_style('btn_icon',  'i', $align=false);


        $this->end_controls_tab();

        $this->start_controls_tab(
            'text-hover',
            [
                'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
            ]
        );

        $this->register_text_style('btn_hover_text',  'box-share-btn:hover', $align=false);

        $this->add_control(
            'icon-hover',
            [
                'label'     => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->register_text_style('btn_hover_text',  'i:hover', $align=false);

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
            <div class="share-box-link m-0">
                <div type="submit" class="d-flex align-items-center share-link-btn">
                    <p class="share-text"><?php echo esc_html($settings['btn_title']);?></p>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <span class="copied-popup-text"><?php esc_html_e('لینک کپی شد', BIO_PLUGIN_NAME) ?></span>
                </div>
                <input type="text" name="url" value="<?php echo urldecode( $settings['link']['url'] ); ?>" class="d-none share-link-text" readonly>
            </div>
        <?php
    }
}