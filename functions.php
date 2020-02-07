<?php

/**
 * Autoloaded functions
 *
 * @package ThemePlate
 * @since 0.1.0
 */


if ( ! function_exists( 'themeplate_preload_actions' ) ) {
	function themeplate_preload_actions() {
		add_action( 'wp_head', array( 'ThemePlate\Preload', 'init' ), 2 );
	}

	themeplate_preload_actions();
}
