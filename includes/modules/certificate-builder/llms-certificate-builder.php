<?php
/**
 * Loads Certificate Builder Module.
 *
 * @package LifterLMS/Modules/Certificate_Builder
 *
 * @since [version]
 * @version [version]
 */

defined( 'ABSPATH' ) || exit;

// don't load, if the constant's value is explcitly defined to false.
if ( defined( 'LLMS_CERTIFICATE_BUILDER' ) && ( false === LLMS_CERTIFICATE_BUILDER ) ) {
	return; // not exit, because we don't want to stop the module loader.
}

// at this point, either the constant is not set at all or explcitly defined to false.
if ( ! defined( 'LLMS_CERTIFICATE_BUILDER' ) ) {

	/**
	 * Defines whether the certificate module should load/ is loaded.
	 *
	 * If set in wp-config, defines if the module should load at all.
	 * If not, it is set to true by the module before it loads the rest of the files, to indicate:
	 *  - to the rest of the module that they can load.
	 *  - to code that runs subsequently (in templates, for example), that the module was probably loaded successfully.
	 *
	 * @since [version]
	 */
	define( 'LLMS_CERTIFICATE_BUILDER', true );
}

// this point onwards, LLMS_CERTIFICATE_BUILDER will have been set appropriately.

if ( ! LLMS_CERTIFICATE_BUILDER ) {
	return;
}

/**
 * Main Certificate Builder class.
 *
 * @since [version]
 */
require_once LLMS_PLUGIN_DIR . 'includes/modules/certificate-builder/class-llms-certificate-builder.php';
