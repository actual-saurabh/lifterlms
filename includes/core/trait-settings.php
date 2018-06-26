<?php

defined( 'ABSPATH' ) || exit;

namespace LLMS\Core;

use LLMS\Core as Core;

trait Settings{

	use Core\Options;
	use Core\Tree;

	public function get_setting( $key ) {

		if( ! is_a($this, "\WP_Post" ) ){
			return $this->get_option( $key );
		}

		$setting = get_post_meta( $this->ID, \LLMS\PREFIX . 'setting-' . $key , true );

		if ( $setting === 'inherit' ){
			$setting = $this->get_inherited_setting( $key );
		}

		return $setting;
	}

	public function set_setting( $key, $value ) {

	}

	public function get_inherited_setting( $key ){
		$tree_until = $this->get_tree_until_node();

		//traverse upwards through tree till the setting is not inherit

		// if the root also has inherit, look for global options
		global $llms;

		return $llms->get_option( $key );

	}

}
