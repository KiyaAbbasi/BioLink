<?php
/*
Plugin Name: بایو لینک
Plugin URI: https://bio-plugin.armanhub.ir/
Description: افزونه بایو لینک آسان ترین راه برای خلق یک لینک بایو حرفه ای و جذاب برای شبکه های اجتمائی شما
Version: 2.0.0
Author: علی آرمان
Domain Path: /languages
Text Domain: arman_hub
Author URI: https://armanhub.ir/
*/
global $license_bio;
$license_bio = 'active';
define( 'BIO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'BIO_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'BIO_PLUGIN_NAME', 'arman_hub' );

class PageTemplater {

	private static $instance;

	protected $templates;

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new PageTemplater();
		}

		return self::$instance;

	}

	private function __construct() {

		$this->templates = array();

		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
			add_filter( 'page_attributes_dropdown_pages_args', array( $this, 'register_project_templates' ) );

		} else {
			add_filter( 'theme_page_templates', array( $this, 'add_new_template' ) );

		}

		add_filter( 'wp_insert_post_data', array( $this, 'register_project_templates' ) );

		add_filter( 'template_include', array( $this, 'view_project_template' ) );

		$this->templates = array( 'bio-template.php' => __( 'بایو لینک', BIO_PLUGIN_NAME ), );

	}

	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	public function register_project_templates( $atts ) {
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		wp_cache_delete( $cache_key, 'themes' );
		$templates = array_merge( $templates, $this->templates );
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;
	}

	public function view_project_template( $template ) {
		if ( is_search() ) {
			return $template;
		}

		global $post;

		if ( ! $post ) {
			return $template;
		}

		if ( ! isset( $this->templates[ get_post_meta(
			$post->ID, '_wp_page_template', true
		) ] ) ) {
			return $template;
		}

		$filepath = apply_filters( 'page_templater_plugin_dir_path', plugin_dir_path( __FILE__ ) );

		$file = $filepath . get_post_meta(
			$post->ID, '_wp_page_template', true
		);

		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}
		return $template;
	}
}

add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

include_once ( dirname( __FILE__ ) . '/inc/function.php' );
function apply_default_template_for_user_bio_page( $template ) {
	if ( is_singular( 'user_bio_page' ) ) {
		$default_template = 'bio-template.php';
		$post_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

		if ( empty( $post_template ) || $post_template !== $default_template ) {
			$template = plugin_dir_path( __FILE__ ) . $default_template;
		}
	}
	return $template;
}
add_filter( 'template_include', 'apply_default_template_for_user_bio_page' );

function get_widget_settings_bio( $settings ) {
	$widget_settings = [];
	foreach ( $settings as $control_key => $control_value ) {
		if ( is_array( $control_value ) && isset( $control_value['items'] ) ) {
			$repeater_settings = [];
			foreach ( $control_value['items'] as $item ) {
				$repeater_item = [];
				foreach ( $item as $key => $value ) {
					$repeater_item[ $key ] = $value;
				}
				$repeater_settings[] = $repeater_item;
			}
			$widget_settings[ $control_key ] = $repeater_settings;
		} else {
			$widget_settings[ $control_key ] = $control_value;
		}
	}
	return $widget_settings;
}

