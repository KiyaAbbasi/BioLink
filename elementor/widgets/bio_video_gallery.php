<?php

use handler\basic_element_bio;
use handler\video_bio;

class bio_video_gallery extends \Elementor\Widget_Base {

	use basic_element_bio;
    use video_bio;

    public function get_name() {
        return 'bio_video_gallery';
    }

    public function get_title() {
        return esc_html__( 'ویدئو گالری', BIO_PLUGIN_NAME );
    }

    public function get_icon() {
        return 'bio_video_gallery';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

	protected function register_content_section_1() {
		$this->start_controls_section(
            'video-1',
            [
                'label' => __( 'ویدئو ها', BIO_PLUGIN_NAME ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'video-title',
            [
                'label' => __( 'نام', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

		$repeater->add_control(
            'video-desc',
            [
                'label' => __( 'توصیف', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

		$repeater->add_control(
			'video-image-tmb',
			[
				'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'video-image',
			[
				'label' => esc_html__( 'پوستر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'sep-1',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'video',
			[
				'label' => esc_html__( 'ویدئو', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => [ 'video'],
				'default' => [
					'url' => '',
				],
			]
		);

		$repeater->add_control(
			'icon1',
			[ 
				'label' => esc_html__( 'ایکون 1', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'icon2',
			[ 
				'label' => esc_html__( 'ایکون 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

        $this->add_control(
            'videos',
            [
                'label' => __( 'ویدئو ها', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
            ]
        );

        $this->end_controls_section();
	}

	protected function register_style_section_1() {
		$this->start_controls_section(
			'settings',
			[
				'label' => esc_html__( 'تنظیمات', BIO_PLUGIN_NAME ),
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

		$this->register_container_style('container',  ' .tab-btn');

		$this->add_control(
            'tab-container',
            [
                'label' => esc_html__( 'کانتیر تب ها', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->register_container_style( 'container-tab', '.tab-btn-inside' );


		$this->add_control(
            'title',
            [
                'label' => esc_html__( 'عنوان', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->register_text_style('video-gallery-avatar-name',  '.tab-btn .video-gallery-avatar-name');

		$this->add_control(
            'description',
            [
                'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

		$this->register_text_style('video-gallery-video-desc',  '.video-gallery-video-desc');

		$this->add_control(
            'image',
            [
                'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

		$this->register_image_style('video-gallery-avatar',  '.video-gallery-avatar');

		$this->add_control(
			'icon-1',
			[ 
				'label' => esc_html__( 'ایکون 1', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'icon-1', '.icon-1' );

		$this->add_control(
			'icon-2',
			[ 
				'label' => esc_html__( 'ایکون 2', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'icon-2', '.icon-2' );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'فعال', BIO_PLUGIN_NAME ),
			]
		);

		$this->register_container_style('container-active',  '.video-gallery .side-right .tab-btn.active');

		$this->add_control(
			'tab-container-active',
			[ 
				'label' => esc_html__( 'کانتیر تب فعال', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'container-tab-active', '.tab-btn.active .tab-btn-inside' );

		$this->add_control(
            'title-active',
            [
                'label' => esc_html__( 'عنوان', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

		$this->register_text_style('video-gallery-avatar-name-active',  '.tab-btn.active .video-gallery-avatar-name');

		$this->add_control(
            'description-active',
            [
                'label' => esc_html__( 'توصیف', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

		$this->register_text_style('video-gallery-video-desc-active',  'tab-btn.active .video-gallery-video-desc');

		$this->add_control(
            'image-active',
            [
                'label' => esc_html__( 'تصویر', BIO_PLUGIN_NAME ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

		$this->register_image_style('video-gallery-avatar-active',  'tab-btn.active .video-gallery-avatar');
		
		$this->add_control(
			'icon-1-active',
			[ 
				'label' => esc_html__( 'ایکون 1 active', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'icon-1-active', '.tab-btn.active .icon-1' );

		$this->add_control(
			'icon-2-active',
			[ 
				'label' => esc_html__( 'ایکون 2 active', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_text_style( 'icon-2-active', '.tab-btn.active .icon-2' );

		$this->end_controls_tab();

		$this->end_controls_tabs();     

        $this->end_controls_section();

	}

	protected function register_style_section_2() {
		$this->start_controls_section(
			'tabs_container',
			[ 
				'label' => esc_html__( 'کانتیر تب ها', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_container_style( 'tab-btn-container', '.tab-btn-container' );

		$this->add_control(
			'fade-top',
			[ 
				'label' => esc_html__( 'محو بالا', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'fade-top', '.fade-top' );

		$this->add_control(
			'fade-btm',
			[ 
				'label' => esc_html__( 'محو پایین', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_container_style( 'fade-btm', '.fade-btm' );


		$this->end_controls_section();
	}

    protected function register_controls() {
        
		$this->register_content_section_1();

		$this->register_style_section_1();
		$this->register_style_section_2();

		$this->register_style_video_controls();

        $this->register_video_controls();
    }

    protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="video-gallery video-gallery-tab-widget">';
		echo '<div class="video-gallery-container">';
		
		echo '<div class="side-left">';

		foreach ($settings['videos'] as $index => $item) {
			$tab_id = 'tab' . ($index + 1);
			echo '<div class="content"';
			echo ($index === 0) ? ' style="display: block;"' : 'style="display: none;"';
			echo ' id="' . $tab_id . '">';
			$video = $item['video']['url'];
			$poster = $item['video-image']['url'];

			$this->render_video($tab_id, $video, $poster);

			echo '</div>'; 
		}
		echo '</div>'; 

		echo '<div class="side-right">';
		echo '<div class="fade-top"></div>';
		echo '<div class="tab-btn-container tabs">';

		foreach ($settings['videos'] as $index => $item) {
			$tab_id = 'tab' . ($index + 1);
			echo '<div class="tab-btn';
			echo ($index === 0) ? ' active' : '';
			echo '" data-category="' . $tab_id . '" onclick="show_widgets.call(this, \'' . $tab_id . '\')">';
			echo '<div class="tab-btn-inside">';
			echo '<div class="video-gallery-avatar-container"><div>';
			echo '<img class="video-gallery-avatar" src="' . $item['video-image-tmb']['url'] . '" loading="lazy" alt="' . esc_attr($item['video-title']) . '">';
			echo '</div>';
			echo '<div class="text-content">';
			echo '<p class="video-gallery-avatar-name">' . esc_attr($item['video-title']) . '</p>';
			echo '<div class="d-flex">';
			echo '<div class="icon-1">';
			\Elementor\Icons_Manager::render_icon( $item['icon1'], [ 'aria-hidden' => 'true' ] );
			echo '</div>';
			echo '<p class="video-gallery-video-desc">' . esc_attr($item['video-desc']) . '</p>';
			echo '</div>';
			echo '</div>';
			echo '<div class="icon-2">';
			\Elementor\Icons_Manager::render_icon( $item['icon2'], [ 'aria-hidden' => 'true' ] );
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		echo '</div>';
		echo '<div class="fade-btm"></div>';
		echo '</div>';

		echo '</div>';
		echo '</div>';


	}
}