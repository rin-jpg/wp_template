<?php

class config {
  // サイトタイトル
  //  public $project_title = "本家かまどや尾ノ上店 - 宮本フードサービス";
  public $project_title = "";

  //  サイトタイトル - full
  //  public $project_title_full = "本家かまどや尾ノ上店 - 宮本フードサービス/イベント特注弁当・会議弁当・部活弁当の配達サービス";
   public $project_title_full = "";

  // サイトディスクリプション
   public $project_description = "";

  // 投稿のタイトル
   public $post_title = "";

  // カスタム投稿タイプのタイトル
   public $custom_post_title = "";

  // カスタム投稿タイプのスラッグ
   public $custom_post_slug = "";

  // NO TITLE - タイトルがない場合
   public $post_no_title = "NO TITLE";
}

function project_config($config){
    $project_config = new config();
    $project_config = $project_config -> $config;

    return $project_config;
}
