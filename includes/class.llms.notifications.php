<?php
/**
 * LifterLMS Notifications Management and Interface
 * Loads and allows interactions with notification views, controllers, and processors
 *
 * @since     [version]
 * @version   [version]
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class LLMS_Notifications {

	/**
	 * Singleton instance
	 * @var  null
	 */
	protected static $_instance = null;

	/**
	 * Controller instances
	 * @var  array
	 */
	private $controllers = array();

	/**
	 * Background processor instances
	 * @var  array
	 */
	private $processors = array();

	/**
	 * Array of processors needing to be dispatched on shutdown
	 * @var  array
	 */
	private $processors_to_dispatch = array();

	/**
	 * Views
	 * @var  array
	 */
	private $views = array();

	/**
	 * Main Instance
	 * @return    LLMS_Controller_Notifications
	 * @since     [version]
	 * @version   [version]
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 * @since    [version]
	 * @version  [version]
	 */
	private function __construct() {

		$this->load();
		add_action( 'shutdown', array( $this, 'dispatch_processors' ) );

	}

	/**
	 * On shutdown, check for processors that have items in the queue that need to be saved
	 * save & dispatch the backgroun process
	 * @return   void
	 * @since    [version]
	 * @version  [version]
	 */
	public function dispatch_processors() {

		foreach ( $this->processors_to_dispatch as $name ) {

			$processor = $this->get_processor( $name );
			if ( $processor ) {
				$processor->save()->dispatch();
			}

		}

	}

	/**
	 * Get the directory path for core notification classes
	 * @return   string
	 * @since    [version]
	 * @version  [version]
	 */
	private function get_directory() {
		return LLMS_PLUGIN_DIR . 'includes/notifications/';
	}

	/**
	 * Get a single controller instance
	 * @param    string     $controller  trigger id (eg: lesson_complete)
	 * @return   obj
	 * @since    [version]
	 * @version  [version]
	 */
	public function get_controller( $controller ) {
		if ( isset( $this->controllers[ $controller ] ) ) {
			return $this->controllers[ $controller ];
		}
		return false;
	}

	/**
	 * Get loaded controllers
	 * @return   array
	 * @since    [version]
	 * @version  [version]
	 */
	public function get_controllers() {
		return $this->controllers;
	}

	/**
	 * Retrieve a single processor instance
	 * @param    string     $processor  name of the processor (eg: email)
	 * @return   obj
	 * @since    [version]
	 * @version  [version]
	 */
	public function get_processor( $processor ) {
		if ( isset( $this->processors[ $processor ] ) ) {
			return $this->processors[ $processor ];
		}
		return false;
	}

	/**
	 * Get loaded processors
	 * @return   array
	 * @since    [version]
	 * @version  [version]
	 */
	public function get_processors() {
		return $this->processors;
	}

	/**
	 * Retrieve a view instance of a notification
	 * @param    obj       $notification  instance of an LLMS_Notification
	 * @return   obj|false
	 * @since    [version]
	 * @version  [version]
	 */
	public function get_view( $notification ) {

		$trigger = $notification->get( 'trigger_id' );

		if ( in_array( $trigger, $this->views ) ) {
			$class = $this->get_view_classname( $trigger );
			$view = new $class( $notification );
			return $view;
		}

		return false;

	}

	/**
	 * Get the classname for the view of a given notification based off it's trigger
	 * @param    string     $trigger  trigger id (eg: lesson_complete)
	 * @return   string
	 * @since    [version]
	 * @version  [version]
	 */
	private function get_view_classname( $trigger ) {
		$name = str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $trigger ) ) );
		return 'LLMS_Notification_View_' . $name;
	}

	/**
	 * Load all notifications
	 * @return   void
	 * @since    [version]
	 * @version  [version]
	 */
	private function load() {

		$triggers = array(
			'lesson_complete',
		);

		foreach ( $triggers as $name ) {

			$this->load_controller( $name );
			$this->load_view( $name );

		}

		$processors = array(
			'email',
		);

		foreach ( $processors as $name )  {
			$this->load_processor( $name );
		}

		/**
		 * Third party notifications can hook into this action
		 * Use $this->load_view(), $this->load_controller(), & $this->load_processor()
		 * to load notifications into the class and be auto-called by the APIs herein
		 */
		do_action( 'llms_notifications_loaded', $this );

	}

	/**
	 * Load and initialize a single controller
	 * @param    string     $trigger  trigger id (eg: lesson_complete)
	 * @param    string     $path     full path to the controller file, allows third parties to load external controllers
	 * @return   boolean              true if the controller is added and loaded, false otherwise
	 * @since    [version]
	 * @version  [version]
	 */
	public function load_controller( $trigger, $path = null ) {

		// default path for core views
		if ( ! $path ) {
			$path = $this->get_directory() . 'class.llms.notification.controller.' . $this->name_to_file( $trigger ) . '.php';
		}

		if ( file_exists( $path ) ) {

			$this->controllers[ $trigger ] = require_once $path;
			return true;

		}

		return false;

	}

	/**
	 * Load a single processor
	 * @param    string     $type   processor type id
	 * @param    string     $path   optional path (for allowing 3rd party processor loading)
	 * @return   boolean
	 * @since    [version]
	 * @version  [version]
	 */
	public function load_processor( $type, $path = null ) {

		// default path for core processors
		if ( ! $path ) {
			$path = $this->get_directory() . 'class.llms.notification.processor.' . $type . '.php';
		}

		if ( file_exists( $path ) ) {

			$this->processors[ $type ] = require_once $path;
			return true;

		}

		return false;
	}

	/**
	 * Load a single view
	 * @param    string     $trigger  trigger id (eg: lesson_complete)
	 * @param    string     $path     full path to the view file, allows third parties to load external views
	 * @return   boolean              true if the view is added and loaded, false otherwise
	 * @since    [version]
	 * @version  [version]
	 */
	public function load_view( $trigger, $path = null ) {

		// default path for core views
		if ( ! $path ) {
			$path = $this->get_directory() . 'class.llms.notification.view.' . $this->name_to_file( $trigger ) . '.php';
		}

		if ( file_exists( $path ) ) {

			require_once $path;
			$this->views[] = $trigger;
			return true;

		}

		return false;

	}

	/**
	 * Convert a trigger name to a filename string
	 * Eg lesson_complete to lesson.complete
	 * @param    string     $name  trigger name
	 * @return   string
	 * @since    [version]
	 * @version  [version]
	 */
	private function name_to_file( $name ) {
		return str_replace( '_', '.', $name );
	}

	/**
	 * Schedule a processor to dispatch its queue on shutdown
	 * @param    string     $type  processor name/type (eg: email)
	 * @return   void
	 * @since    [version]
	 * @version  [version]
	 */
	public function schedule_processing( $type ) {

		if ( ! in_array( $type, $this->processors_to_dispatch ) ) {

			$this->processors_to_dispatch[] = $type;

		}

	}

}