add_action( 'admin_menu', 'bio_link_menu' );
function bio_link_menu() {
	$plugin_url = plugin_dir_url( __FILE__ );
	$image_path = $plugin_url . '/assets/images/tmb.png';
	add_menu_page(
		__( 'بایو لینک', BIO_PLUGIN_NAME ),
		__( 'بایو لینک', BIO_PLUGIN_NAME ),
		'manage_options',
		'bio-link',
		'bio_link_page',
		$image_path,
		20
	);

	add_submenu_page(
		'bio-link',
		__( 'ایجاد فایل vcf', BIO_PLUGIN_NAME ),
		__( 'ایجاد فایل vcf', BIO_PLUGIN_NAME ),
		'manage_options',
		'vcf-generator',
		'vcf_generator_fun'
	);

	add_submenu_page(
		'bio-link',
		__( 'درون ریز دمو', BIO_PLUGIN_NAME ),
		__( 'درون ریز دمو', BIO_PLUGIN_NAME ),
		'manage_options',
		'bio-link-importer',
		'bio_link_importer_admin_page',
		'dashicons-download',
	);

	add_submenu_page(
		'bio-link',
		__( 'فونت و ویجت ها', BIO_PLUGIN_NAME ),
		__( 'فونت و ویجت ها', BIO_PLUGIN_NAME ),
		'manage_options',
		'bio-link-fonts',
		'bio_link_settings_page',
	);

	add_submenu_page(
		'bio-link',
		__( 'محصولات ما', BIO_PLUGIN_NAME ),
		__( 'محصولات ما', BIO_PLUGIN_NAME ),
		'manage_options',
		'bio_our_products',
		'bio_our_products_page',
	);
}


function bio_link_importer_handle_import() {
	if ( isset( $_POST['bio_link_import_file'] ) ) {
		$file = sanitize_text_field( $_POST['bio_link_import_file'] );

		if ( file_exists( $file ) ) {
			$xml = simplexml_load_file( $file );
			if ( $xml ) {
				foreach ( $xml->channel->item as $item ) {
					$post_content = html_entity_decode( (string) $item->children( 'content', true )->encoded, ENT_QUOTES, 'UTF-8' );
					$post_data = array(
						'post_title' => (string) $item->title,
						'post_content' => $post_content,
						'post_status' => 'publish',
						'post_author' => 1,
						'post_type' => 'page',
					);

					$post_id = wp_insert_post( $post_data );

					if ( $post_id ) {
						foreach ( $item->children( 'wp', true )->postmeta as $meta ) {
							$meta_key = sanitize_text_field( (string) $meta->meta_key );
							$meta_value = maybe_unserialize( html_entity_decode( (string) $meta->meta_value ) );

							if ( $meta_key === '_elementor_data' ) {

								$decoded_value = json_decode( $meta_value, true );
								if ( $decoded_value ) {
									$meta_value = json_encode( $decoded_value, JSON_UNESCAPED_UNICODE );
								}
							}

							update_post_meta( $post_id, $meta_key, $meta_value );
						}
					}
				}
			}

			// Redirect to avoid form resubmission
			wp_redirect( admin_url( 'admin.php?page=bio-link-importer&imported=true&post_id=' . $post_id ) );

			exit;
		}
	}
}

add_action( 'admin_init', 'bio_link_importer_handle_import' );
function add_vcf_mime_type( $mimes ) {
	$mimes['vcf'] = 'text/vcard';
	return $mimes;
}
add_filter( 'upload_mimes', 'add_vcf_mime_type' );

function bio_link_include_elementor_init() {
	include_once ( BIO_PLUGIN_DIR . '/elementor/init.php' );
}
add_action( 'elementor/init', 'bio_link_include_elementor_init' );

require_once BIO_PLUGIN_DIR . '/inc/ajax-search/ajax-search.php';

function update_bio_fonts( $selected_fonts = null ) {

	$css_file = BIO_PLUGIN_DIR . '/elementor/assets/css/custom-fonts-style.css';
	$css_content = '';
	if ( $selected_fonts == [] ) {
		$selected_fonts = get_option( 'bio_link_selected_fonts', [] );
	}
	foreach ( $selected_fonts as $font ) {
		$css_content .= "@import url('" . BIO_PLUGIN_URL . "elementor/assets/fonts/webfonts/{$font}/{$font}.css');\n";
	}

	file_put_contents( $css_file, $css_content );
	update_option( 'bio_link_selected_fonts', $selected_fonts );

	$css_file = BIO_PLUGIN_DIR . '/assets/css/theme-font.css';
	$font_dir = BIO_PLUGIN_DIR . '/elementor/assets/fonts/webfonts';
	$font_dirs = array_filter( glob( $font_dir . '/*' ), 'is_dir' );

	$css_content = '';

	foreach ( $font_dirs as $dir ) {
		$font_name = basename( $dir );
		$css_content .= "@import url('" . BIO_PLUGIN_URL . "elementor/assets/fonts/webfonts/{$font_name}/{$font_name}.css');\n";
	}

	file_put_contents( $css_file, $css_content );
}

