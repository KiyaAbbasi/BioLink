<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\basic_element_bio;

class save_vcf_bio extends  \Elementor\Widget_Base {

	use basic_element_bio;

	public function is_active(){
		return true;
	}
    
    public function get_name() {
        return 'save_vcf_bio';
    }

    public function get_title() {
        return __( 'ذخیره مخاطب', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'save_vcf_bio';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }
	protected function register_content_section_1() {
		$this->start_controls_section(
			'content_section',
			[ 
				'label' => __( 'ذخیره مخاطب', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'text',
			[ 
				'label' => esc_html__( 'متن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'file',
			[ 
				'label' => esc_html__( 'انتخاب فایل', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => [ 'vcf' ]
			]
		);
		$this->end_controls_section();
	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'style_section',
			[ 
				'label' => esc_html__( 'استایل', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'downloadLink', 'a#downloadLink' );

		$this->end_controls_section();
	}
    protected function register_controls() {
		$this->register_content_section_1();
		$this->register_style_section_1();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="social-media">
            <div class="row social-row">
                <div class="col ">
                    <a id="downloadLink" href="<?php echo esc_url($settings['file']['url']); ?>" target="_blank" download> <?php echo esc_html($settings['text']); ?></a>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('downloadLink').addEventListener('click', function() {
                var currentUrl = window.location.href;
                this.href = '<?php echo esc_url($settings['file']['url']); ?>';
                this.click();
                setTimeout(function() {
                    window.location.href = currentUrl;
                }, 1000);
            });
        </script>
            <?php
    }
}