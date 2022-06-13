<?php

// include: ショートコード関連
require get_template_directory() . '/inc/template-shortcode.php';

// include: カスタムフィールド関連
// require get_template_directory() . '/inc/template-acf.php';

// include: ページャー関連
require get_template_directory() . '/inc/template-pager.php';

// include: ループ関連
require get_template_directory() . '/inc/template-loop.php';

// include: 管理画面のカスタマイズ
require get_template_directory() . '/inc/template-admin.php';


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


// 一覧やタイトルのターム名、ページ数など出力

if ( ! function_exists( 'fv_get_archive_title' ) ) {
  function fv_get_archive_title() {
    //カスタム投稿
    if (is_post_type_archive()){
      if(is_tax()){ // タクソノミーのアーカイブ => is_tax
        if(is_paged()){
          return single_term_title('',false) . ' - ' . get_query_var('paged') . 'ページ目';
        }
        return single_term_title('',false);
      }

      if (is_date()) {
        if (is_year()) {
          $date_name = get_query_var('year').'年';
          if(is_paged()){
            $date_name = get_query_var('year').'年' . ' - ' . get_query_var('paged') . 'ページ目';
          }
        } elseif (is_month()) {
          $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月';
          if(is_paged()){
            $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月' . ' - ' . get_query_var('paged') . 'ページ目';
          }
        }else{
          $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月'.get_query_var('day').'日';
          if(is_paged()){
            $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月'.get_query_var('day').'日' . ' - ' . get_query_var('paged') . 'ページ目';
          }
        }
        return $date_name;
      }

      if(is_paged()){
        return get_query_var('paged') . 'ページ目';
      }
    }

    //投稿者アーカイブページなら
    if (is_author()) {
      return "投稿者".get_queried_object()->data->display_name;
    }

    // 通常の投稿
    $post_title = 'お知らせ';
    if(is_category()){
      if(is_paged()){
        return single_term_title('',false) . ' - ' . get_query_var('paged') . 'ページ目' ;
      }
      return single_term_title('',false);
    }elseif (is_date()) {
      if (is_year()) {
        $date_name = get_query_var('year').'年';
        if(is_paged()){
          $date_name = get_query_var('year').'年' . ' - ' . get_query_var('paged') . 'ページ目';
        }
      } elseif (is_month()) {
        $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月';
        if(is_paged()){
          $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月' . ' - ' . get_query_var('paged') . 'ページ目';
        }
      }else{
        $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月'.get_query_var('day').'日';
        if(is_paged()){
          $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月'.get_query_var('day').'日' . ' - ' . get_query_var('paged') . 'ページ目';
        }
      }
      return $date_name;
    }elseif(is_paged()){
      return $post_title. ' - ' . get_query_var('paged') . 'ページ目' ;
    }
    return $post_title;
  }
}



// アイキャッチ画像を利用できるようにする
add_theme_support('post-thumbnails');

add_image_size ( "ogp_1200×630", 1200, 630 );

// add_image_size ( "hoge", 350, 260 );
// add_image_size ( "hoge@2x", 700, 520 );


/**
 * ↓↓案件個別の処理↓↓
 */