register_activation_hook( __FILE__, 'update_bio_fonts' );

register_activation_hook( __FILE__, 'bio_link_activate_plugin' );

function bio_link_page() {
	include_once ( 'inc/help.php' );
}

function vcf_generator_fun() {
	include_once ( 'inc/vcf_generator_fun.php' );
}

function bio_link_importer_admin_page() {
	include_once ( 'inc/demos.php' );
}

function bio_link_settings_page() {
	include_once ( 'inc/settings.php' );
}

function bio_our_products_page() {
	include_once ( 'inc/bio_our_products_page.php' );
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'add_custom_plugin_action_links' );

add_filter( 'plugin_row_meta', 'add_custom_plugin_meta', 10, 2 );

function add_custom_plugin_meta( $links, $file ) {
	// Check if it's your plugin
	if ( plugin_basename( __FILE__ ) === $file ) {
		// Add your custom text/link
		$admin_url = admin_url();
		$custom_link = '<span class="help"><a class="plugin-setting-link-bio" href="' . $admin_url . 'admin.php?page=bio-link">' . __( 'راهنمایی', BIO_PLUGIN_NAME ) . '</a></span> | ';

		$current_user = wp_get_current_user();
		$display_name = $current_user->display_name;
		global $license_bio;
		if ( $license_bio != 'active' ) {
			$custom_link .= '<span class="license-not-added">' . $display_name . __( ' لایسنس شما فعال نمی باشد.', BIO_PLUGIN_NAME ) . '</span>';
		} else {
			$custom_link .= '<span class="license-added">' . $display_name . __( ' از اینکه افزونه بایو لینک را خریداری کرده اید از شما متشکریم', BIO_PLUGIN_NAME ) . '</span>';
		}
		$links[] = $custom_link;
	}
	return $links;
}

function create_user_bio_page_cpt() {
    $labels = array(
        'name'                  => _x( 'بایو لینک کاربران', 'textdomain' ),
        'singular_name'         => _x( 'بایو لینک کاربر',  'textdomain' ),
        'menu_name'             => __( 'بایو لینک کاربران', 'textdomain' ),
    );

    $args = array(
        'label'                 => __( 'User Bio Page', 'textdomain' ),
        'labels'                => $labels,
		'supports' => array( 'title', 'editor', 'author', 'elementor' ),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'has_archive'           => false,
        'rewrite'               => array('slug' => 'user-bio'),
        'show_in_rest'          => false,
		'author' => true,
    );

    register_post_type( 'user_bio_page', $args );
}
add_action( 'init', 'create_user_bio_page_cpt' );

function create_bio_page_for_new_user( $user_id ) {
    $user = get_userdata( $user_id );

	// بررسی اینکه آیا کاربر نقش 'custom_role' ندارد و سپس تغییر نقش
	if ( ! in_array( 'custom_role', (array) $user->roles ) ) {
		$user->set_role( 'custom_role' );
	}

    $bio_page = array(
        'post_title'    => $user->display_name . "بایو ",
        'post_status'   => 'publish',
        'post_type'     => 'user_bio_page',
        'post_author'   => $user_id,
    );

    // ایجاد صفحه یکتا
    $post_id = wp_insert_post( $bio_page );
}
add_action( 'user_register', 'create_bio_page_for_new_user' );

