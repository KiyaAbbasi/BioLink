<?php

use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_tag_cloud extends \Elementor\Widget_Base {

    use basic_element_bio;

    public function get_name() {
        return 'bio_tag_cloud';
    }

    public function get_title() {
        return esc_html__('ابر تگ ها', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_tag_cloud';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }

    protected function register_content_section_1(){
        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__( 'چیدمان', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'          => esc_html__( 'ستون ها', BIO_PLUGIN_NAME ),
                'type'           => \Elementor\Controls_Manager::SELECT,
                'default'        => 'auto',
                'options'        => [
                    'auto' => 'خوکار',
                    '100%' => '1',
                    '50%' => '2',
                    '33.3333%' => '3',
                    '25%' => '4',
                    '20%' => '5',
                    '16.6666%' => '6',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .theme-tag-cloud-item-wrapper' => 'flex-basis: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap',
            [
                'label'     => esc_html__( 'فاصله ستون ها', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .theme-tag-cloud' => '--item-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_height',
            [
                'label'     => esc_html__( 'ارتفاع ایتم ها', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 30,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .theme-tag-cloud-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'چینش',
            [
                'label'     => esc_html__( 'چینش', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'چپ', BIO_PLUGIN_NAME ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'وسط', BIO_PLUGIN_NAME ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'راست', BIO_PLUGIN_NAME ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'space-between'  => [
                        'title' => esc_html__( 'justify', BIO_PLUGIN_NAME ),
                        'icon'  => 'eicon-text-align-justify',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .theme-tag-cloud' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label'     => esc_html__( 'نمایش تعداد', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before'
            ]
        );


        $this->end_controls_section();

    }

	function get_registered_taxonomy_options() {
		$options = [];

		$taxonomies = get_taxonomies( [], 'objects' );
		foreach ( $taxonomies as $taxonomy ) {
			$options[ $taxonomy->name ] = $taxonomy->label;
		}

		return $options;
	}

    protected function register_content_section_2(){
        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__( 'کوئری', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_control(
            'item_limit',
            [
                'label' => esc_html__( 'محدودیت ایتم', BIO_PLUGIN_NAME),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'taxonomy',
            [
                'label'   => esc_html__( 'طبقه بندی', BIO_PLUGIN_NAME ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'post_tag',
				'options' => $this->get_registered_taxonomy_options(),
            ]
        );

		$this->add_control(
			'icon',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'مرتب سازی بر اساس', BIO_PLUGIN_NAME ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'name',
                'options' => [
                    'name'       => esc_html__( 'نام', BIO_PLUGIN_NAME ),
                    'count'  => esc_html__( 'تعداد پست', BIO_PLUGIN_NAME),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'ترتیب', BIO_PLUGIN_NAME ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'asc',
                'options' => [
                    'asc'  => esc_html__( 'صعودی', BIO_PLUGIN_NAME ),
                    'desc' => esc_html__( 'نزولی', BIO_PLUGIN_NAME ),
                ],
            ]
        );

        $this->add_control(
            'include',
            [
                'label'       =>  esc_html__( 'شامل', BIO_PLUGIN_NAME ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' =>  esc_html__( 'ای دی ', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_control(
            'exclude',
            [
                'label'       =>  esc_html__( 'استثنا', BIO_PLUGIN_NAME ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' =>  esc_html__( 'ای دی ', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_control(
            'parent',
            [
                'label'       =>  esc_html__( 'والد', BIO_PLUGIN_NAME ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' =>  esc_html__( 'ای دی', BIO_PLUGIN_NAME ),
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_section_1() {
        $this->start_controls_section(
            'section_style_items',
            [
                'label' => esc_html__('ایتم ها', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_item_style' );

        $this->start_controls_tab(
            'tab_item_normal',
            [
                'label' => esc_html__( 'عادی', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_control(
            'single_background',
            [
                'label'   => esc_html__( 'پس زمینه تکی', BIO_PLUGIN_NAME ),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'item_background',
                'selector' => '{{WRAPPER}} .theme-tag-cloud-item',
                'exclude' => [ 'image' ],
                'condition' => [
                    'single_background' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'multiple_background',
            [
                'label'       => esc_html__( 'پس زمینه چند تایی', BIO_PLUGIN_NAME ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => '#000000, #f5f5f5, #999999',
                'condition' => [
                    'single_background' => ''
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .theme-tag-cloud-item',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__( 'انحنای حاشیه', BIO_PLUGIN_NAME ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .theme-tag-cloud-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'فاصله داخلی', BIO_PLUGIN_NAME ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .theme-tag-cloud-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'item_margin',
			[ 
				'label' => esc_html__( 'فاصله خارجی', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .theme-tag-cloud-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .theme-tag-cloud-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            [
                'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'itam_background_hover',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .theme-tag-cloud-item:hover',
            ]
        );

        $this->add_control(
            'item_border_color_hover',
            [
                'label'     => esc_html__( 'رنگ حاشیه', BIO_PLUGIN_NAME ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-tag-cloud-item:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'item_border_border!' => ''
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow_hover',
                'selector' => '{{WRAPPER}} .theme-tag-cloud-item:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function register_style_section_2() {
        $this->start_controls_section(
            'section_style_category_name',
            [
                'label' => esc_html__( 'نام', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->start_controls_tabs( 'tabs_item_name_style' );

		$this->start_controls_tab(
			'tab_item_text_normal',
			[ 
				'label' => esc_html__( 'عادی', BIO_PLUGIN_NAME ),
			]
		);

        $this->register_text_style('text', '.theme-tag-cloud-name', $align=false);

		$this->add_control(
			'icon_normal',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->register_text_style( 'btn_icon', '.theme-tag-cloud-item i', $align = false );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_item_text_hover',
			[ 
				'label' => esc_html__( 'هاور', BIO_PLUGIN_NAME ),
			]
		);

		$this->register_text_style( 'text-hover', '.theme-tag-cloud-item:hover .theme-tag-cloud-name', $align = false );

		$this->add_control(
			'icon_hover',
			[ 
				'label' => esc_html__( 'ایکون', BIO_PLUGIN_NAME ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->register_text_style( 'btn_icon_hover', '.theme-tag-cloud-item:hover i', $align = false );


		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();
    }

    protected function register_style_section_3() {
        $this->start_controls_section(
            'section_style_count',
            [
                'label' => esc_html__( 'تعداد', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->register_text_style('count', '.theme-tag-cloud-count', $align=false);

        $this->end_controls_section();
    }

    protected function register_controls() {

        $this->register_content_section_1();
		$this->register_content_section_2();

        $this->register_style_section_1();
        $this->register_style_section_2();
        $this->register_style_section_3();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

                
        $args = [
            'taxonomy'   => $settings["taxonomy"],
            'orderby'    => $settings["orderby"],
            'order'      => $settings["order"],
            'include'    => esc_attr($settings["include"]),
            'exclude'    => esc_attr($settings["exclude"]),
            'parent'     => $settings["parent"],
            'number'     => $settings["item_limit"]["size"],
        ];
        $categories = get_categories( $args );


        if (!empty($categories)) :

            ?>
            <div class="theme-tag-cloud">
                <?php
                if( !empty($settings['multiple_background']) ){

                    $multiple_bg = explode(',', rtrim($settings['multiple_background'], ','));
                    $total_category = count($categories);

                    // re-creating array for the multiple colors
                    $jCount= count($multiple_bg);
                    $j=0;
                    for ($i=0; $i < $total_category; $i++) {
                        if($j == $jCount) {
                            $j = 0;
                        }
                        $multiple_bg_create[$i]=$multiple_bg[$j];
                        $j++;
                    }
                }

                foreach ( $categories as $index => $cat ) :

                    $this->add_render_attribute('category-item', 'class', 'theme-tag-cloud-item term-id-' . $cat->term_id, true);
                    $this->add_render_attribute( 'category-item', 'href', get_category_link( $cat->term_id ), true );

                    if ($settings['single_background'] == '') {

                        if( !empty($settings['multiple_background']) ){
                            $bg_color =  $multiple_bg_create[$index];
                            if(!preg_match('/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $multiple_bg_create[$index])){
                                $bg_color = convert_hex($cat->name);
                            }
                        }
                        else {
                            $bg_color = convert_hex($cat->name);
                        }


                        $this->add_render_attribute('category-item', 'style', "background-color: var(--term-color, $bg_color)", true);
                    }

                    ?>

                <div class="theme-tag-cloud-item-wrapper">
                    <a <?php $this->print_render_attribute_string('category-item'); ?> >
                        <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <span class="theme-tag-cloud-name"><?php echo esc_html($cat->name); ?></span>

                        <?php if ( $settings['show_count'] == 'yes' ) : ?>
                            <span class="theme-tag-cloud-count"><?php echo esc_html($cat->count); ?></span>
                        <?php endif; ?>
                    </a>
                </div>
                    <?php

                endforeach;
                ?>
            </div>
        <?php
        else :

            echo '<p>'.esc_html__('Category Not Found!', BIO_PLUGIN_NAME).'</p>';

        endif;
    }

}