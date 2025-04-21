<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use handler\basic_element_bio;

class order_bio extends \Elementor\Widget_Base {

	use basic_element_bio;

	public function is_active(){
		return true;
	}
	
	public function get_name() {
		return 'order_bio';
	}

	public function get_title() {
		return esc_html__( 'ثبت سفارش', BIO_PLUGIN_NAME );
	}

	public function get_icon() {
		return 'order_bio';
	}

	public function get_categories() {
		return ['bio-elementor-elements'];
	}

	protected function register_content_section_1() {

		$this->start_controls_section(
			'section_content',
			[ 
				'label' => esc_html__( 'محتوا', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'top-title',
			[ 
				'label' => esc_html__( 'عنوان', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'inter your text', BIO_PLUGIN_NAME ),
			]
		);

		$this->add_control(
			'top-icon',
			[ 
				'label' => esc_html__( 'ایکون بالا', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'top-image',
			[ 
				'label' => esc_html__( 'تصویر بالا', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'description',
			[ 
				'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item-title',
			[ 
				'label' => __( 'عنوان ایتم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'title',
			[ 
				'label' => __( 'عنوان', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'icon',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'titles',
			[ 
				'label' => __( 'ایتم ها', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '{{{ title }}}',
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

		$this->register_container_style( 'name-top', '.set-order' );

		$this->end_controls_section();
	}

	protected function register_style_section_2() {
		$this->start_controls_section(
			'top-title-style',
			[ 
				'label' => esc_html__( 'عنوان بالا', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'top-title', '.top-title');

		$this->end_controls_section();
	}

	protected function register_style_section_3() {
		$this->start_controls_section(
			'description-style',
			[ 
				'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'description', '.description' );

		$this->end_controls_section();
	}

	protected function register_style_section_4() {
		$this->start_controls_section(
			'title-container-style',
			[ 
				'label' => esc_html__( 'ایتم', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'title-container', '.item' );

		$this->end_controls_section();
	}

	protected function register_style_section_5() {
		$this->start_controls_section(
			'title-style',
			[ 
				'label' => esc_html__( 'عنوان', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'title', '.title', $align = false );

		$this->end_controls_section();
	}

	protected function register_style_section_6() {
		$this->start_controls_section(
			'icon-style',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'icons', '.item i', $align=false );

		$this->end_controls_section();
	}

	protected function register_style_section_7() {
		$this->start_controls_section(
			'top-icon-style',
			[ 
				'label' => esc_html__( 'ایکون بالا', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'top-icon', '.col-3 i', $align = false );

		$this->end_controls_section();
	}

	protected function register_style_section_8() {
		$this->start_controls_section(
			'item-title-style',
			[ 
				'label' => esc_html__( 'عنوان ایتم', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'item-title', '.item-title' );

		$this->end_controls_section();
	}

	protected function register_style_section_9() {
		$this->start_controls_section(
			'sep-style',
			[ 
				'label' => esc_html__( 'جداکننده', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'title-sep', '.title-sep' );

		$this->add_control(
			'description-sep-heading',
			[ 
				'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'description-sep', '.description-sep' );

		$this->add_control(
			'item-sep-heading',
			[ 
				'label' => esc_html__( 'ایتم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'item-sep', '.item-sep' );

		$this->end_controls_section();
	}

	protected function register_style_section_10() {
		$this->start_controls_section(
			'top-image-style-sec',
			[ 
				'label' => esc_html__( 'تصویر بالا', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_image_style( 'top-image-style', '.top-image' );

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
		$this->register_style_section_8();
		$this->register_style_section_9();
		$this->register_style_section_10();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="set-order">
			<div class="row">
				<div class="col-3">
					<?php \Elementor\Icons_Manager::render_icon( $settings['top-icon'], [ 'aria-hidden' => 'true' ] ); ?>
					<?php if ( $settings['top-image']['url'] ) {
						?>
						<img class="top-image" src="<?php echo esc_url( $settings['top-image']['url'] ); ?>">
						<?php
					}
					?>
				</div>
				<div class="col-9">
					<p class="top-title"><?php echo esc_html( $settings['top-title'] ); ?></p>
				</div>
			</div>
			<div class="title-sep separator"></div>
			<p class="description"><?php echo esc_html( $settings['description'] ); ?></p>
			<div class="description-sep separator"></div>
			<?php
			foreach ( $settings['titles'] as $index => $item ) :?>
				<div class="item-sep separator"></div>
				<div class="d-flex flex-row item row">
					<div class="col-12">
						<p class="item-title"><?php echo esc_html( $item['item-title'] ); ?></p>
					</div>
					<div class="col-12 d-flex flex-row">
						<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<p class="title"><?php echo esc_html( $item['title'] ); ?></p>
					</div>
				</div>
			<?php
			endforeach; ?>
		</div>
		<?php
	}

}