function add_custom_capabilities( $caps, $cap, $user_id, $args ) {
	if ( 'edit_post' === $cap || 'delete_post' === $cap || 'read_post' === $cap ) {
		$post = get_post( $args[0] );

		if ( $post && $post->post_type === 'user_bio_page' ) {
			// اطمینان از این که نقش مدیر دسترسی کامل دارد
			if ( user_can( $user_id, 'administrator' ) ) {
				return $caps;
			}

			// برای نقش "مشترک"، فقط امکان ویرایش و مشاهده پست‌های خود را فراهم کنید
			if ( user_can( $user_id, 'custom_role' ) ) {
				if ( $cap === 'edit_post' || $cap === 'delete_post' ) {
					if ( $post->post_author !== $user_id ) {
						return array(); // عدم دسترسی
					}
				}
			}
		}
	}
	return $caps;
}
add_filter( 'map_meta_cap', 'add_custom_capabilities', 10, 4 );

function allow_custom_roles_uploads() {
	$role = get_role( 'custom_role' );

	// Check if the role exists
	if ( $role && ! $role->has_cap( 'upload_files' ) ) {
		$role->add_cap( 'upload_files' );
	}
}
add_action( 'init', 'allow_custom_roles_uploads' );


function filter_user_uploaded_media( $query ) {
	if ( is_admin() && isset( $query['post_type'] ) && $query['post_type'] === 'attachment' ) {
		$current_user = wp_get_current_user();
		// فقط برای نقش مشترک
		if ( in_array( 'custom_role', $current_user->roles ) ) {
			// محدود کردن رسانه‌ها به کاربر جاری
			$query['author'] = $current_user->ID;
		}
	}
	return $query;
}
add_filter( 'ajax_query_attachments_args', 'filter_user_uploaded_media' );

function add_user_bio_caps_to_custom_role() {
	$role = get_role( 'custom_role' );

	if ( $role ) {
		$role->add_cap( 'edit_posts' );
		$role->add_cap( 'edit_user_bio_page' );
		$role->add_cap( 'read_user_bio_page' );
	}
}
add_action( 'init', 'add_user_bio_caps_to_custom_role' );

function add_bio_page_menu() {
	$user = wp_get_current_user();
	if ( in_array( 'custom_role', (array) $user->roles ) ) {
		add_menu_page(
			__( 'صفحه بایو', 'textdomain' ),
			__( 'صفحه بایو', 'textdomain' ),
			'edit_posts',
			'user_bio_page',
			'display_user_bio_page',
			'dashicons-admin-users',
			25
		);
	}
}
add_action( 'admin_menu', 'add_bio_page_menu' );

function display_user_bio_page() {
	$current_user = wp_get_current_user();
	$bio_page = get_posts( array(
		'post_type' => 'user_bio_page',
		'author' => $current_user->ID,
		'posts_per_page' => 1,
	) );

	echo '<h1>' . __( 'صفحه بایو شما', 'textdomain' ) . '</h1>';

	// لینک‌های صفحه بایو
	if ( ! empty( $bio_page ) ) {
		$bio_page_url = get_edit_post_link( $bio_page[0]->ID );
		$bio_page_view_url = get_permalink( $bio_page[0]->ID );
		echo '<a href="' . esc_url( $bio_page_view_url ) . '" class="button button-secondary" target="_blank">' . __( 'نمایش صفحه بایو', 'textdomain' ) . '</a>';
		echo ' ';
		echo '<a href="' . esc_url( $bio_page_url ) . '" class="button button-primary">' . __( 'ویرایش صفحه', 'textdomain' ) . '</a>';
		echo ' ';

		// نمایش iframe برای صفحه بایو
	} else {
		echo '<p>' . __( 'هیچ صفحه‌ای برای این کاربر وجود ندارد.', 'textdomain' ) . '</p>';
		echo ' ';
	}

	// لینک پروفایل کاربری ووکامرس (اگر فعال است)
	if ( class_exists( 'WooCommerce' ) ) {
		$my_account_url = wc_get_page_permalink( 'myaccount' );
		if ( $my_account_url ) {
			echo '<a href="' . esc_url( $my_account_url ) . '" class="button button-secondary" target="_blank">' . __( 'نمایش پروفایل کاربری', 'textdomain' ) . '</a>';
			echo ' ';
		}
	}

	// لینک مشاهده وب‌سایت
	$site_url = home_url();
	echo '<a href="' . esc_url( $site_url ) . '" class="button button-secondary" target="_blank">' . __( 'مشاهده وب‌سایت', 'textdomain' ) . '</a>';
	echo '<h2>' . __( 'نمایش صفحه بایو شما', 'textdomain' ) . '</h2>';

	echo '<iframe src="' . esc_url( $bio_page_view_url ) . '" style="width: 100%; height: 500px; border: 1px solid #ddd;"></iframe>';

}

