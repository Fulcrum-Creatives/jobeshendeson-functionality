<?php
/**
 * @package     JobesH
 * @link      	https://github.com/Fulcrum-Creatives/ohiowetlands-functionality
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.0.1
 * @author      Fulcrum Creatives <info@fulcrumcreatives.com>
 *
 * @wordpress-plugin
 * Plugin Name:       Jobes Henderson Custom Functionality
 * Plugin URI:        https://github.com/Fulcrum-Creatives/ohiowetlands-functionality
 * Description:       Custom functinality for http://ohiowetlands.org
 * Version:           0.0.1
 * Author:            Fulcrum Creatives
 * Author URI:        http://fulcrumcreatives.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jobesh
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/Fulcrum-Creatives/ohiowetlands-functionality
 * GitHub Branch:     development
 */ 

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}
if( !class_exists( 'JobesH' ) ) {
	class JobesH {
		
		/**
		 * Instance of the class
		 *
		 * @since 1.0.0
		 * @var Instance of JobesH class
		 */
		private static $instance;

		/**
		 * Instance of the plugin
		 *
		 * @since 1.0.0
		 * @static
		 * @staticvar array $instance
		 * @return Instance
		 */
		public static function instance() {
			if ( !isset( self::$instance ) && ! ( self::$instance instanceof JobesH ) ) {
				self::$instance = new JobesH;
				self::$instance->define_constants();
				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				self::$instance->includes();
				self::$instance->admin_init = new JobesH_Admin_Init();
				self::$instance->init = new JobesH_Init();
			}
		return self::$instance;
		}

		/**
		 * Define the plugin constants
		 *
		 * @since  1.0.0
		 * @access private
		 * @return voide
		 */
		private function define_constants() {
			// Plugin Version
			if ( ! defined( 'JOBESH_VERSION' ) ) {
				define( 'JOBESH_VERSION', '0.0.1' );
			}
			// Prefix
			if ( ! defined( 'JOBESH_PREFIX' ) ) {
				define( 'JOBESH_PREFIX', 'JOBESH_' );
			}
			// Textdomain
			if ( ! defined( 'JOBESH_TEXTDOMAIN' ) ) {
				define( 'JOBESH_TEXTDOMAIN', 'jobesh' );
			}
			// Plugin Options
			if ( ! defined( 'JOBESH_OPTIONS' ) ) {
				define( 'JOBESH_OPTIONS', 'jobesh-options' );
			}
			// Plugin Directory
			if ( ! defined( 'JOBESH_PLUGIN_DIR' ) ) {
				define( 'JOBESH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			// Plugin URL
			if ( ! defined( 'JOBESH_PLUGIN_URL' ) ) {
				define( 'JOBESH_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			// Plugin Root File
			if ( ! defined( 'JOBESH_PLUGIN_FILE' ) ) {
				define( 'JOBESH_PLUGIN_FILE', __FILE__ );
			}
		}

		/**
		 * Load the required files
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			$includes_path = plugin_dir_path( __FILE__ ) . 'includes/';
			require_once JOBESH_PLUGIN_DIR . 'public/class-jobesh-init.php';
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function load_textdomain() {
			$jobesh_lang_dir = dirname( plugin_basename( JOBESH_PLUGIN_FILE ) ) . '/languages/';
			$jobesh_lang_dir = apply_filters( 'jobesh_lang_dir', $jobesh_lang_dir );

			$locale = apply_filters( 'plugin_locale',  get_locale(), JOBESH_TEXTDOMAIN );
			$mofile = sprintf( '%1$s-%2$s.mo', JOBESH_TEXTDOMAIN, $locale );

			$mofile_local  = $jobesh_lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/edd/' . $mofile;

			if ( file_exists( $mofile_local ) ) {
				load_textdomain( JOBESH_TEXTDOMAIN, $mofile_local );
			} else {
				load_plugin_textdomain( JOBESH_TEXTDOMAIN, false, $jobesh_lang_dir );
			}
		}

		/**
		 * Throw error on object clone
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', JOBESH_TEXTDOMAIN ), '1.6' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', JOBESH_TEXTDOMAIN ), '1.6' );
		}

	}
}
/**
 * Return the instance 
 *
 * @since 1.0.0
 * @return object The Safety Links instance
 */
function JobesH_Run() {
	return JobesH::instance();
}
JobesH_Run();