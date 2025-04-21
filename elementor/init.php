<?php

use sellect_control\Ajax_Select2;

// if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
// var_dump( 'sdfsfsfsf' );

// if ( ! did_action( 'elementor/loaded' ) ) {
//     return false;
// }

// // Traits
require_once BIO_PLUGIN_DIR . '/elementor/traits/basic_element_bio.php';
require_once BIO_PLUGIN_DIR . '/elementor/traits/swiper_bio.php';
require_once BIO_PLUGIN_DIR . '/elementor/traits/video_bio.php';
require_once BIO_PLUGIN_DIR . '/elementor/helper_bio.php';
require_once BIO_PLUGIN_DIR . '/elementor/icons/iconsax_bio.php';
require_once BIO_PLUGIN_DIR . '/elementor/icons/persian_bio.php';


// Create an instance of the elementor_helper_bio class
$helper_instance = elementor_helper_bio::get_instance();

add_action('elementor/elements/categories_registered', [$helper_instance, 'add_elementor_widget_categories']);
add_action('elementor/controls/register', [$helper_instance, 'register_controls']);
add_action('elementor/widgets/register', [$helper_instance, 'register_widgets'], 1); 

