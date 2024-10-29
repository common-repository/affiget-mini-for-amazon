<?php
/**
 * @link              http://affiget.com
 * @since             1.0.0
 * @package           AffiGet
 * @wordpress-plugin
 * Plugin Name:       AffiGet Mini
 * Plugin URI:        http://affiget.com/mini/
 * Description:       Instantly post reviews to your blog WHILE browsing Amazon!
 * Version:           1.1.6
 * Author:            Saru Tole
 * Author URI:        http://sarutole.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       afg
 * Domain Path:       /languages
 */
/* Copyright 2013-2015 Saru Tole (sarutole@affiget.com) */

if ( ! defined( 'WPINC' ) )
	die;

if ( ! defined( 'AFG_VER' ))
	define( 'AFG_VER', '1.1.6' );

if ( ! defined( 'AFG_MINI' ))
	define( 'AFG_MINI', 'AffiGet-Mini' );

if ( ! defined( 'AFG_PREFIX' ))
	define( 'AFG_PREFIX', 'afg_' );

if ( ! defined( 'AFG_META_PREFIX' ) )
	define( 'AFG_META_PREFIX', '_afg_' );

if ( ! defined( 'AFG_URL' )){
	define( 'AFG_URL',		    plugin_dir_url( __FILE__ ));
	define( 'AFG_ADMIN_URL',	AFG_URL . 'admin/' );
	define( 'AFG_DIALOG_URL',	AFG_URL . 'dialog/' );
	define( 'AFG_JS_URL',	    AFG_URL . 'public/js/' );
	define( 'AFG_CSS_URL',      AFG_URL . 'public/css/' );
	define( 'AFG_IMG_URL',      AFG_URL . 'public/img/' );
	define( 'AFG_LIBS_URL',     AFG_URL . 'libs/' );
}

if ( ! defined( 'AFG_DIR' ) ){
	define( 'AFG_DIR',          plugin_dir_path( __FILE__ ) );
	define( 'AFG_ADMIN_DIR',    AFG_DIR. 'admin' . DIRECTORY_SEPARATOR );
	define( 'AFG_DIALOG_DIR',   AFG_DIR. 'dialog' . DIRECTORY_SEPARATOR );
	define( 'AFG_JS_DIR',       AFG_DIR. 'public' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR );
	define( 'AFG_CSS_DIR',      AFG_DIR. 'public' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR );
	define( 'AFG_IMG_DIR',      AFG_DIR. 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR );
	define( 'AFG_LIBS_DIR',     AFG_DIR. 'libs'   . DIRECTORY_SEPARATOR );
}


/**
 * The code that runs during plugin activation.
 * This action is documented in core/class-affiget-activator.php
 */
register_activation_hook( __FILE__, 'affiget_mini__activate' );
function affiget_mini__activate() {

	require_once plugin_dir_path( __FILE__ ) . 'core/class-affiget-activator.php';
	AffiGet_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in core/class-affiget-deactivator.php
 */
register_deactivation_hook( __FILE__, 'affiget_mini__deactivate' );
function affiget_mini__deactivate() {

	require_once plugin_dir_path( __FILE__ ) . 'core/class-affiget-deactivator.php';
	AffiGet_Deactivator::deactivate();
}

if( ! function_exists( 'afg_log' )):
	function afg_log( $message, $params = null ) {

		if( $params != null ){
			$message = array( $message => $params );
		}
		if( defined('WP_DEBUG') && WP_DEBUG === true ){
			if( is_array( $message ) || is_object( $message ) ){
				error_log( "\n" . print_r( $message, true ), 3, WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'debug.log' );
			} else {
				error_log( "\n" . $message, 3, WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'debug.log' );
			}
		}
	}
endif;

if( ! function_exists( 'afg_pre' )):
	function afg_pre( $message, $params = null ) {

		if( $params != null ){
			$message = array( $message => $params );
		}
		if( defined('WP_DEBUG') && WP_DEBUG === true ){
			if( is_array( $message ) || is_object( $message ) ){
				echo '<pre>' . print_r( $message, true ) . '</pre>';
			} else {
				echo '<pre>' . $message . '</pre>';
			}
		}
	}
endif;

/**
 * Base class for all the exceptions thrown by the plugin.
 */
require plugin_dir_path( __FILE__ ) . 'core/class-affiget-exception.php';

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'core/class-affiget-mini.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

//add_action( 'init', 'affiget_mini__start', 10 );
//function affiget_mini__start(){
	global $affiget_mini;
	$affiget_mini = new AffiGet_Mini();
	$affiget_mini->run();
//}