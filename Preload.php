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

		global $wp_scripts, $wp_styles;

		foreach ( array( $wp_scripts, $wp_styles ) as $dependencies ) {
			self::process( $dependencies );
		}

	}


	private static function process( $dependencies ) {

		if ( ! empty( $dependencies->queue ) ) {
			$type = get_class( $dependencies );
			$type = strtolower( substr( $type, 3, -1 ) );

			foreach( $dependencies->queue as $handle ) {
				if ( ! isset( $dependencies->registered[ $handle ] ) ) {
					continue;
				}

				$dependency = $dependencies->registered[ $handle ];

				echo "<link rel='preload' href='{$dependency->src}' as='{$type}' />\n";
			}
		}

	}

}
