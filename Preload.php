<?php

/**
 * Helper for preloading resources
 *
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate;

class Preload {

	private static $storage = array();


	public static function init() {

		$resources = apply_filters( 'themeplate_preload_resources', array() );

		foreach ( $resources as $resource ) {
			self::insert( $resource );
		}

		$dependencies = apply_filters( 'themeplate_preload_dependencies', array() );

		self::prepare();
		self::process( $dependencies );

	}


	private static function prepare() {

		global $wp_scripts, $wp_styles;

		foreach ( array( $wp_scripts, $wp_styles ) as $dependencies ) {
			if ( empty( $dependencies->queue ) || empty( $dependencies->registered ) ) {
				continue;
			}

			$type = get_class( $dependencies );
			self::$storage[ strtolower( substr( $type, 3, -1 ) ) ] = $dependencies->registered;
		}

	}


	private static function process( $handles ) {

		foreach ( self::$storage as $type => $dependencies ) {
			foreach ( array_intersect( $handles, array_keys( $dependencies ) ) as $handle ) {
				$item = array(
					'href' => $dependencies[ $handle ]->src,
					'as'   => $type,
				);

				self::insert( $item );
			}
		}

	}


	private static function insert( $item ) {

		$item = array( 'rel' => 'preload' ) + $item;
		$html = '';

		foreach ( $item as $attr => $value ) {
			$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

			if ( ! is_string( $attr ) ) {
				$html .= " $value";
			} else {
				$html .= " $attr='$value'";
			}
		}

		$html = trim( $html );

		echo "<link $html />\n";

	}

}
