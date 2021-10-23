# ThemePlate Preload _(Legacy)_

> _Check out the [Resource](https://github.com/ThemePlate/Resource) package._

## Usage

```php
add_action( 'wp_head', array( 'ThemePlate\Preload', 'init' ), 2 );

add_filter( 'themeplate_preload_resources', function( $list ) {
	$list[] = array(
		'href' => 'https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_cJD3gTD_u50.woff2',
		'as'   => 'font',
		'type' => 'font/woff2',
	);

	return $list;
} );

add_filter( 'themeplate_preload_dependencies', function( $list ) {
	$list[] = 'jquery-core';
	$list[] = 'theme-script';

	return $list;
} );
```

### apply_filters( 'themeplate_preload_resources', $list )

Preload resources manually specifying their attributes in an array format

- **$list** _(array)(Required)_ List of wanted resources to preload

### apply_filters( 'themeplate_preload_dependencies', $list )

Preload registered dependencies using their unique handles

- **$list** _(array)(Required)_ List of registered dependencies to preload
