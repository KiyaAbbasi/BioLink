<?php

if ( ! class_exists( 'CMB2_Bootstrap_2101', false ) ) {


	class CMB2_Bootstrap_2101 {

		const VERSION = '2.10.1';

		const PRIORITY = 9957;

		public static $single_instance = null;

		public static function initiate() {
			if ( null === self::$single_instance ) {
				self::$single_instance = new self();
			}
			return self::$single_instance;
		}

		private function __construct() {

			if ( ! defined( 'CMB2_LOADED' ) ) {
				define( 'CMB2_LOADED', self::PRIORITY );
			}

			if ( ! function_exists( 'add_action' ) ) {
				return;
			}

			add_action( 'init', array( $this, 'include_cmb' ), self::PRIORITY );
		}


		public function include_cmb() {
			if ( class_exists( 'CMB2', false ) ) {
				return;
			}

			if ( ! defined( 'CMB2_VERSION' ) ) {
				define( 'CMB2_VERSION', self::VERSION );
			}

			if ( ! defined( 'CMB2_DIR' ) ) {
				define( 'CMB2_DIR', trailingslashit( dirname( __FILE__ ) ) );
			}

			$this->l10ni18n();

			require_once CMB2_DIR . 'includes/CMB2_Base.php';
			require_once CMB2_DIR . 'includes/CMB2.php';
			require_once CMB2_DIR . 'includes/helper-functions.php';

			spl_autoload_register( 'cmb2_autoload_classes' );

			require_once( cmb2_dir( 'bootstrap.php' ) );
			cmb2_bootstrap();
		}

		public function l10ni18n() {

			$loaded = load_plugin_textdomain( 'cmb2', false, '/languages/' );

			if ( ! $loaded ) {
				$loaded = load_muplugin_textdomain( 'cmb2', '/languages/' );
			}

			if ( ! $loaded ) {
				$loaded = load_theme_textdomain( 'cmb2', get_stylesheet_directory() . '/languages/' );
			}

			if ( ! $loaded ) {
				$locale = apply_filters( 'plugin_locale', function_exists( 'determine_locale' ) ? determine_locale() : get_locale(), 'cmb2' );
				$mofile = dirname( __FILE__ ) . '/languages/cmb2-' . $locale . '.mo';
				load_textdomain( 'cmb2', $mofile );
			}

		}

	}

	CMB2_Bootstrap_2101::initiate();

}
