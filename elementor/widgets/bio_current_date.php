<?php

use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_current_date extends \Elementor\Widget_Base {

    use basic_element_bio;

    public function get_name() {
        return 'bio_current_date';
    }

    public function get_title() {
        return esc_html__('تاریخ فعلی', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_current_date';
    }


    public function get_categories() {
        return ['bio-elementor-elements'];
    }

    protected function register_content_section_1() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'محتوا', BIO_PLUGIN_NAME),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'date_format',
            [
                'label' => esc_html__( 'فرمت تاریخ', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'l j F Y',
            ]
        );

        $this->add_control(
            'date_format_info',
            [
                'type'      => \Elementor\Controls_Manager::RAW_HTML,
                'raw'       => sprintf(esc_html__('%s داکیومنت فرمت تاریخ %s', BIO_PLUGIN_NAME), '<a href="https://wordpress.org/support/article/formatting-date-and-time/" target="_blank">', '</a>'),
            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} .current-date-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_section_1() {
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__( 'محتوا', BIO_PLUGIN_NAME),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->register_text_style('current_date',  '.date', $align=false);

        $this->end_controls_section();

    }

    protected function register_controls(){

        $this->register_content_section_1();

        $this->register_style_section_1();
    }
	protected function convert_date( $date, $format ) {
		$current_locale = get_locale();

		if ( $current_locale === 'fa_IR' ) {
            require_once BIO_PLUGIN_DIR . '/inc/jdatatime.php';
            $date_format = ! empty( $format ) ? $format : 'F j, Y';

            $jdatetime = new JDateTime( true, true, 'Asia/Tehran' );
            $formatted_date = $jdatetime->date( $date_format, strtotime( $date ) ); // Format the provided date
			
		} else {
			// Use current_time() for non-fa_IR locale
			$formatted_date = current_time( $format, strtotime( $date ) ); // Format the provided date
		}

		return $formatted_date;
	}
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $date_format = $settings['date_format'];
        ?>
        <div class="current-date-wrapper">
            <div class="current-date">
                <div class="date">
                    <?php echo $this->convert_date( current_time( $settings['date_format'], true ), $date_format ); ?>
                </div>
            </div>
        </div>
        <?php
    }

}