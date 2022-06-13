<?php
  // 現在のURL取得
  $fv_this_url = (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

  // 詳細ページの本文を抜粋
  $post_description = $post->post_content;
  $post_description = str_replace(array("\r\n","\r","\n","&nbsp;"),'',$post_description);
  $post_description = wp_strip_all_tags($post_description);
  $post_description = preg_replace('/\[.*\]/','',$post_description);
  $post_description = mb_strimwidth($post_description,0,140,"...");

  // サイト名
  $fv_sitename = get_bloginfo('name');

  // ページタイトル
  global $fv_pagetitle;
  if ($fv_pagetitle) :
    $fv_pagetitle = $fv_pagetitle . '｜' . $fv_sitename;
  elseif(is_404()):
    $fv_pagetitle = 'ページが存在しません' . '｜' . $fv_sitename;
  else :
    $fv_pagetitle = get_bloginfo('description') . ' | ' . $fv_sitename;
  endif;

  // description設定
  global $fv_description;

  if(is_front_page()) :
    $fv_description = 'ディスクリプション';
  elseif (is_archive()) :
    $fv_description = null;
  elseif (is_singular() && get_field('acf_page_description')) :
    $fv_description = get_field('acf_page_description');
  else :
    $fv_description = get_field('acf_page_description');
  endif;

  //og:image
  global $ogimage;

  if (is_singular() && has_post_thumbnail()) :
    $ogimage = get_the_post_thumbnail_url(get_the_ID(), 'ogp_1200×630');
  else :
    $ogimage = get_template_directory_uri() . "/assets/images/og-image.jpg";
  endif;

  $h1home = "div";
  if(is_front_page()){
    $h1home = "h1";
  }
?>
<!DOCTYPE html>
<html class="no-js" lang="ja" prefix="og: http://ogp.me/ns#" data-root="<?php echo get_template_directory_uri(); ?>/" data-assets="<?php echo get_template_directory_uri(); ?>/assets/">

<head>
  <title><?php echo $fv_pagetitle; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <?php if ($fv_description) : ?>
    <meta property="og:description" content="<?php echo $fv_description; ?>">
  <?php endif; ?>
  <?php echo meta_noindex(); ?>
  <meta name="author" content="<?php echo $fv_sitename ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="<?php echo $fv_this_url; ?>">
  <meta property="og:locale" content="ja_JP">
  <meta property="og:title" content="<?php echo $fv_pagetitle; ?>">
  <?php if ($fv_description) : ?>
    <meta property="og:description" content="<?php echo $fv_description; ?>">
  <?php endif; ?>
  <meta property="og:type" content="<?php
                                    if (is_front_page()) : // トップページ
                                      echo 'website';
                                    else :
                                      echo 'article';
                                    endif;  ?>">
  <meta property="og:image" content="<?php echo $ogimage; ?>">
  <meta property="og:project_name" content="<?php echo $fv_sitename ?>">
  <meta property="og:url" content="<?php echo $fv_this_url ?>">
  <?php if(is_archive() || is_home()) : ?>
  <link rel="canonical" href="<?php echo $fv_this_url ?>">
  <?php endif; ?>
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css" as="style" />

  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/main.css' ); ?>" />
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/main-minMD.css' ); ?>" media="(min-width:768px)" />
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/main-minLG.css' ); ?>" media="(min-width:1024px)" />

  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/print.css' ); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Noto+Sans+JP:wght@400;500;700&display=swap"
    rel="stylesheet"
    media="print"
    onload="this.media='all'"
  />
  <?php if( is_404() ): ?>
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/template.css' ); ?>">
  <?php endif; ?>
  <link rel="stylesheet" href="https://use.typekit.net/giu1yqj.css">
  <?php if( is_page('thanks') ): ?>
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/Vendor/page-thanks.css' ); ?>">
  <?php endif; ?>
  <?php if(is_single()): ?>
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/wp-editor.css' ); ?>">
  <?php endif; ?>
  <script>
    document.documentElement.classList.add('js');
    document.documentElement.classList.remove('no-js');
  </script>
  <?php wp_head(); ?>

    <?php /*

    \ \ \ GTM / / /

    */ ?>

</head>

<body class="<?php if(get_field("acf_body_add_class")) echo get_field("acf_body_add_class"); ?>">
  <div id="body" class="l-body<?php global $l_body__2col; if($l_body__2col) echo ' l-body--2col'; ?>">
    <div id="body-header" class="l-body__header" data-component="header">
      <header id="header" data-view-over="header" class="l-header">
        <div class="l-header__main">
          <div class="l-header-base">
            <<?php echo $h1home; ?> class="l-header-base__logo"><a class="" href="<?php echo home_url(); ?>/">
              
            </a></<?php echo $h1home; ?>>
          </div>
        </div>
      </header>
  </div><!-- /#header -->

    <?php if(!is_front_page()): ?>
    <div id="hero" class="l-hero" data-component="hero" data-view-over="header">
      <?php
      global $post, $hero_main, $hero_sub, $hero_image;
      // $hero_main
      if(get_field('acf_page_hero_main')){
        $hero_main = get_field('acf_page_hero_main');
      }elseif($hero_main === null){
        $hero_main = get_the_title();
      }

      // $hero_sub
      if(get_field('acf_page_hero_sub')){
        $hero_sub = get_field('acf_page_hero_sub');
      }elseif($hero_sub === null){
        $slug = $post->post_name;
        $hero_sub = $slug;
      }

      if(get_field('acf_page_hero_image')){
        $hero_image = get_field('acf_page_hero_image');
      }elseif($hero_image === null){
        $hero_image = 'hero-default';
      }
      ?>
      <div class="l-hero__inner">
        <h1 id="hero-main" class="l-hero__main"><?php echo $hero_main; ?></h1>
        <div id="hero-sub" class="l-hero__sub"><?php echo $hero_sub; ?></div>
      </div>
      <div id="hero-page-bgImage" class="l-hero__bg">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero/<?php echo $hero_image; ?>.jpg"
          srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero/<?php echo $hero_image; ?>.jpg 1500w,
                  <?php echo get_template_directory_uri(); ?>/assets/images/hero/<?php echo $hero_image; ?>@2x.jpg 3000w"
                  sizes="(min-width: 684px) 1500px, 100%" width="1500" height="300" class="l-hero__bg-img" alt="">
      </div>
    </div>
    <?php endif; ?>

    <div id="body-container" class="l-body__container" data-component="container">
      <div id="body-main" class="l-body__main" data-component="main">
