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
			if ( ! empty( $dependencies->queue ) ) {
				foreach( $dependencies->queue as $handle ) {
					if ( ! isset( $dependencies->registered[ $handle ] ) ) {
						continue;
					}

					$dependency = $dependencies->registered[ $handle ];

					echo "<link rel='preload' href='{$dependency->src}' />\n";
				}
			}
		}

	}

}