function add_bio_page_to_woocommerce_dashboard() {
	$current_user = wp_get_current_user();
	$bio_page = get_posts( array(
		'post_type' => 'user_bio_page',
		'author' => $current_user->ID,
		'posts_per_page' => 1,
	) );

	if ( ! empty( $bio_page ) ) {
		$bio_page_url = get_edit_post_link( $bio_page[0]->ID );
		$bio_page_view_url = get_permalink( $bio_page[0]->ID );
		echo '<h2>' . __( 'صفحه بایو', 'textdomain' ) . '</h2>';
		echo '<a href="' . esc_url( $bio_page_view_url ) . '" class="button button-secondary" target="_blank">' . __( 'نمایش صفحه', 'textdomain' ) . '</a>';
		echo ' ';
		echo '<a href="' . esc_url( $bio_page_url ) . '" class="button">' . __( 'ویرایش با المنتور', 'textdomain' ) . '</a>';
	}
}
add_action( 'woocommerce_account_dashboard', 'add_bio_page_to_woocommerce_dashboard' );

function add_edit_bio_page_link_to_profile( $user ) {
	$bio_page = get_posts( array(
		'post_type' => 'user_bio_page',
		'author' => $user->ID,
		'posts_per_page' => 1,
	) );

	if ( ! empty( $bio_page ) ) {
		$bio_page_url = get_edit_post_link( $bio_page[0]->ID );
		$bio_page_view_url = get_permalink( $bio_page[0]->ID );
		echo '<h2>' . __( 'صفحه بایو', 'textdomain' ) . '</h2>';
		echo '<a href="' . esc_url( $bio_page_view_url ) . '" class="button button-secondary" target="_blank">' . __( 'نمایش صفحه', 'textdomain' ) . '</a>';
		echo ' ';
		echo '<a href="' . esc_url( $bio_page_url ) . '" class="button">' . __( 'ویرایش با المنتور', 'textdomain' ) . '</a>';
	}
}
add_action( 'show_user_profile', 'add_edit_bio_page_link_to_profile' );
add_action( 'edit_user_profile', 'add_edit_bio_page_link_to_profile' );

function add_elementor_support_for_user_bio_page() {
    if ( did_action( 'elementor/loaded' ) ) {
        add_post_type_support( 'user_bio_page', 'elementor' );
    }
}
add_action('init', 'add_elementor_support_for_user_bio_page');

function remove_menus_for_custom_role() {
    if( current_user_can('custom_role') ) {
        remove_menu_page('index.php');                  // نوشته‌ها
		remove_menu_page( 'edit.php' );                  // نوشته‌ها
        remove_menu_page('edit-comments.php');         // دیدگاه‌ها
        remove_menu_page('themes.php');                // قالب‌ها
        remove_menu_page('profile.php');                 // ابزارها
		remove_menu_page( 'tools.php' );                 // ابزارها
        remove_menu_page('edit.php?post_type=elementor_library'); // کتابخانه المنتور
    }
}
add_action('admin_menu', 'remove_menus_for_custom_role', 999);

