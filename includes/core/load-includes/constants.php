<?php
/**
 * URL to the plugin directory.
 *
 * @since [version]
 */
define( 'LLMS\URL', trailingslashit( plugin_dir_url( $file ) ) );


/**
 * Current Plugin Version.
 *
 * @since 1.0.0
 */
define( 'LLMS\VERSION', '4.0.0-alpha' );

/**
 * Prefix to use in keys and other identifiers
 */
define( 'LLMS\PREFIX', 'llms-' );

/**
 * Underscored prefix to use in identifiers
 */
define( 'LLMS\_PREFIX', str_replace( '-', '_', LLMS\PREFIX ) );

global $wpdb;

/**
 * Prefix for plugin's tables
 */
define( 'LLMS\TABLE_PREFIX', $wpdb->prefix . \BWPAdvanceDocs\_PREFIX );
