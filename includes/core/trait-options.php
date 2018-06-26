<?php

defined( 'ABSPATH' ) || exit;

namespace LLMS\Core;

trait Options {

	private $options = array();
	private $default_options = array();
	public $name = '';

	public function init_options() {
		if ( empty( $this->name ) && ! empty( $this->id ) ) {
			$this->name = \LLMS\PREFIX . $this->id;
		}
		$this->options = get_option( $this->name, $this->default_options );
	}

	public function get_option( $key ) {

		if ( empty( $this->options ) ) {
			$this->init_options();
		}

		if ( array_key_exists( $key, $this->options ) ) {
			return $this->options[ $key ];
		}

		return false;
	}

	public function set_option( $key, $value ) {

		if ( empty( $this->options ) ) {
			$this->init_options();
		}

		if ( array_key_exists( $key, $this->options ) ) {
			$this->options[ $key ] = $value;
		}

		return $this->refresh_options();
	}

	public function refresh_options() {

		return update_option( $this->name, $this->options );
	}

}