function remove_collapse_menu_button_combined() {
	// تغییر از get_current_user() به wp_get_current_user()
	$user = wp_get_current_user();

	// اطمینان از اینکه متغیر roles وجود دارد و به درستی بررسی می‌شود
	if ( in_array( 'custom_role', (array) $user->roles ) ) {
		echo '<style>#collapse-menu,#wpadminbar,#adminmenumain,#show-settings-link,#visibility,.misc-pub-section.misc-pub-revisions,#delete-action,#minor-publishing-actions,.misc-pub-section.misc-pub-post-status,#revisionsdiv,body.index-php { display: none !important; }</style>';
		echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var collapseButton = document.getElementById("collapse-menu");
            var wpadminbar = document.getElementById("wpadminbar");
            var adminmenumain = document.getElementById("adminmenumain");
            var show_settings_link = document.getElementById("show-settings-link");
            if (collapseButton) {
                collapseButton.remove();
            }
            if (wpadminbar) {
                wpadminbar.remove();
            }
            if (adminmenumain) {
                adminmenumain.remove();
            }
            if (show_settings_link) {
                show_settings_link.remove();
            }
        });
    	</script>';
	}
}
add_action( 'admin_head', 'remove_collapse_menu_button_combined' );

function redirect_custom_role_users_after_login( $redirect_to, $request, $user ) {
	// بررسی نقش کاربر
	if ( in_array( 'custom_role', (array) $user->roles ) ) {
		return admin_url( 'admin.php?page=user_bio_page' );
	}

	return $redirect_to;
}
add_filter( 'login_redirect', 'redirect_custom_role_users_after_login', 10, 3 );

function remove_admin_bar_items_for_custom_role($wp_admin_bar) {
    if( current_user_can('custom_role') ) {
        $wp_admin_bar->remove_node('new-post');  // افزودن نوشته جدید
        $wp_admin_bar->remove_node('comments');  // دیدگاه‌ها
        $wp_admin_bar->remove_node('customize'); // سفارشی‌سازی قالب
    }
}
add_action('admin_bar_menu', 'remove_admin_bar_items_for_custom_role', 999);

function disable_admin_bar_for_custom_role() {
	if ( current_user_can( 'custom_role' ) ) {
		show_admin_bar( false );
	}
}
add_action( 'after_setup_theme', 'disable_admin_bar_for_custom_role' );

function remove_user_bio_page_menu_for_custom_roles() {
    if( current_user_can('custom_role') ) {
        remove_menu_page('edit.php?post_type=user_bio_page');  // حذف منو آرشیو
    }
}
add_action('admin_menu', 'remove_user_bio_page_menu_for_custom_roles', 999);

function remove_post_meta_boxes() {
    if (get_post_type() === 'user_bio_page') {  // یا نوع پست شما
		remove_meta_box('pageparentdiv', 'user_bio_page', 'side');  // ویژگی‌های نوشته
		remove_meta_box('postimagediv', 'user_bio_page', 'side');
		remove_meta_box('postimagediv', 'user_bio_page', 'side');  // تصویر شاخص
    }
}
add_action('add_meta_boxes', 'remove_post_meta_boxes', 20);


function disable_trash_for_user_bio_page() {
    global $post;
	error_log( $post );
	if ( current_user_can( 'custom_role' ) ) {
		if ( $post->post_type === 'user_bio_page' ) {
			echo '<style>
				
				#wpfooter,
				#adminmenumain,
				#screen-meta-links,
				#revisionsdiv,
				#minor-publishing,
				#delete-action {
					display: none !important;;
				}
					#post-body-content {
                width: 100% !important;
            }
            #post-body {
                display: flex;
                flex-direction: column;
            }
			#postbox-container-1 ,
            #postbox-container-2 {
                width: 100% !important;
            }
			#post-body{
				margin-left: 0px !important
			}
			#post-body-content{
				order:2;
			}
			#postbox-container-1{
				order:1;
			}
			#postbox-container-2{
				order:3;
			}
			#side-sortables{
				min-height: unset !important;
			}
			#wpcontent{
				max-width: 1200px !important;
    			margin: 0 auto !important;
			}
			</style>';
		}
	}
}
// add_action('admin_head', 'disable_trash_for_user_bio_page');

