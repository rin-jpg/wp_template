<?php

// ショートコード: assets
function fv_get_directory_assets() {
  $path = get_template_directory_uri() . '/assets/';
  return $path;
}
add_shortcode('get_directory_assets', 'fv_get_directory_assets');
// wpcf7_add_shortcode('get_directory_assets', 'fv_get_directory_assets');

// ショートコード: images
function fv_get_directory_images() {
  $path = get_template_directory_uri() . '/assets/images/';
  return $path;
}
add_shortcode('get_directory_images', 'fv_get_directory_images');
// wpcf7_add_shortcode('get_directory_images', 'fv_get_directory_images');

// ショートコード: media
function fv_get_directory_media() {
  $path = get_template_directory_uri() . '/assets/media/';
  return $path;
}
add_shortcode('get_directory_media', 'fv_get_directory_media');
// wpcf7_add_shortcode('get_directory_media', 'fv_get_directory_media');

// ショートコード: root
function fv_get_directory_root() {
  $path = home_url() . '/';
  return $path;
}
add_shortcode('get_directory_root', 'fv_get_directory_root');
// wpcf7_add_shortcode('get_directory_root', 'fv_get_directory_root');

// srcsetなどでショートコードを使用可に
add_filter( 'wp_kses_allowed_html', 'fv_wp_kses_allowed_html', 10, 2 );
function fv_wp_kses_allowed_html( $tags, $context ) {
	$tags['img']['srcset'] = true;
	$tags['img']['data-srcset'] = true;
	$tags['source']['srcset'] = true;
	$tags['source']['data-srcset'] = true;
	$tags['use']['xlink:href'] = true;
	return $tags;
}