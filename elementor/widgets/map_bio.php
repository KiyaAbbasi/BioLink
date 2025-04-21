<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\basic_element_bio;

class map_bio extends \Elementor\Widget_Base {

	use basic_element_bio;

	public function is_active(){
		return true;
	}
	
	public function get_name() {
		return 'map_bio';
	}

	public function get_title() {
		return esc_html__( 'نقشه', BIO_PLUGIN_NAME );
	}

	public function get_icon() {
		return 'map_bio';
	}

	public function get_categories() {
		return ['bio-elementor-elements'];
	}

	protected function register_content_section_1() {
		$this->start_controls_section(
			'section_content',
			[ 
				'label' => esc_html__( 'نقشه', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'link',
			[ 
				'label' => esc_html__( 'ادرس لینک', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'settings',
			[ 
				'label' => esc_html__( 'استایل', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'map', '.map' );


		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_content_section_1();
		$this->register_style_section_1();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<iframe class="map" src="<?php echo esc_url( $settings['link']);?>"></iframe>
		<?php
	}

}