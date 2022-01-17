<?php

// ショートコード: assets
function my_get_directory_assets() {
  $path = get_template_directory_uri() . '/assets/';
  return $path;
}
add_shortcode('get_directory_assets', 'my_get_directory_assets');
// wpcf7_add_shortcode('get_directory_assets', 'my_get_directory_assets');

// ショートコード: images
function my_get_directory_images() {
  $path = get_template_directory_uri() . '/assets/images/';
  return $path;
}
add_shortcode('get_directory_images', 'my_get_directory_images');
// wpcf7_add_shortcode('get_directory_images', 'my_get_directory_images');

// ショートコード: media
function my_get_directory_media() {
  $path = get_template_directory_uri() . '/assets/media/';
  return $path;
}
add_shortcode('get_directory_media', 'my_get_directory_media');
// wpcf7_add_shortcode('get_directory_media', 'my_get_directory_media');

// ショートコード: root
function my_get_directory_root() {
  $path = home_url() . '/';
  return $path;
}
add_shortcode('get_directory_root', 'my_get_directory_root');
// wpcf7_add_shortcode('get_directory_root', 'my_get_directory_root');

// srcsetでショートコードを使用可に
add_filter( 'wp_kses_allowed_html', 'my_wp_kses_allowed_html', 10, 2 );
function my_wp_kses_allowed_html( $tags, $context ) {
	$tags['img']['srcset'] = true;
	$tags['source']['srcset'] = true;
	return $tags;
}
