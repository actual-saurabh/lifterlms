<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) || exit;

/**
 * Dynamically loads the class attempting to be instantiated elsewhere in the
 * plugin.
 */
spl_autoload_register( '_llms_lifterlms_autoload' );

/**
 * Dynamically loads the class attempting to be instantiated elsewhere in the
 * plugin by looking at the $class_name parameter being passed as an argument.
 *
 * The argument should be in the form: LLMS\Namespace. The
 * function will then break the fully-qualified class name into its pieces and
 * will then build a file to the path based on the namespace.
 *
 * The namespaces in this plugin map to the paths in the directory structure.
 *
 * @param string $class_name The fully-qualified name of the class to load.
 */
function _llms_lifterlms_autoload( $class_name ) {

	// If the specified $class_name does not include our namespace, duck out.
	if ( false === strpos( $class_name, 'LLMS' ) ) {
		return;
	}

	// Split the class name into an array to read the namespace and class.
	$file_parts = explode( '\\', $class_name );


	$file_parts = array_map( '_llms_lifterlms_autoload_get_path_part', $file_parts );

	$class_instance_name = array_pop( $file_parts );

	$file_name = _llms_lifterlms_autoload_get_file_name($class_instance_name);

	$plugin_folder_part = array_shift($file_parts);

	$namespace = trailingslashit(implode('/', $file_parts));

	// Now build a path to the file using mapping to the file location.
	$filepath = \LLMS\PATH . $namespace.$file_name;

	// If the file exists in the specified path, then include it.
	if ( file_exists( $filepath ) ) {
		include_once( $filepath );
	} else {
		wp_die(
			esc_html( "The file attempting to be loaded at $filepath does not exist." )
		);
	}
}

function _llms_lifterlms_autoload_get_path_part( $file_part ) {
	$path_part = strtolower( $file_part );

	return str_ireplace( '_', '-', $path_part );
}

function _llms_lifterlms_autoload_get_file_name($class_instance_name){
	/* If 'interface' is contained in the parts of the file name, then
	 * define the $file_name differently so that it's properly loaded.
	 * Otherwise, just set the $file_name equal to that of the class
	 * filename structure.
	 */

	if ( strpos( strtolower( $class_instance_name ), 'interface' ) ) {

		// Grab the name of the interface from its qualified name.
		$interface_name = explode( '-', $class_instance_name );
		$interface_name = $interface_name[ 0 ];

		$file_name = "interface-$interface_name.php";
	} elseif ( strpos( strtolower( $class_instance_name ), 'trait' ) ) {

		// Grab the name of the interface from its qualified name.
		$trait_name = explode( '-', $class_instance_name );
		$trait_name = $trait_name[ 0 ];

		$file_name = "trait-$trait_name.php";
	} else {
		$file_name = "class-$class_instance_name.php";
	}

	return $file_name;

}
