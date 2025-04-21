<?php
namespace handler;

if ( ! defined( 'ABSPATH' ) ) { exit; } 


trait video_bio {

    protected function render_video($plyr_id, $video, $poster) {
        $settings = $this->get_settings_for_display();

        $id = 'theme-video-' . $this->get_id();

        $video_settings = [
            "ratio" => !empty($settings["ratio"]["width"]) && !empty($settings["ratio"]["height"]) ? ($settings["ratio"]["width"] . ':' . $settings["ratio"]["height"]) : null,
        ];
        $controls = [];
        $available_controls = [
            "play-large",
            "play",
            "progress",
            "current-time",
            "mute",
            "volume",
            "pip",
            "download",
            "fullscreen"
        ];
        foreach ($available_controls as $control) {
            if ($settings[$control] == "yes") {
                $controls[] = $control;
            }
        }

        $video_settings['controls'] = $controls;
        ?>
        <style>
            .plyr__control.plyr__control--overlaid::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: <?php echo esc_attr($settings['plyr-play-image-size']['size']);?>px;
                height: <?php echo esc_attr($settings['plyr-play-image-size']['size']);?>px;
                background-image: url('<?php echo esc_attr($settings['plyr-play-image']['url']);?>');
                background-size: cover;
                pointer-events: none;
            }

            .plyr__control.plyr__control--overlaid{
                background: transparent;
            }

