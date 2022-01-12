<?php
  // 現在のURL取得
  $fv_this_url = (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

  // 詳細ページの本文を抜粋
  $post_description = $post->post_content;
  $post_description = str_replace(array("\r\n","\r","\n","&nbsp;"),'',$post_description);
  $post_description = wp_strip_all_tags($post_description);
  $post_description = preg_replace('/\[.*\]/','',$post_description);
  $post_description = mb_strimwidth($post_description,0,140,"...");
?>
<!DOCTYPE html>
<html class="no-js" lang="ja" prefix="og: http://ogp.me/ns#" data-root="<?php echo get_template_directory_uri(); ?>/" data-assets="<?php echo get_template_directory_uri(); ?>/assets/">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php if(is_front_page()) : ?>
  <title><?php echo project_config('project_title_full'); ?></title>
  <?php else : ?>
  <title><?php echo my_get_add_seo('title', ' | '); ?><?php echo project_config('project_title'); ?></title>
  <?php endif; ?>
  <?php if(!empty(get_field('acf_page_description')) || is_front_page()) : ?>
  <meta name="description" content="<?php echo my_get_add_seo('description'); ?>">
  <?php elseif(is_singular(project_config('custom_post_slug')) || is_single()) : ?>
  <meta name="description" content="<?php echo $post_description; ?>">
  <?php endif; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">
  <?php echo meta_noindex(); ?>
  <meta name="author" content="<?php echo $project_title; ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="<?php echo $fv_this_url; ?>">
  <meta property="og:locale" content="ja_JP">
  <meta property="og:title" content="<?php echo my_get_add_seo('title', ' | '); ?><?php echo project_config('project_title'); ?>">
  <?php if(!empty(get_field('acf_page_description')) || is_front_page()) : ?>
  <meta property="og:description" content="<?php echo my_get_add_seo('description'); ?>">
  <?php elseif(is_singular(project_config('custom_post_slug')) || is_single()) : ?>
  <meta property="og:description" content="<?php echo $post_description; ?>">
  <?php endif; ?>
  <meta property="og:type" content="<?php
                                    if (is_front_page()) : // トップページ
                                      echo 'website';
                                    else :
                                      echo 'article';
                                    endif;  ?>">
  <?php if(is_single()) : ?>
    <?php if(get_field('acf_post_thumb')) : ?>
  <meta property="og:image" content="<?php echo my_get_retina_url('url') ?>">
    <?php else : ?>
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
    <?php endif; ?>
  <?php else : ?>
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
  <?php endif; ?>
  <meta property="og:project_name" content="<?php echo project_config('project_title'); ?>">
  <meta property="og:url" content="<?php echo $fv_this_url ?>">
  <?php if(is_archive() || is_home()) : ?>
  <link rel="canonical" href="<?php echo $fv_this_url ?>">
  <?php endif; ?>
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <?php if (is_front_page()) : ?>
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/swiper.css' ); ?>">
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/front.style.css' ); ?>">
  <?php else : ?>
    <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/style.css' ); ?>">
  <?php endif; ?>
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/print.css' ); ?>">
  <?php if( is_404() ): ?>
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/template.css' ); ?>">
  <?php endif; ?>
  <script>
    document.documentElement.classList.add('js');
    document.documentElement.classList.remove('no-js');
  </script>

  <script>
    WebFontConfig = {
      google: {
        families: ['Roboto+Condensed:400,700', 'Noto+Sans+JP:400,500,700']
      }
    };
    (function(d) {
      var wf = d.createElement('script'),
        s = d.scripts[0];
      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
      wf.async = true;
      s.parentNode.insertBefore(wf, s);
    })(document);
  </script>
  <?php wp_head(); ?>

    <?php /*
    
    \ \ \ アナリティクス / / /
    
    */ ?>

</head>

