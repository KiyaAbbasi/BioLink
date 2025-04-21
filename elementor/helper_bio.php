<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class elementor_helper_bio {

    public static $_instance;
    private  $widget_switches = array();

    public static function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct(){

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            return false;
        }

        add_action('wp_ajax_theme_select2_search_query', [$this, 'theme_select2_search_query']);
        add_action('wp_ajax_nopriv_theme_select2_search_query', [$this, 'theme_select2_search_query']);

        add_action('wp_ajax_theme_select2_get_title', [$this, 'theme_select2_get_title']);
        add_action('wp_ajax_nopriv_theme_select2_get_title', [$this, 'theme_select2_get_title']);
		
        add_action( 'wp_enqueue_scripts', [ $this, 'elementor_assets' ] );        
        add_action( 'elementor/editor/before_enqueue_styles',  [ $this, 'elementor_icons'] );

        add_filter( 'elementor/fonts/groups', array( $this, 'elementor_group' ) );
        add_filter( 'elementor/fonts/additional_fonts', array( $this, 'add_elementor_fonts' ) );
		add_action( 'init', array( $this, 'get_widget_custom_style' ) );
	}

    public function elementor_icons() {
        wp_enqueue_style( 'iconsax2_bio_plugin', BIO_PLUGIN_URL . '/elementor/assets/css/admin/iconsax.css', array(), false );
        wp_enqueue_style( 'persian_bio_plugin', BIO_PLUGIN_URL . '/elementor/assets/css/admin/persian.css', array(), false );
        wp_enqueue_style( 'custom_icon_elementor_bio_plugin', BIO_PLUGIN_URL . '/elementor/assets/css/admin/custom-icon_bio_plugin.css', array(), false );
    }

	function get_widget_custom_style() {
		$css_dir = BIO_PLUGIN_DIR . '/elementor/assets/css';

		// Unlink main.css if it exists
		$main_css_file = $css_dir . '/main-bio-widget.css';
		if ( file_exists( $main_css_file ) ) {
			unlink( $main_css_file );
		}

		// Create new main.css file
		$main_css_content = '';

		// Get all CSS files in the directory
		$css_files = glob( $css_dir . '/*.css' );
		if ( $css_files ) {
            foreach ( $css_files as $css_file ) {
                $filename = basename( $css_file );
                $current_locale = get_locale();
                if ($current_locale === 'fa_IR' && strpos( $filename, 'rtl' ) !== false) {
                    if( 1 ) {
                        $main_css_content .= "@import url('$filename');\n";
                    }
                    else {
                        // Merge CSS content directly into $main_css_content
                        $file_content = file_get_contents( $css_file );
                        $main_css_content .= $file_content . "\n";
                    }
                }
                elseif( strpos( $filename, 'rtl' ) === false ) {
                    if( get_option( 'load_css_bio_link' ) == false ) {
                        $main_css_content .= "@import url('$filename');\n";
                    }
                    else {
                        // Merge CSS content directly into $main_css_content
                        $file_content = file_get_contents( $css_file );
                        $main_css_content .= $file_content . "\n";
                    }
                } 
            }
			// Write the collected CSS content to main.css
			file_put_contents( $main_css_file, $main_css_content );
		}
	}

	function minify_css( $css ) {
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		$css = str_replace( array( "\r\n", "\r", "\n", "\t"), '', $css );
		return $css;
	}
    
	public function elementor_group( $font_groups ) {
        $new_group[ 'theme-custom-fonts' ] = __( 'افزونه بایو لینک', BIO_PLUGIN_NAME );
        $font_groups = $new_group + $font_groups;

        return $font_groups;
    }

	public function add_elementor_fonts( $fonts ) {
		// Path to the custom fonts directory
		$custom_fonts_dir = BIO_PLUGIN_DIR . '/elementor/assets/fonts/webfonts/';

		// Get all directories inside the custom fonts directory
		$font_dirs = glob( $custom_fonts_dir . '*', GLOB_ONLYDIR );

		$selected_fonts = get_option( 'bio_link_selected_fonts', [] );
		// Array to keep track of added fonts
		$added_fonts = [];

		// Iterate through each font directory
		foreach ( $font_dirs as $font_dir ) {
			// Get the font name from the directory name
			$font_name = basename( $font_dir );

			// Skip if the font name is already added
			if ( in_array( $font_name, $added_fonts ) ) {
				continue;
			}

			if ( ! in_array( $font_name, $selected_fonts ) ) {
				continue;
			}

            // Add the font name to the added fonts array
			$added_fonts[] = $font_name;

			// Add the font to the fonts array with the base font name
			$fonts[ $font_name ] = 'theme-custom-fonts';
		}

		return $fonts;
	}


	public function add_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'bio-elementor-elements',
            [
                'title' => __('بایو لینک', BIO_PLUGIN_NAME),
                'icon' => 'fa fa-plug',
            ]
        );
    }
    
    public function register_controls(){
        $controls_manager = \Elementor\Plugin::$instance->controls_manager;
    }

    public function register_widgets( $widgets_manager ) {
        $this->widget_switches = array();
        $widgets = glob(__DIR__ . '/widgets/*.php');
		$selected_widgets = get_option( 'bio_link_selected_widgets', [] );
		foreach ( $widgets as $widget ) {
			require_once $widget;
			$class_name = basename( $widget, '.php' );

			if ( in_array( $class_name, $selected_widgets ) ) {
				$widget_instance = new $class_name();
				$widgets_manager->register( $widget_instance );
			}
		}
        return $this->widget_switches;

    }

    public function elementor_assets() {
        wp_enqueue_style( 'bio-elementor-style', BIO_PLUGIN_URL . '/elementor/assets/css/main-bio-widget.css', array(), false );
        wp_enqueue_script( 'show_widgets_bio', BIO_PLUGIN_URL . '/elementor/assets/js/show_widgets.js', null, null );
		wp_enqueue_script( 'main_bio', BIO_PLUGIN_URL . '/elementor/assets/js/main_bio.js', array( 'jquery' ), false, true );
    }

    /*
     * $posts_source = post type
     * $source_type = post, taxonomy, author
     * */
    public function theme_select2_search_query() {
        $posts_source = 'post';
        $source_type = 'post';

        if ( !empty( $_GET[ 'source_type' ] ) ) {
            $source_type = sanitize_text_field( $_GET[ 'source_type' ] );
        }

        if ( !empty( $_GET[ 'posts_source' ] ) ) {
            $posts_source = sanitize_text_field( $_GET[ 'posts_source' ] );
        }

        $search = !empty( $_GET[ 'term' ] ) ? sanitize_text_field( $_GET[ 'term' ] ) : '';
        $results = $query_result = [];

        if($source_type == 'post') {
            $args = [
                'post_type' => $posts_source,
                'numberposts' => '5',
                's'           => $search,
                'orderby'     => 'title',
                'order'     => 'ASC',
            ];
            $query_result = wp_list_pluck(get_posts($args), 'post_title', 'ID');
        }
        elseif($source_type == 'taxonomy') {
            $taxonomies = get_object_taxonomies( $posts_source );

            if($taxonomies) {
                $args = [
                    'hide_empty' => false,
                    'taxonomy' => $taxonomies,
                    'number'     => '5',
                    'search'     => $search,
                    'fields'     => 'all',
                ];

                $terms_result = get_terms($args);
                foreach ($terms_result as $term_item) {
                    $query_result[$term_item->term_id] = $term_item->taxonomy . ': ' . $term_item->name;
                }
            }

        }
        elseif($source_type == 'author') {
            $search = $search? '*' . $search . '*' : '';
            $args = [
                'fields'  => [ 'ID', 'display_name' ],
                'orderby' => 'display_name',
                'has_published_posts' => true,
                'number'     => '5',
                'search'     => $search,
            ];
            $query_result = wp_list_pluck(get_users($args), 'display_name', 'ID');
        }


        if ( !empty( $query_result ) ) {
            foreach ( $query_result as $key => $item ) {
                $results[] = [ 'text' => $item, 'id' => $key ];
            }
        }

        wp_send_json( [ 'results' => $results ] );
        wp_die();
    }


    public function theme_select2_get_title() {

        if ( empty( $_POST[ 'id' ] ) ) {
            wp_send_json_error( [] );
        }

        if ( empty( array_filter($_POST[ 'id' ]) ) ) {
            wp_send_json_error( [] );
        }
        $ids = array_map('intval',$_POST[ 'id' ]);

        $source_type = 'post';

        if ( !empty( $_POST[ 'source_type' ] ) ) {
            $source_type = sanitize_text_field( $_POST[ 'source_type' ] );
        }

        $results = $query_result = [];

        if($source_type == 'post') {
            $args = [
                'post_type' => 'any',
                'numberposts' => '-1',
                'orderby'     => 'title',
                'order'     => 'ASC',
                'include'    => $ids,
            ];
            $query_result = wp_list_pluck(get_posts($args), 'post_title', 'ID');
        }
        elseif($source_type == 'taxonomy') {
            $args = [
                'hide_empty' => false,
                'include'    => $ids,
                'fields'     => 'all',
            ];

            $terms_result = get_terms($args);
            foreach ($terms_result as $term_item) {
                $query_result[$term_item->term_id] = $term_item->taxonomy . ': ' . $term_item->name;
            }
        }
        elseif($source_type == 'author') {
            $args = [
                'fields'  => [ 'ID', 'display_name' ],
                'include'    => $ids,
            ];
            $query_result = wp_list_pluck(get_users($args), 'display_name', 'ID');
        }


        $results = $query_result;

        if ( !empty( $results ) ) {
            wp_send_json_success( [ 'results' => $results ] );
        } else {
            wp_send_json_error( [] );
        }
        wp_die();

    }
    
}

elementor_helper_bio::get_instance();