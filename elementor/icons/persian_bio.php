<?php
namespace persian_icons;

if ( ! defined( 'ABSPATH' ) ) exit;

class persian_icon_class_bio {

	public static $_instance;

	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'persian_icon' ] );
	}

	public function persian_icon( $arg = array() ) {

		$icons = array(
			"bisphone",
			"gap",
			"bale",
			"soroush",
			"eitaa",
			"aparat",
			"cloob",
			"dey",
			"gardeshgari",
			"ghavamin",
			"markazi",
			"mehr",
			"mellat",
			"melli",
			"parsian",
			"refah",
			"saderat",
			"salehin",
			"saman",
			"sarmayeh",
			"tejarat",
			"Enbank",
			"Hekmat",
			"iranzamin",
			"Mahak",
			"Maskan",
			"MEBank",
			"Mehreghtesad",
			"Mehriran",
			"Pasargad",
			"PayamNoor",
			"SanatMadan",
			"Shahr",
			"Shaparak",
			"Shetab",
			"Sina",
			"Tosse",
			"ZarinPal",
			"Afzal-toos"
		);

		$arg['eicons'] = [ 
			'name' => 'persian icons',
			'label' => esc_html__( 'persian icons', BIO_PLUGIN_NAME ),
			'prefix' => 'efa-',
			'displayPrefix' => '',
	        'url' => BIO_PLUGIN_URL . '/elementor/assets/css/persian.css',
			'icons' => $icons,
			'ver' => 1.0,
		];

		return $arg;
	}

}
persian_icon_class_bio::get_instance();