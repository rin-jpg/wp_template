<?php

// include: 案件ごとの設定
require get_template_directory() . '/functions/config.php';

// include: ショートコード関連
require get_template_directory() . '/functions/shortcode.php';

// include: ページのカスタム
require get_template_directory() . '/functions/custom-page.php';

// include: カスタムフィールド関連
require get_template_directory() . '/functions/acf.php';

// include: スラッグ・カテゴリ関連
require get_template_directory() . '/functions/slug.php';

// include: ページャー関連
require get_template_directory() . '/functions/pager.php';

// include: ループ関連
require get_template_directory() . '/functions/loop.php';

// include: 管理画面のカスタマイズ
require get_template_directory() . '/functions/custom-admin.php';


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
 */
if ( ! function_exists( 'fv_project_get_cache_clear_source_url' ) ) {
  function fv_project_get_cache_clear_source_url( $file ) {
    $param = fv_project_get_filemtime( get_template_directory() . '/' . $file );
    return get_template_directory_uri() . '/' . $file . '?ver=' . $param;
  }
}
// 出力
// <?php echo fv_project_get_cache_clear_source_url( 'assets/css/dev.style.css' ); ? >


// add_image_size ( "case_thumb", 350, 260 );
// add_image_size ( "case_thumb@2x", 700, 520 );
