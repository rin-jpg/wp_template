<?php

/**
 * 「概要」にカスタム投稿を追加
 * http://magnets.jp/web_design/cms-web_design/2109/#custom3
 */
if ( ! function_exists( 'custom_post_in_right_now' ) ) {
  function custom_post_in_right_now($elements){
    global $wp_post_types;
    $custom_post_types = get_post_types(array('_builtin' => false, 'public' => true,), 'object', 'and'); // カスタム投稿取得
    if (!$custom_post_types) {
      return;
    } else {
      foreach ($custom_post_types as $custom_post_type) {
        $name = $custom_post_type->name;
        $label = $custom_post_type->labels->name;
        $num_posts = wp_count_posts($name);
        $num = number_format_i18n($num_posts->publish);
        if (current_user_can('edit_posts')) {
          $elements[] = '<a href="edit.php?post_type=' . $name . '" class="' . $name . '-count">' . $num . '件の' . $label . '</a>';
        }
      }
      return $elements;
    }
  }
  add_filter('dashboard_glance_items', 'custom_post_in_right_now');
}

/**
 * 「アクティビティ」にカスタム投稿、固定ページを追加
 * http://magnets.jp/web_design/cms-web_design/2209/#custom4
 */
if ( ! function_exists( 'custom_post_in_activity' ) ) {
  function custom_post_in_activity($query){
    global $pagenow;
    $custom_post_types = get_post_types(array('_builtin' => false, 'public' => true,), 'names', 'and'); // カスタム投稿取得
    if (!$custom_post_types) {
      return;
    } else {
      if (is_admin() && !$query->is_main_query() && $query->get('post_type') && $pagenow == 'index.php') {
        array_push($custom_post_types, 'post'); //投稿追加　固定ページ除外  , 'page'
        $query->set('post_type', $custom_post_types); //ループの変更
      }
    }
  }
  add_action('pre_get_posts', 'custom_post_in_activity');
}


// ウィジェットのタグを非表示に
add_action( 'init', function() {
  global $wp_taxonomies;

  // remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
  // add_action( 'wp_footer','wp_print_head_scripts', 5 );

  // remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  // remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  // remove_action( 'wp_print_styles', 'print_emoji_styles' );

  // タグの非表示
  if ( !empty( $wp_taxonomies[ 'post_tag' ]->object_type ) ) {
      foreach ( $wp_taxonomies[ 'post_tag' ]->object_type as $i => $object_type ) {
          if ( $object_type == 'post' ) {
              unset( $wp_taxonomies[ 'post_tag' ]->object_type[ $i ] );
          }
      }
  }

  return true;
} );

// 固定ページのみビジュアルエディタ表示を無効
function disable_visual_editor_in_page(){
  global $typenow;
  if( $typenow == 'page' ){
      add_filter('user_can_richedit', 'disable_visual_editor_filter');
  }
}
function disable_visual_editor_filter(){
  return false;
}
add_action( 'load-post.php', 'disable_visual_editor_in_page' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );
