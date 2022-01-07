<?php

// メインループ内での1ページの表示件数
function my_pre_get_posts( $query ) {
  if ( is_admin() || ! $query -> is_main_query() ) return;

  if ( $query->is_home() ) {
    $query->set( 'posts_per_page', '10' );
  }elseif(is_category()){
    $query->set( 'posts_per_page', '10' );
  }elseif(is_date()){
    $query->set( 'posts_per_page', '10' );
  }elseif( $query -> is_archive() ) {
    if ( $query->is_archive(project_config("custom_post_slug")) ) { //カスタム投稿タイプを指定
      if(is_tax()){
        $query->set( 'posts_per_page', '12' ); //表示件数を指定
      }else{
        $query->set( 'posts_per_page', '12' ); //表示件数を指定
      }
    }else{
      $query -> set( 'posts_per_page', '10' );
    }
  }
}
add_action( 'pre_get_posts', 'my_pre_get_posts' );