            .plyr__control.plyr__control--overlaid svg{
                display: none;
            }
        </style>
        <div id="<?php echo $id ?>" class="theme-video-wrapper" data-settings="<?php echo esc_attr( wp_json_encode( array_filter( $video_settings ) ) ); ?>" style="overflow: hidden;">
        <?php
        echo '<video style="';
        echo ' --plyr-color-main : '                            . esc_attr($settings['plyr-color-main']) . ';';
        echo ' --plyr-video-background : '                      . esc_attr($settings['plyr-video-background']). ';';
        echo ' --plyr-focus-visible-color : '                   . esc_attr($settings['plyr-focus-visible-color']). ';';
        echo ' --plyr-badge-background : '                      . esc_attr($settings['plyr-badge-background']). ';';
        echo ' --plyr-badge-text-color : '                      . esc_attr($settings['plyr-badge-text-color']). ';';
        echo ' --plyr-badge-border-radius : '                   . esc_attr($settings['plyr-badge-border-radius']['size']). 'px;';
        echo ' --plyr-control-icon-size : '                     . esc_attr($settings['plyr-control-icon-size']['size']). 'px;';
        echo ' --plyr-control-spacing : '                       . esc_attr($settings['plyr-control-spacing']['size']). 'px;';
        echo ' --plyr-control-padding : '                       . esc_attr($settings['plyr-control-padding']['size']). 'px;';
        echo ' --plyr-control-radius : '                        . esc_attr($settings['plyr-control-radius']['size']). 'px;';
        echo ' --plyr-video-controls-background : '             . esc_attr($settings['plyr-video-controls-background']). ';';
        echo ' --plyr-video-control-color : '                   . esc_attr($settings['plyr-video-control-color']). ';';
        echo ' --plyr-video-control-color-hover : '             . esc_attr($settings['plyr-video-control-color-hover']). ';';
        echo ' --plyr-progress-loading-size : '                 . esc_attr($settings['plyr-progress-loading-size']['size']). 'px;';
        echo ' --plyr-progress-loading-background : '           . esc_attr($settings['plyr-progress-loading-background']). ';';
        echo ' --plyr-video-progress-buffered-background : '    . esc_attr($settings['plyr-video-progress-buffered-background']). ';';
        echo ' --plyr-range-thumb-height : '                    . esc_attr($settings['plyr-range-thumb-height']['size']). 'px;';
        echo ' --plyr-range-track-height : '                    . esc_attr($settings['plyr-range-track-height']['size']). 'px;';
        echo '" controls class="video plyr-'                    . $plyr_id . ' captioned="no" data-poster="' . esc_url($poster) . '">';
        echo '<source src="'                                    . esc_url($video) . '" type="video/mp4" />';
        echo '</video>';
        ?>
        </div>
        <script>
            jQuery(document).ready(function($) {
                var video_wrapper = $('.theme-video-wrapper');
                video_wrapper.each(function() {
                    var Settings = $(this).data('settings');
                    var Container = $(this).find('<?php echo '.plyr-' . $plyr_id; ?>')[0];
                    const player = new Plyr(Container, Settings);
                });
            });
        </script>
    <?php
    }

    protected function register_video_controls() {

		$this->start_controls_section(
			'section_video_settings', [ 
				'label' => esc_html__( 'تنظیمات ویدیو', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'play-large',
			[ 
				'label' => esc_html__( 'پخش بزرگ', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'play',
			[ 
				'label' => esc_html__( 'پخش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'progress',
			[ 
				'label' => esc_html__( 'پیشرفت', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'current-time',
			[ 
				'label' => esc_html__( 'زمان جاری', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'mute',
			[ 
				'label' => esc_html__( 'بی‌صدا', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'volume',
			[ 
				'label' => esc_html__( 'صدا', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pip',
			[ 
				'label' => esc_html__( 'حالت تصویر در تصویر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'download',
			[ 
				'label' => esc_html__( 'دانلود', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'fullscreen',
			[ 
				'label' => esc_html__( 'تمام صفحه', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'ratio',
			[ 
				'label' => esc_html__( 'نسبت', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'default' => [ 
					'width' => '',
					'height' => '',
				],
			]
		);

		$this->add_control(
			'plyr-play-image',
			[ 
				'label' => esc_html__( 'تصویر پخش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [ 
					'active' => true,
				]
			]
		);

		$this->add_control(
			'plyr-play-image-size',
			[ 
				'label' => esc_html__( 'اندازه تصویر پخش', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 0.1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 100,
				],
			]
		);


		$this->add_responsive_control(
            'container_border_radius_',
		    [
			    'label' => esc_html__('انحنای حاشیه', BIO_PLUGIN_NAME),
			    'type' => \Elementor\Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .plyr' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
        );

        $this->end_controls_section();
    }

    protected function register_style_video_controls() {

		$this->start_controls_section(
			'vido_style',
			[ 
				'label' => esc_html__( 'سبک ویدیو', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'apply_style_video_controls',
			[ 
				'label' => esc_html__( 'فعال یا غیرفعال کردن اعمال سبک در ویرایشگر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'plyr-color-main',
			[ 
				'label' => esc_html__( 'رنگ اصلی پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-video-background',
			[ 
				'label' => esc_html__( 'پس زمینه ویدیو پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-focus-visible-color',
			[ 
				'label' => esc_html__( 'رنگ تمرکز قابل مشاهده پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-badge-background',
			[ 
				'label' => esc_html__( 'پس زمینه نشانگر پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,

			]
		);

		$this->add_control(
			'plyr-badge-text-color',
			[ 
				'label' => esc_html__( 'رنگ متن نشانگر پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-badge-border-radius',
			[ 
				'label' => esc_html__( 'شعاع مرز نشانگر پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 0.1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
			]
		);

		$this->add_control(
			'plyr-control-icon-size',
			[ 
				'label' => esc_html__( 'اندازه آیکون کنترل پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 0.1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 15,
				],
			]
		);

		$this->add_control(
			'plyr-control-spacing',
			[ 
				'label' => esc_html__( 'فاصله کنترل‌های پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 0.1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
			]
		);

		$this->add_control(
			'plyr-control-padding',
			[ 
				'label' => esc_html__( 'پدینگ کنترل‌های پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 0.1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
			]
		);

		$this->add_control(
			'plyr-control-radius',
			[ 
				'label' => esc_html__( 'شعاع کنترل‌های پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 0.1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
			]
		);

		$this->add_control(
			'plyr-video-controls-background',
			[ 
				'label' => esc_html__( 'پس زمینه کنترل‌های ویدیو پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-video-control-color',
			[ 
				'label' => esc_html__( 'رنگ کنترل‌های ویدیو پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-video-control-color-hover',
			[ 
				'label' => esc_html__( 'رنگ کنترل‌های ویدیو پلیر هنگام هاور', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-progress-loading-size',
			[ 
				'label' => esc_html__( 'اندازه بارگذاری پیشرفت پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
			]
		);

		$this->add_control(
			'plyr-progress-loading-background',
			[ 
				'label' => esc_html__( 'پس زمینه بارگذاری پیشرفت پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-video-progress-buffered-background',
			[ 
				'label' => esc_html__( 'پس زمینه بافر پیشرفت ویدیو پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-range-thumb-height',
			[ 
				'label' => esc_html__( 'ارتفاع دسته‌گیره محدوده پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
			]
		);

		$this->add_control(
			'plyr-range-thumb-background',
			[ 
				'label' => esc_html__( 'پس زمینه دسته‌گیره محدوده پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'plyr-range-track-height',
			[ 
				'label' => esc_html__( 'ارتفاع ریل محدوده پلیر', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
			]
		);


		$this->end_controls_section();
    }
}