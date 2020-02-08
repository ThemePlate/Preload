<?php

/**
 * Preload registered assets
 *
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate;

class Preload {

	public static function init() {

		$resources = apply_filters( 'themeplate_preload', array() );

		foreach( $resources as $resource ) {
			self::process( $resource );
		}

	}


	private static function process( $resource ) {

		global $wp_scripts, $wp_styles;

		foreach ( array( $wp_scripts, $wp_styles ) as $dependencies ) {
			if ( empty( $dependencies->queue ) || ! isset( $dependencies->registered[ $resource ] ) ) {
				continue;
			}

			$dependency = $dependencies->registered[ $resource ];

			$type = get_class( $dependencies );
			$item = array(
				'href' => $dependency->src,
				'as'   => strtolower( substr( $type, 3, -1 ) ),
			);

			self::insert( $item );
		}

	}


	private static function insert( $item ) {

		$item['rel'] = 'preload';
		$attributes  = '';

		foreach ( $item as $attr => $value ) {
			$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

			$attributes .= " $attr='$value'";
		}

		$attributes = trim( $attributes );

		echo "<link $attributes />\n";

	}

}
