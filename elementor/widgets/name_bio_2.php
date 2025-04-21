<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\basic_element_bio;

class name_bio_2 extends \Elementor\Widget_Base {

	use basic_element_bio;

	public function is_active(){
		return true;
	}
	
	public function get_name() {
		return 'name_bio_2';
	}

	public function get_title() {
		return esc_html__( 'نام 2', BIO_PLUGIN_NAME );
	}

	public function get_icon() {
		return 'name_bio_2';
	}

	public function get_categories() {
		return ['bio-elementor-elements'];
	}

	protected function register_content_section_1() {

		$this->start_controls_section(
			'section_content',
			[ 
				'label' => esc_html__( 'نام', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[ 
				'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [ 
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'title',
			[ 
				'label' => esc_html__( 'عنوان', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'inter your text', BIO_PLUGIN_NAME ),
			]
		);

		$this->add_control(
			'title-2',
			[ 
				'label' => esc_html__( 'عنوان 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'inter your text', BIO_PLUGIN_NAME ),
			]
		);

		$this->add_control(
			'description',
			[ 
				'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
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
			'name-top',
			[ 
				'label' => esc_html__( 'کانتینر', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'name-top', '.name-top' );

		$this->end_controls_section();
	}

	protected function register_style_section_2() {
		$this->start_controls_section(
			'image-top',
			[ 
				'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_image_style( 'img', 'img');

		$this->end_controls_section();
	}

	protected function register_style_section_3() {
		$this->start_controls_section(
			'name-container',
			[ 
				'label' => esc_html__( 'کانتینر نام', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'name-container', '.name-container' );

		$this->end_controls_section();
	}

	protected function register_style_section_4() {
		$this->start_controls_section(
			'name',
			[ 
				'label' => esc_html__( 'نام', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'name', 'h1.name' );

		$this->end_controls_section();
	}

	protected function register_style_section_5() {
		$this->start_controls_section(
			'name-detail',
			[ 
				'label' => esc_html__( 'جزئیات نام', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'name-detail', '.name-detail p', $align = false );

		$this->end_controls_section();
	}

	protected function register_style_section_6() {
		$this->start_controls_section(
			'resume-text',
			[ 
				'label' => esc_html__( 'متن رزومه', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'resume', 'a.resume' );

		$this->add_control(
			'icon-hover',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->register_text_style( 'resume-icon', 'a.resume i' );

		$this->end_controls_section();
	}

	protected function register_style_section_7() {
		$this->start_controls_section(
			'name-2',
			[ 
				'label' => esc_html__( 'نام 2', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'name-2', 'p.name-2' );

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_content_section_1();
		$this->register_style_section_1();
		$this->register_style_section_2();
		$this->register_style_section_3();
		$this->register_style_section_4();
		$this->register_style_section_5();
		$this->register_style_section_6();
		$this->register_style_section_7();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="name-top d-flex flex-row align-items-center">
			<div class="d-flex flex-column align-items-center">
				<div class="name-container">
				<h1 class="name"><?php echo esc_html( $settings['title'] ); ?></h1>
					<p class="name-2"><?php echo esc_html( $settings['title-2'] ); ?></p>
					<div class="name-detail">
						<?php echo wp_kses_post( $settings['description'] ); ?>
					</div>
				</div>
				<a href="<?php echo urldecode( $settings['link']['url'] ); ?>" class="resume">
					<?php echo esc_html( $settings['btn_title'] ); ?>
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</a>
			</div>
			<div class="text-center" style="z-index: 1;">
				<img src="<?php echo esc_url( $settings['image']['url']); ?>" class="avatar-img" loading="lazy">
			</div>
		</div>
		<?php
	}

}