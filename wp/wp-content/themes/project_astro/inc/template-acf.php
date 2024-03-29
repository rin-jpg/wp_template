<?php

/*【管理画面】ACF Options Page の設定 */
// if (function_exists('acf_add_options_page')) {
//   acf_add_options_page(array(
//     'page_title' => 'オプション', // ページタイトル
//     'menu_title' => 'オプション', // メニュータイトル
//     'menu_slug' => 'add_option', // メニュースラッグ
//     'capability' => 'edit_posts',
//     'redirect' => false
//   ));
// }

// ページ個別のcss,js追加
if ( ! function_exists( 'fv_get_add_field' ) ) {
  function fv_get_add_field( $item ){
    if( $item === 'css' ){
      $item = get_field("acf_page_add_css");
    }else if( $item === 'js' ){
      $item = get_field("acf_page_add_js");
    }else{
      $item = '';
    }

    return $item;
  }
}

// noindex処理
if ( ! function_exists( 'meta_noindex' ) ) {
  function meta_noindex(){
    $noindex = get_field("acf_page_noindex");
    if($noindex === true ){
      return '<meta name="robots" content="noindex , nofollow">' . "\n";
    }
  }
}


// // ファイルの拡張子を取得
// if( ! function_exists( 'fv_get_file_extension' ) ){
//   function fv_get_file_extension($field_name, $sub = null){
//     if( $sub === true ){
//       $file_name = get_sub_field($field_name)['filename'];
//     }else{
//       $file_name = get_field($field_name)['filename'];
//     }
//     $file_extension = explode( '.', $file_name );

//     // 配列の最後を取得
//     $last_str = count($file_extension) - 1;
//     return $file_extension[$last_str];
//   }
// }

// // ファイルサイズ取得
// if( ! function_exists( 'fv_get_file_size' ) ){
//   function fv_get_file_size($field_name, $sub = null){
//     if( $sub === true ){
//       $file_path = get_sub_field($field_name)['url'];
//     }else{
//       $file_path = get_field($field_name)['url'];
//     }
//     $file_directory_path = str_replace(esc_url(home_url('/'))."wp/", ABSPATH, $file_path); // ファイル URL をディレクトリパスへ変換
//     if(is_file($file_directory_path)){
//       return size_format(filesize($file_directory_path)); // ファイルサイズを表示
//     }
//   }
// }
