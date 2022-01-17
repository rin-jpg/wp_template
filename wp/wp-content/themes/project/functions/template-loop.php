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

// 年月アーカイブの表示
if ( ! function_exists( 'my_wp_get_archives' ) ) {
  function my_wp_get_archives($args = array(), $before = null, $after = null) {
    global $post;

    $pattern = array( '/<li>/', '/<a href=\'((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)\'>/', '/<\/a>&nbsp;\(([0-9]*)\)/' );
    $replace = array( '<li class="l-side-list__col">', '<a href="$1">', '年</a></li>' );

    $post_type = get_post_type();
    $post_type = !empty( $post_type ) ? $post_type : get_post_type( $post );

    $defaults = array(
      'type' => 'yearly',
      'format' => 'html',
      'show_post_count' => 1,
      'echo' => 0,
      'post_type' => $post_type
    );

    $args = wp_parse_args( $args, $defaults );
    $args = wp_get_archives( $args );

    if ( !empty( $args ) ) {
      return $before . preg_replace( $pattern, $replace, $args ) . $after;
    } else {
      return false;
    }
  }
}