<?php

add_action( 'init', function() {
  global $wp_taxonomies;

  remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
  add_action( 'wp_footer','wp_print_head_scripts', 5 );

  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );

  return true;
} );

add_action( 'wp_enqueue_scripts', function() {
  // ブロックエディター用CSS 一覧・詳細ページ以外は読み込み停止
  if ( ! is_archive() && ! is_single() ) {
    wp_dequeue_style( 'wp-block-library' );
  }

  // フォーム以外のページでCF7のリソースは不要なので削除
  if ( ! is_page( 'contact' ) ) {
    wp_deregister_script( 'contact-form-7' );
    wp_deregister_style( 'contact-form-7' );
  }

  // 特定のページ以外からリキャプチャ削除
  if ( ! is_page( 'contact' ) ) {
    wp_deregister_script( 'google-recaptcha' );
  }
}, 100 );

/**
 * 固定ページのみwpautopを削除
 */
function disable_page_wpautop() {
  if ( is_page() ){
    remove_filter( 'the_content', 'wpautop' );
  }
}
add_action( 'wp', 'disable_page_wpautop' );

/**
 * リソースのキャッシュ管理
 */
if ( ! function_exists( 'fv_project_theme_souce' ) ) {
  function fv_project_get_filemtime( $file_path ) {
    return date( 'YmdGis', filemtime( $file_path ) );
  }
}

/**
 * リソースのキャッシュ管理した上でurlを返す
 * <?php echo fv_project_get_cache_clear_source_url( 'assets/css/dev.style.css' ); ? >
 */
if ( ! function_exists( 'fv_project_get_cache_clear_source_url' ) ) {
  function fv_project_get_cache_clear_source_url( $file ) {
    $param = fv_project_get_filemtime( get_template_directory() . '/' . $file );
    return get_template_directory_uri() . '/' . $file . '?ver=' . $param;
  }
}

/* 固定ページのみビジュアルリッチエディタを無効化
 */
function disable_visual_editor($default)
{
  $screen = get_post_type();
  if ($screen == 'page') {
    // クラッシックエディタの場合にのみ限定
    // 投稿情報からエディタータイプを判定する方法
    // https://elearn.jp/wpman/column/c20181211_01.html
    global $post;
    if (apply_filters('replace_editor', false, $post) !== true) {
      if (use_block_editor_for_post($post)) {
        return $default; // block editor
      } else {
        return false; // classic editor
      }
    }
  } else {
    return $default;
  }
}
add_filter('user_can_richedit', 'disable_visual_editor');

// 投稿タイプを指定してブロックエディタを無効化
function disable_block_editor($use_block_editor, $post_type)
{
  if ($post_type === 'page') return false; // 固定ページで無効化
  //  if ($post_type === 'works') return false; // 施工事例で無効化
  return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'disable_block_editor', 10, 10);

// Contact Form 7で自動挿入されるPタグ、brタグを削除
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
  return false;
} 

// 似たスラッグで勝手にリダイレクトを防止
function disable_redirect_canonical( $redirect_url ) {
  if ( is_404() ) {
      return false;
  }
}
add_filter("redirect_canonical", "disable_redirect_canonical");
