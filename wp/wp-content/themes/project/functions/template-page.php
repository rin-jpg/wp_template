<?php

// // 固定ページの自動整形無効化
// add_filter('the_content', 'wpautop_filter', 9);
// function wpautop_filter($content) {
//   global $post;
//   $remove_filter = false;

//   //自動整形を無効にする投稿タイプを記述 ＝固定ページ
//   $arr_types = array('page');
//   $post_type = get_post_type( $post->ID );
//   if (in_array($post_type, $arr_types)){
//     $remove_filter = true;
//   }

//   // 特定のページの自動整形を無効にしたければ*****にページIDを入れる
//   // if (get_the_ID() == *****){
//   //   $remove_filter = true;
//   // }

//   if ( $remove_filter ) {
//     remove_filter('the_content', 'wpautop');
//     remove_filter('the_excerpt', 'wpautop');
//   }

//   return $content;
// }

// // 抜粋の自動整形を無効化
// remove_filter('the_excerpt', 'wpautop');

// // 本文の自動整形を無効化
// remove_filter('the_content', 'wpautop');

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
