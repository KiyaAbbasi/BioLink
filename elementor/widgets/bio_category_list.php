<?php

use handler\basic_element_bio;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class bio_category_list extends \Elementor\Widget_Base {

    use basic_element_bio;

    public function get_name() {
        return 'bio_category_list';
    }

    public function get_title() {
        return esc_html__('لیست دسته بندی', BIO_PLUGIN_NAME);
    }

    public function get_icon() {
        return 'bio_category_list';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['bio-elementor-elements'];
    }


	function get_registered_taxonomy_options() {
		$options = [];

		$taxonomies = get_taxonomies( [], 'objects' );
		foreach ( $taxonomies as $taxonomy ) {
			$options[ $taxonomy->name ] = $taxonomy->label;
		}

		return $options;
	}

    protected function register_content_section_1(){
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
            'section_style_body',
            [
                'label' =>  esc_html__( 'بدنه', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->register_container_style( 'body', '.category-list-first', $align = false );

        $this->end_controls_section();

    }

    protected function register_style_section_2() {
        $this->start_controls_section(
            'section_style_category_body_item',
            [
                'label' =>  esc_html__( 'ایتم های بدنه', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->register_text_style( 'category-item', '.category-list-first', $align = false );

		$this->end_controls_section();
    }

    protected function register_style_section_3() {
        $this->start_controls_section(
            'section_style_child_body',
            [
                'label' => esc_html__( 'فرزندان بدنه', BIO_PLUGIN_NAME ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->register_container_style('child-category-list', '.child-category-list', $align=false);

        $this->end_controls_section();
    }

	protected function register_style_section_4() {
		$this->start_controls_section(
			'section_style_child_body_item',
			[ 
				'label' => esc_html__( 'بدنه فرزندان', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'child-category-list', '.child-category-list li', $align = false );

		$this->end_controls_section();
	}

	protected function register_style_section_5() {
		$this->start_controls_section(
			'section_style_category_item_icon',
			[ 
				'label' => esc_html__( 'ایکون ایتم ها', BIO_PLUGIN_NAME ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'category-icon', '.category-link::after', $align = false );

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
		$settings = $this->get_settings_for_display();

		$args = [ 
			'taxonomy' => $settings["taxonomy"],
			'orderby' => $settings["orderby"],
			'order' => $settings["order"],
			'include' => esc_attr( $settings["include"] ),
			'exclude' => esc_attr( $settings["exclude"] ),
			'parent' => $settings["parent"],
			'number' => $settings["item_limit"]["size"],
		];
		$categories = get_categories( $args );

		if ( ! empty( $categories ) ) {
			echo '<ul class="category-list-first">';
			foreach ( $categories as $category ) {
				$child_args = [ 
					'taxonomy' => $settings["taxonomy"],
					'orderby' => $settings["orderby"],
					'order' => $settings["order"],
					'parent' => $category->term_id,
					'number' => $settings["item_limit"]["size"],
				];
				$child_categories = get_categories( $child_args );

				if ( ! empty( $child_categories ) ) {
					echo '<li class="category-item">';
					echo '<a href="#" class="category-link" data-category-id="' . esc_attr( $category->term_id ) . '">' . esc_html( $category->name ) . '</a>';
					echo '<ul class="child-category-list" id="child-category-' . esc_attr( $category->term_id ) . '">';
					foreach ( $child_categories as $child_category ) {
						echo '<li class="child-category-item">';
						echo '<a href="' . esc_url( get_category_link( $child_category->term_id ) ) . '">' . esc_html( $child_category->name ) . '</a>';
						echo '</li>';
					}
					echo '</ul>';
					echo '</li>';
				} else {
					echo '<li class="category-item">';
					echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
					echo '</li>';
				}
			}
			echo '</ul>';
		}
		?>
        <script>
            jQuery( document ).ready( function ( $ )
            {
                $( '.category-link' ).on( 'click', function ( e )
                {
                    e.preventDefault();
                    var categoryId = $( this ).data( 'category-id' );
                    var $childCategoryList = $( '#child-category-' + categoryId );
                    $childCategoryList.toggleClass( 'open' );
                    $( this ).toggleClass( 'open' ); // Toggle the 'open' class
                } );
            } );
        </script>

        <?php
	}


}