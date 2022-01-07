<?php

// ヒーロータイトル表示
if ( ! function_exists( 'my_get_hero' ) ) {
  function my_get_hero ( $hero ){
    if( $hero === 'main' ){
      $hero = get_field("pApp_acf_page_hero_main");
    }else if( $hero === 'sub' ){
      $hero = get_field("pApp_acf_page_hero_sub");
    }else if( $hero === 'parent' ){
      $hero = get_field("pApp_acf_page_hero_parent");
    }else if( $hero === 'img' ){
      $hero = get_field("pApp_acf_page_hero_image");
    }else{
      $hero = '';
    }

    return $hero;
  }
}

// ページタイトル、ディスクリプション出力
if ( ! function_exists( 'my_get_add_seo' ) ) {
  function my_get_add_seo( $item, $separater = null ){
    global $post;

    if( $item === 'title' ){
      if(is_front_page()){
        // トップページではなにも出力しない
        $item = '';
      }elseif(get_post_type() === project_config("custom_post_slug")){
        // カスタム投稿
        if(is_singular(project_config("custom_post_slug"))){
          // カスタム投稿：詳細
          if(!empty($post->post_title)) :
            $item = esc_html(get_the_title()) . $separater;
          else :
            $item = project_config("post_no_title") . $separater;
          endif;
        }elseif(is_tax()){ // タクソノミーのアーカイブ => is_tax
          if(is_paged()){
            $item = get_query_var('paged') . "ページ目 - " . my_get_archive_title() . $separater;
          }else{
            $item = my_get_archive_title() . " - " . project_config("custom_post_title") . $separater;
          }
        }else{
          if(is_paged()){
            $item = get_query_var('paged') . "ページ目 - " . project_config("custom_post_title") . $separater;
          }else{
            $item = project_config("custom_post_title") . $separater;
          }
        }
      }elseif(is_home()){
        // ブログアーカイブページ
        if(is_paged()){
          $item = get_query_var('paged') . "ページ目 - " . project_config("post_title") . $separater;
        }else{
          $item = project_config("post_title") . $separater;
        }
      }elseif(is_category() || is_date()){
        if(is_paged()){
          $item = get_query_var('paged') . "ページ目 - " . my_get_archive_title() . $separater;
        }else{
          $item = my_get_archive_title() . $separater;
        }
      }elseif(is_single()){
        // ブログ詳細
        if(!empty($post->post_title)) :
          if(!empty(get_field("acf_page_title"))){
            $item = get_field("acf_page_title") . $separater;
          }else{
            $item = esc_html(get_the_title()) . $separater;
          }
        else :
          $item = project_config("post_no_title") . $separater;
        endif;
      }else{
        // 固定ページ
        $item = get_field("acf_page_title") . $separater;
      }
    }else if( $item === 'description' ){
      if(is_front_page() || empty(get_field("acf_page_description"))){
        $item = project_config("site_description");
      }else{
        $item = get_field("acf_page_description");
      }
    }else{
      $item = '';
    }
    return $item;
  }
}

// ページ個別のcss,js追加
if ( ! function_exists( 'my_get_add_field' ) ) {
  function my_get_add_field( $item ){
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
    $noindex = get_field("pApp_acf_page_noindex");
    if($noindex === true ){
      return '<meta name="robots" content="noindex , nofollow">' . "\n";
    }
  }
}


// レティナ対応
if ( ! function_exists( 'my_get_retina_url' ) ) {
  function my_get_retina_url($resize, $thumb_size='full'){
    $get_image_data = [];
    $get_image_id = get_field("acf_post_thumb");
    $get_image = wp_get_attachment_image_src( $get_image_id , $thumb_size);
    for($i = 0; $i < count($get_image); $i++){
      $get_image_data[$i] = $get_image[$i];
    }
    if($resize === 'half'){
      $get_image = $get_image_data[1] / 2 + 1;
    }elseif($resize === 'retina'){
      $get_image = $get_image_data[1] * 2;
    }elseif($resize === 'url'){
      $get_image = $get_image_data[0];
    }elseif($resize === 'w'){
      $get_image = $get_image_data[1];
    }elseif($resize === 'h'){
      $get_image = $get_image_data[2];
    }else{
      $get_image = '';
    }
    return $get_image;
  }
}
