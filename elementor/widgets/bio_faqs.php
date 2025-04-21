<?php

use handler\basic_element_bio;

class bio_faqs extends \Elementor\Widget_Base {

	use basic_element_bio;

	public function get_name() {
		return 'bio_faqs';
	}

	public function get_title() {
		return esc_html__( 'سوالات متداول', BIO_PLUGIN_NAME );
	}

	public function get_icon() {
		return 'bio_faqs';
	}

	public function get_categories() {
        return ['bio-elementor-elements'];
    }

	protected function register_content_section_1() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'سوالات', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
            'question',
            [
                'label' => __( 'سوال', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

		$repeater->add_control(
			'first-image',
			[ 
				'label' => esc_html__( 'تصویر اول', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'first-icon',
			[ 
				'label' => esc_html__( 'ایکون اول', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'icon-1',
			[ 
				'label' => esc_html__( 'ایکون باز کردن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'icon-2',
			[ 
				'label' => esc_html__( 'ایکون بستن', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);


		$repeater->add_control(
            'answer',
            [
                'label' => __( 'پاسخ', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

		$this->add_control(
            'faq',
            [
                'label'       => esc_html__( 'سوالات', BIO_PLUGIN_NAME ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ question }}}',
            ]
        );

		$this->end_controls_section();
	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'question_styles',
			[
				'label' => esc_html__( 'سوال', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->register_text_style('question',  '.faq-bio .question');

		$this->end_controls_section();
	}

	protected function register_style_section_2() {
		$this->start_controls_section(
			'answers_styles',
			[
				'label' => esc_html__( 'پاسخ', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->register_text_style('answers',  '.faq-bio .answers');

		$this->end_controls_section();
	}

	protected function register_style_section_3() {
		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__( 'جعبه', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->register_container_style('box',  '.faq-bio-body');

		$this->end_controls_section();
	}

	protected function register_style_section_4() {
		$this->start_controls_section(
			'icons_styles',
			[ 
				'label' => esc_html__( 'ایکون ها', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'icon-1-style',
			[ 
				'label' => esc_html__( 'ایکون اول', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'label-icon', '.label-icon', $algin=false );

		$this->add_control(
			'icon-2-style',
			[ 
				'label' => esc_html__( 'کانتینر ایکن دوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'faq-plus-container', '.faq-bio-plus', $algin = false );

		$this->add_control(
			'icon-2-style',
			[ 
				'label' => esc_html__( 'ایکون دوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'faq-plus', '.faq-bio-plus i', $algin = false );

		$this->add_control(
			'icon-3-style',
			[ 
				'label' => esc_html__( 'کانتینر ایکون سوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'faq-minus-container', '.faq-bio-minus', $algin = false );

		$this->add_control(
			'icon-3-style',
			[ 
				'label' => esc_html__( 'ایکون سوم', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'faq-minus', '.faq-bio-minus i', $algin = false );


		$this->end_controls_section();
	}

	protected function register_style_section_5() {
		$this->start_controls_section(
			'image_styles',
			[ 
				'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_image_style( 'first_image_style_normal', '.first-image' );

		$this->end_controls_section();
	}

    protected function register_controls() {
		
		$this->register_content_section_1();

        $this->register_style_section_1();
        $this->register_style_section_2();
        $this->register_style_section_3();
		$this->register_style_section_4();
		$this->register_style_section_5();
	}


	protected function render() {
		$settings = $this->get_settings();
		$index = 0;
		if (empty($settings['faq'])) {
			return;
		}
		?>
		<div class="faq-bio">
			<?php foreach ($settings['faq'] as $faq_item) : ?>
				<div class="faq-bio-body">
					<input type="checkbox" id="question<?php echo esc_attr($index + 1); ?>" class="questions">
					<label for="question<?php echo esc_attr($index + 1); ?>" class="question d-flex flex-row justify-content-between">
						<div class="d-flex flex-row align-items-center">
							<div class="label-icon">
								<?php \Elementor\Icons_Manager::render_icon( $faq_item['first-icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php if ( $faq_item['first-image']['url'] ) {
									?>
									<img class="first-image" src="<?php echo esc_url( $faq_item['first-image']['url'] ); ?>">
									<?php
								}
								?>
							</div>
							<?php echo esc_html($faq_item['question']); ?>
						</div>
							<div class="arrow-container-bio d-flex flex-row align-items-center">
							<div class="faq-bio-plus">
								<?php \Elementor\Icons_Manager::render_icon( $faq_item['icon-1'], [ 'aria-hidden' => 'true' ] ); ?>
							</div>
							<div class="faq-bio-minus">
								<?php \Elementor\Icons_Manager::render_icon( $faq_item['icon-2'], [ 'aria-hidden' => 'true' ] ); ?>
							</div>
						</div>
					</label>
					<div class="answers">
						<?php echo esc_html($faq_item['answer']); ?>
					</div>
				</div>
			<?php $index += 1;
			 endforeach; ?>
		</div>
		<?php
	}
}