function remove_new_admin_bar_items($wp_admin_bar) {
    // حذف گزینه "افزودن نوشته جدید"
    $wp_admin_bar->remove_node('new-post');
    // حذف گزینه "افزودن برگه جدید"
    $wp_admin_bar->remove_node('new-page');
    // حذف گزینه "افزودن رسانه جدید"
    $wp_admin_bar->remove_node('new-media');
	$wp_admin_bar->remove_node( 'new-elementor_library' );
    // حذف گزینه "افزودن دیدگاه جدید"
    $wp_admin_bar->remove_node('new-comment');
	$wp_admin_bar->remove_node( 'new-user_bio_page' );
}
add_action('admin_bar_menu', 'remove_new_admin_bar_items', 999);

function restrict_post_creation() {
    if (current_user_can('custom_role')) { // یا به جای 'custom_role' نقش مورد نظر خود را وارد کنید
        remove_menu_page('post-new.php'); // برای پست‌های جدید
        remove_menu_page('edit.php?post_type=page'); // برای برگه‌های جدید
        remove_menu_page('upload.php'); // برای رسانه‌های جدید
    }
}
add_action('admin_menu', 'restrict_post_creation', 999);

function restrict_add_new_page() {
    if (current_user_can('custom_role')) {
        global $pagenow;

        if ($pagenow === 'post-new.php') {
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('admin_init', 'restrict_add_new_page');

function create_custom_role() {
    add_role(
        'custom_role',
        __('Custom Role'),
        array(
            'read' => true, // دسترسی برای خواندن
            'add' => false,
        )
    );
}
add_action('init', 'create_custom_role');

function remove_admin_bar_items_for_custom_role3($wp_admin_bar) {
    if (current_user_can('custom_role')) {
        $wp_admin_bar->remove_node('wp-logo'); // حذف لوگو وردپرس
		$wp_admin_bar->remove_node( 'site-name' ); // حذف نام سایت
		$wp_admin_bar->remove_node( 'new-content' ); // حذف نام سایت
		$wp_admin_bar->remove_node('view'); // حذف نام سایت
		$wp_admin_bar->remove_node( 'view' ); // حذف نام سایت
        // حذف سایر آیتم‌ها با استفاده از شناسه‌های آنها
    }
}
add_action('admin_bar_menu', 'remove_admin_bar_items_for_custom_role3', 999);

function restrict_admin_access_for_custom_role() {
    if (current_user_can('custom_role')) {
        global $pagenow;

        // شناسایی پست‌های از نوع user_bio_page که کاربر فعلی نویسنده آن‌ها است
        $current_user_id = get_current_user_id();
        $args = array(
            'post_type' => 'user_bio_page',
            'author'    => $current_user_id,
            'posts_per_page' => -1, // تمام پست‌ها را بگیرید
            'fields'    => 'ids' // فقط آیدی‌ها را بگیرید
        );

        $user_bio_pages = get_posts($args);
        $allowed_edit_ids = $user_bio_pages; // آیدی‌های مجاز برای ویرایش

        // بررسی اینکه آیا کاربر در حال تلاش برای دسترسی به صفحه ویرایش است
        if ($pagenow === 'post.php' && isset($_GET['post']) && !in_array($_GET['post'], $allowed_edit_ids)) {
            wp_redirect(home_url()); // تغییر مسیر به صفحه اصلی یا صفحه دلخواه دیگر
            exit;
        } 
		// elseif ($pagenow !== 'post.php') {
        //     wp_redirect(home_url()); // تغییر مسیر به صفحه اصلی یا صفحه دلخواه دیگر
        //     exit;
        // }
    }
}
add_action('admin_init', 'restrict_admin_access_for_custom_role');

add_action('elementor/editor/after_enqueue_scripts', function() {
            ?>
            <style>
				.MuiButtonBase-root.MuiToggleButton-root.eui-rtl-vw35yq,
				.MuiStack-root.eui-rtl-up134l,
				#elementor-panel-footer-history,
				#elementor-panel-get-pro-elements,
				#elementor-panel-get-pro-elements-sticky,
				#elementor-panel-category-wordpress,
				#elementor-navigator__footer__promotion,
				#elementor-panel-footer-settings{
					display: none !important;
				}
			</style>
            <?php
});
