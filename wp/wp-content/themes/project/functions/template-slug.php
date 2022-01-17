<?php

// ターム名など出力
function my_get_archive_title() {

  //カスタム投稿
  if (is_post_type_archive(project_config("custom_post_type"))){
    if(is_tax()){ // タクソノミーのアーカイブ => is_tax
      return single_term_title('',false);
    }else{
      return project_config("custom_post_title");
    }
  }

  //日付アーカイブページなら
  if (is_date()) {
    if (is_year()) {
      $date_name = get_query_var('year').'年';
    } elseif (is_month()) {
      $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月';
    }else{
      $date_name = get_query_var('year').'年'.get_query_var('monthnum').'月'.get_query_var('day').'日';
    }

    //日付アーカイブページかつ、投稿タイプアーカイブページでもある場合
    if (is_post_type_archive()) {
      return $date_name."の".post_type_archive_title('',false);
    }
    return $date_name;
  }


  //アーカイブページじゃない場合、 false を返す
  if (!is_archive()){
    if(is_paged()){
      return 'ALL - ' . get_query_var('paged') . 'ページ目' ;
    }else{
      return 'ALL';
    }
  }elseif( is_home() || is_archive()){
    return single_term_title('',false);
  }

  //投稿者アーカイブページなら
  if (is_author()) {
    return "投稿者".get_queried_object()->data->display_name;
  }

  //それ以外(カテゴリ・タグ・タクソノミーアーカイブページ)
    return single_term_title('',false);
}
