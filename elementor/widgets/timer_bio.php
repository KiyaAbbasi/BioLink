<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\basic_element_bio;

class timer_bio extends \Elementor\Widget_Base {

	use basic_element_bio;

	public function is_active(){
		return true;
	}

    public function get_name() {
        return 'timer_bio';
    }

    public function get_title() {
        return esc_html__( 'شمارش معکوس', BIO_PLUGIN_NAME );
    }

    public function get_icon() {
        return 'timer_bio';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }
	protected function register_content_section_1() {
		$this->start_controls_section(
			'section_content',
			[ 
				'label' => esc_html__( 'تنظیمات', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'event_date',
			[ 
				'label' => __( 'انتخاب تاریخ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'styles',
			[ 
				'label' => esc_html__( 'استایل', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'count-down-body', '.count-down-body' );

		$this->add_control(
			'number',
			[ 
				'label' => esc_html__( 'شماره', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->register_text_style( 'number', '.number', $align = false );

		$this->add_control(
			'text',
			[ 
				'label' => esc_html__( 'متن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->register_text_style( 'title', '.time-title', $align = false );

		$this->end_controls_section();

	}

    protected function register_controls() {
		$this->register_content_section_1();
		$this->register_style_section_1();
    }

    protected function render() {
        $settings = $this->get_settings();
		$element_id = $settings['_element_id'];
        ?>
        <div class="count-down-body">
            <div class="single-time">
                <p class="number" id="days<?php echo $element_id ?>">12</p>
                <p class=time-title>روز</p>
            </div>
            <div class="single-time">
                <p class="number" id="hours<?php echo $element_id ?>">34</p>
                <p class=time-title>ساعت</p>
            </div>
            <div class="single-time">
                <p class="number" id="minutes<?php echo $element_id ?>">56</p>
                <p class=time-title>دقیقه</p>
            </div>
            <div class="single-time">
                <p class="number" id="seconds<?php echo $element_id ?>">12</p>
                <p class=time-title>ثانیه</p>
            </div>
        </div>
        <script>
            function updateCountdown() {
                var e = new Date("<?php echo $settings['event_date'] ?>").getTime() - new Date().getTime();
                if (e > 0)
                    var t = Math.floor(e / 864e5),
                        n = Math.floor((e % 864e5) / 36e5),
                        o = Math.floor((e % 36e5) / 6e4),
                        d = Math.floor((e % 6e4) / 1e3);
                else{
                    t = 0;
                    n = 0;
                    o = 0;
                    d = 0
                }
                document.getElementById("days<?php echo $element_id ?>").innerHTML = t + "";
                document.getElementById("hours<?php echo $element_id ?>").innerHTML = n + "";
                document.getElementById("minutes<?php echo $element_id ?>").innerHTML = o + " ";
                document.getElementById("seconds<?php echo $element_id ?>").innerHTML = d + "";
            }
            jQuery(document).ready(function($) {
                (setInterval(updateCountdown, 1e3), updateCountdown());
            });

        </script>
        <?php
    }


}