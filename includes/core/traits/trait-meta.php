<?php

defined( 'ABSPATH' ) || exit;

namespace LLMS\Core;

use LLMS\Core as Core;

trait Meta{

	public function get_object_meta( $key ){

		if( !property_exists( $this, 'object' ) ){
			return false;
		}

		return get_post_meta( $this->object->ID, \LLMS\PREFIX . $key , true );

	}

	public function set_object_meta( $key, $value ){

		if( !property_exists( $this, 'object' ) ){
			return false;
		}

		return update_post_meta( $this->object->ID, \LLMS\PREFIX . $key , $value );

	}

	public function delete_object_meta( $key ){

		if( !property_exists( $this, 'object' ) ){
			return false;
		}

		return delete_post_meta( $this->object->ID, \LLMS\PREFIX . $key );

	}
}

