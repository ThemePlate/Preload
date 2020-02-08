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

			$type = get_class( $dependencies );
			$type = strtolower( substr( $type, 3, -1 ) );

			$dependency = $dependencies->registered[ $resource ];

			echo "<link rel='preload' href='{$dependency->src}' as='{$type}' />\n";
		}

	}

}
