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
  $h1single = "h1";
  if(is_single()){
    $h1single = "div";
  }

  $body_slug = get_post_field( 'post_name', get_the_ID() );
  if (is_front_page()) {
    $body_slug = "front";
  }
?>
<!DOCTYPE html>
<html class="" lang="ja" prefix="og: http://ogp.me/ns#" data-root="<?php echo get_template_directory_uri(); ?>/" data-assets="<?php echo get_template_directory_uri(); ?>/assets/">

<head>
  <meta charset="UTF-8" />
  <title><?php echo $fv_pagetitle; ?></title>
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <?php if ($fv_description) : ?>
  <meta name="description" content="<?php echo $fv_description; ?>">
  <?php endif; ?>
  <?php echo meta_noindex(); ?>
  <?php if(is_archive() || is_home()) : ?>
  <link rel="canonical" href="<?php echo $fv_this_url ?>">
  <?php endif; ?>
  <meta name="author" content="<?php echo $fv_sitename ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="<?php echo $fv_this_url; ?>">
  <meta property="og:url" content="<?php echo $fv_this_url ?>">
  <meta property="og:locale" content="ja_JP">
  <meta property="og:title" content="<?php echo $fv_pagetitle; ?>">
  <meta property="og:type" content="<?php
                                    if (is_front_page()) : // トップページ
                                      echo 'website';
                                    else :
                                      echo 'article';
                                    endif;  ?>">
  <?php if ($fv_description) : ?>
  <meta property="og:description" content="<?php echo $fv_description; ?>">
  <?php endif; ?>
  <meta property="og:image" content="<?php echo $ogimage; ?>">
  <meta property="og:project_name" content="<?php echo $fv_sitename ?>">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">

  <link rel="preload" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/main.css' ); ?>" as="style" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
  <script>
    /* global WebFont */
    WebFont.load({
      google: {
        families: ['Noto+Sans+JP:400,500,700,900', 'Roboto+Condensed:400,700'],
      },
    })
  </script>
  <?php if( is_404() ): ?>
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/template.css' ); ?>">
  <?php endif; ?>
  <?php wp_head(); ?>

    <?php /*

    \ \ \ GTM / / /

    */ ?>
  <link rel="stylesheet" href="<?php echo fv_project_get_cache_clear_source_url( 'assets/css/main.css' ); ?>" />
  <script type="module" src="<?php echo get_template_directory_uri(); ?>/assets/js/main2.js"></script>
</head>

<body id="body" class="l-body <?php if(get_field("acf_body_add_class")) echo get_field("acf_body_add_class"); ?>" data-slug="<?php echo $body_slug ?>">
  <header role="banner" id="header" class="l-header l-body__header">
    <?php require_once( __DIR__ . '/components/component-header.php' ); ?>
    <?php
      if(!is_front_page()):
      require_once( __DIR__ . '/components/component-hero.php' );
      endif;
      ?>
  </header>


  <main id="main" role="main" class="l-body__main<?php global $l_body__2col; if($l_body__2col) echo ' l-body--in-sub'; ?>">
    <div class="l-body__content">
      <div class="l-body__content-main">
