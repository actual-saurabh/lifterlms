<?php
/**
 * Contains main Certificate Builder module class.
 *
 * @package LifterLMS/Modules/Certificate_Builder
 *
 * @since   [version]
 * @version [version]
 */

defined( 'ABSPATH' ) || exit;

/**
 * Loads the certificate builder module.
 *
 * @since [version]
 */
class LLMS_Certificate_Builder {

	/**
	 * Constructor.
	 *
	 * @since [version]
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialises module.
	 *
	 * @since [version]
	 */
	public function init() {

		// load all constants.
		$this->constants();

		$this->load_migrator();

		// extend editor on dashboard.
		if ( is_admin() ) {
			$this->extend_editor();
		}

		// toolbar button.
		$this->add_toolbar_button();

		// load builder.
		$this->load_builder();

	}

	/**
	 * Defines module constants.
	 *
	 * @since [version]
	 */
	private function constants() {

		if ( ! defined( 'LLMS_CERTIFICATE_BUILD_MODE_PARAMETER' ) ) {

			/**
			 * Sets the query parameter that loads frontend builder.
			 *
			 * @var   string
			 * @since [version]
			 */
			define( 'LLMS_CERTIFICATE_BUILD_MODE_PARAMETER', 'llms-build-mode' );
		}

		if ( ! defined( 'LLMS_CERTIFICATE_BUILDER_ENABLE_MIGRATION' ) ) {

			/**
			 * Enable/Disable migration.
			 *
			 * @var   bool
			 * @since [version]
			 */
			define( 'LLMS_CERTIFICATE_BUILDER_ENABLE_MIGRATION', true );
		}

		if ( ! defined( 'LLMS_CERTIFICATE_BUILDER_ENABLE_TOOLBAR_BUTTON' ) ) {

			/**
			 * Enable/Disable toolbar button.
			 *
			 * @var   bool
			 * @since [version]
			 */
			define( 'LLMS_CERTIFICATE_BUILDER_ENABLE_TOOLBAR_BUTTON', true );
		}
	}

	/**
	 * Adds toolbar button.
	 *
	 * @since [version]
	 */
	private function add_toolbar_button() {

		// Bail if the constant is toggled off.
		if ( false === LLMS_CERTIFICATE_BUILDER_ENABLE_TOOLBAR_BUTTON ) {
			return;
		}

		/**
		 * Class that loads toolbar button.
		 *
		 * @since [version]
		 */
		include_once 'includes/admin/class-llms-certificate-builder-toolbar.php';
	}

	/**
	 * Load migration functionality.
	 *
	 * @since [version]
	 */
	public function load_migrator() {

		// Bail if the constant is toggled off.
		if ( ! LLMS_CERTIFICATE_BUILDER_ENABLE_MIGRATION ) {
			return;
		}

		/**
		 * Class that loads migration functionality.
		 *
		 * @since [version]
		 */
		include_once 'includes/migration/class-llms-certificate-migrator.php';

		// no need to load metabox and bulk migrator on frontend; bail.
		if ( ! is_admin() ) {
			return;
		}

		/**
		 * Class that loads bulk migration functionality.
		 *
		 * @since [version]
		 */
		include_once 'includes/migration/class-llms-certificate-bulk-migrator.php';

		/**
		 * Class that loads the migration metabox on certificates.
		 *
		 * @since [version]
		 */
		include_once 'includes/admin/class-llms-certificate-migration-metabox.php';
	}

	/**
	 * Extends post editor.
	 *
	 * @since [version]
	 */
	public function extend_editor() {

		/**
		 * Class that extends posts table for certificates.
		 *
		 * @since [version]
		 */
		include_once 'includes/admin/class-llms-certificate-post-table.php';

		/**
		 * Class that extends post editor for certificates.
		 *
		 * @since [version]
		 */
		include_once 'includes/admin/class-llms-certificate-post-editor.php';
	}

	/**
	 * Loads Builder UI.
	 *
	 * @since [version]
	 */
	public function load_builder() {

		/**
		 * Common functions for builder.
		 */
		include_once 'includes/functions/llms-certificate-builder-functions.php';

		// no need to load on the dashboard
		if ( ! is_admin() ) {

			/**
			 * Class that loads webpage fonts on the builder.
			 *
			 * @since [version]
			 */
			include_once 'includes/builder/class-llms-webpage-fonts.php';

			/**
			 * Class that loads the actual builder screen.
			 *
			 * @since [version]
			 */
			include_once 'includes/builder/class-llms-certificate-builder-screen.php';
		}
	}

}

return new LLMS_Certificate_Builder();

/*
 * Hands of the master
 * Cast endorsements aplenty,
 * To discern faster.
 */
