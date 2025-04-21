<?php

use handler\basic_element_bio;

class bio_image_tab extends \Elementor\Widget_Base {

	use basic_element_bio;

	public function get_name() {
		return 'bio_image_tab';
	}

	public function get_title() {
		return esc_html__( 'تب تصویر', BIO_PLUGIN_NAME );
	}

	public function get_icon() {
		return 'bio_image_tab';
	}

	public function get_categories() {
        return ['bio-elementor-elements'];
    }

	protected function register_content_section_1() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'تب تصویر', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[ 
				'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [ 
					'active' => true,
				]
			]
		);

		$repeater->add_control(
            'title',
            [
                'label' => __( 'عنوان', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [ 
					'active' => true,
				]
            ]
        );

		$repeater->add_control(
            'description',
            [
                'label' => __( 'توصیف', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [ 
					'active' => true,
				]
            ]
        );

		$repeater->add_control(
			'icon',
			[ 
				'label' => __( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'link',
			[ 
				'label' => __( 'لینک', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::URL,
			]
		);

		$this->add_control(
            'item',
            [
                'label'       => esc_html__( 'ایتم ها', BIO_PLUGIN_NAME ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

		$this->end_controls_section();
	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'title_styles',
			[
				'label' => esc_html__( 'عنوان', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->register_text_style('title',  '.title');

		$this->add_control(
			'description',
			[ 
				'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'description', '.description' );

		$this->add_control(
			'icon',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'icon', '.icon' );

		$this->add_control(
			'line',
			[ 
				'label' => esc_html__( 'خط', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'rec', '.rec' );

		$this->add_control(
			'container',
			[ 
				'label' => esc_html__( 'کانتینر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'row', '.row-one' );


		$this->end_controls_section();
	}

	protected function register_style_section_2() {
		$this->start_controls_section(
			'container',
			[ 
				'label' => esc_html__( 'استایل', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[ 
				'label' => esc_html__( 'عادی', BIO_PLUGIN_NAME ),
			]
		);

		$this->register_image_style( 'image', 'img' );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[ 
				'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
			]
		);

		$this->register_image_style( 'img_hover', '.gallery-card:hover img' );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

    protected function register_controls() {
		
		$this->register_content_section_1();

        $this->register_style_section_1();
		$this->register_style_section_2();
	}


	protected function render() {
		$settings = $this->get_settings();
		if (empty($settings['item'])) {
			return;
		}
		?>
		<div class="gallery-tab">
			<?php foreach ($settings['item'] as $item) : ?>
				<div class="gallery-card">
					<a href="<?php echo esc_attr( $item['link']['url'] ); ?>">
						<img src="<?php echo esc_url( $item['image']['url'] ); ?>">
						<div class="row row-one">
							<div class="col-12 row p-0 align-items-center">
								<div class="rec p-0"></div>
								<div>
									<p class="title">
										<?php echo esc_html( $item['title'] ); ?>
									</p>
									<div class="d-flex btm-desc">
										<div class="icon d-flex align-items-center justify-content-center">
											<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
										</div>
										<p class="description">
											<?php echo esc_html( $item['description'] ); ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}