<?php

defined( 'ABSPATH' ) || exit;

namespace LLMS\Core;

use LLMS\Core as Core;

trait Settings {

	use Core\Options;

	public function get_setting( $key, $computed = false ) {

		if ( ! is_a( $this, "\WP_Post" ) ) {
			return $this->get_option( $key );
		}

		$setting = get_post_meta( $this->ID, \LLMS\PREFIX . 'setting-' . $key, true );

		if ( $setting === 'inherit' && $computed === true ) {
			$inherited_setting = get_post_meta( $this->ID, \LLMS\PREFIX . 'setting-' . $key . '-inherited', true );

			return $inherited_setting;
		}

		return $setting;
	}

	public function get_computed_setting( $key ) {

		$setting = $this->get_setting( $key, true );

		return $setting;
	}

	public function set_setting( $key, $value ) {

		if ( ! is_a( $this, "\WP_Post" ) ) {
			return $this->set_option( $key );
		}

		$inherited_set = true;

		if ( 'inherit' === $value ) {

			$inherited_value = $this->get_inherited_setting( $key );
			$inherited_set = update_post_meta( $this->ID, \LLMS\PREFIX . 'setting-' . $key . '-inherited', $inherited_value );
		}

		if ( ! $inherited_set ) {
			return $inherited_set;
		}

		return update_post_meta( $this->ID, \LLMS\PREFIX . 'setting-' . $key, $value );
	}

	public function delete_setting( $key ) {

		if ( ! is_a( $this, "\WP_Post" ) ) {
			return $this->delete_option( $key );
		}

		$inherited_deleted = delete_post_meta( $this->ID, \LLMS\PREFIX . 'setting-' . $key . '-inherited' );

		if ( ! $inherited_deleted ) {
			return $inherited_deleted;
		}

		return delete_post_meta( $this->ID, \LLMS\PREFIX . 'setting-' . $key );
	}

	public function get_inherited_setting( $key ) {

		//traverse upwards through tree till the setting is not inherit

		/*
		 * Or maybe, a better idea would be to just look one level above.
		 * If the level above is also 'inherit', get the computed value.
		 * However, this heavily depends on the assumption that
		 * the computed setting is correct on the immediately higher level
		 */

		// if the root also has inherit, look for global options
		global $llms;

		return $llms->get_option( $key );
	}

}
