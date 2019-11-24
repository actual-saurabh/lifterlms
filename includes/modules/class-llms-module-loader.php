<?php
/**
 * Contains Module loader class.
 *
 * @package LifterLMS/Modules
 * @since [version] Introduced
 * @version [version]
 */

defined( 'ABSPATH' ) || exit;

/**
 * Loads all modules
 *
 * Each module is an array of the following information:
 *
 *    $module = array(
 *        'name' => 'module-name',
 *        'file_path' => 'lifterlms/includes/modules/module-name/class-llms-module-name.php',
 *        'constant_name' => 'LLMS_MODULE_NAME',
 *    );
 *
 * Like this dummy model, core modules also follow this naming convention.
 *
 * The boolean value of the LLMS_MODULE_NAME constant acts like a switch
 * to turn a module on or off. By default, if the value of this constant isn't explicitly set
 * (in wp.config.php or elsewhere), it is assumed to be true.
 * So, to turn a module off, you add the following line to wp-config.php:
 *
 *    define( 'LLMS_MODULE_NAME', false );
 *
 * For core modules, this information is extracted from the directory structure inside
 * lifterlms/includes/modules/. Custom modules can obviously be added or used to replace existing modules
 * using lifterlms_modules_to_load filter which provides an array of all the modules about to be loaded.
 *
 * @since [version]
 */
class LLMS_Module_Loader {

	/**
	 * Singleton instance of LLMS_Module_Loader.
	 *
	 * @var    LLMS_Module_Loader
	 * @since [version] Introduced
	 */
	protected static $_instance = null;

	/**
	 * List loaded modules.
	 *
	 * @var   array
	 * @since [version] Introduced
	 */
	private $loaded = array();

	/**
	 * List of module information.
	 *
	 * @var array
	 */
	private $info = array();

	/**
	 * Main Instance of LifterLMS Module Loader.
	 *
	 * @since  [version] Introduced
	 * @return LLMS_Module_Loader
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self(); }
		return self::$_instance;
	}

	/**
	 * Constructor.
	 *
	 * @since [version] Introduced
	 */
	private function __construct() {
		$this->info = $this->load_info();
		$this->loaded = $this->load();
	}

	/**
	 * Loads Modules.
	 *
	 * @since [version] Introduced
	 */
	private function load() {

		/**
		 * Filters list of LifterLMS modules just before load.
		 *
		 * The modules are listed as indexed elements in an array:
		 *
		 *    $modules = array(
		 *        'module_name' => 'lifterlms/includes/modules/module-name/llms-module-name.php',
		 *        'module2_name' => 'lifterlms/includes/modules/module2-name/llms-module2-name.php
		 *        ...
		 *    )
		 *
		 * @since [version] Introduced.
		 */
		$to_load = apply_filters( 'lifterlms_modules_to_load', $this->info );

		// initialise after-load information.
		$loaded = array();

		foreach ( $to_load as $name=>$path ) {

			// bail, if the main file doesn't exist.
			if ( ! file_exists( $path ) ) {
				continue;
			}

			// all fine, include the file.
			include_once $path;

			// add module's info to loaded information.
			$loaded[ $name ] = $path;

			/**
			 * Fires after a particular module's main file is loaded.
			 *
			 * This only contains basic information about what module was attempted to load.
			 * The actual loading of the module is handled by the main file which may choose to not do so.
			 *
			 * If you want specific information related to the modules' functionality,
			 * or absolutely confirm that the modules was loaded
			 * look for hooks within the module itself.
			 *
			 * @since [version] Introduced.
			 */
			do_action( "lifterlms_module_{$name}_loaded", $path );

		}

		/**
		 * Fires after all the modules are loaded.
		 *
		 * @param $loaded array Information about all loaded modules
		 *
		 * @since [version] Introduced
		 */
		do_action( 'lifterlms_modules_loaded', $loaded );

		return $loaded;

	}

	/**
	 * Loads Module Information.
	 *
	 * @since [version] Introduced
	 */
	private function load_info() {

		// get a list of directories inside the modules directory.
		$directories = glob( LLMS_PLUGIN_DIR . 'includes/modules/*', GLOB_ONLYDIR );

		$modules = array();

		// loop through every directory
		foreach ( $directories as $module ) {
			// the name of the module is the same as the name of the directory. eg "certificate-builder"
			$module_name = basename( $module );

			// start setting this modules' information
			$modules[ $module_name ] = "{$module}/llms-{$module_name}.php";

			unset( $module_name );

		}

		return $modules;

	}

}

/*
 * Of every measure,
 * Sliced neatly, tied together,
 * Some features clever.
 */
