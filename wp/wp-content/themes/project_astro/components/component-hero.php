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

<div data-view-over="header" class="l-hero">
  <div class="l-hero__container">
    <<?php echo $h1single; ?> class="l-hero-heading-main">
      <span class="l-hero-heading-main__label"><?php echo $hero_main; ?></span>
    </<?php echo $h1single; ?>>
    <p class="l-hero-heading-sub">
      <span class="l-hero-heading-sub__label"><?php echo $hero_sub; ?></span>
    </p>

    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/images/hero/<?php echo $hero_image; ?>.jpg"
      srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero/<?php echo $hero_image; ?>.jpg 1500w,
              <?php echo get_template_directory_uri(); ?>/assets/images/hero/<?php echo $hero_image; ?>@2x.jpg 3000w"
      sizes="(min-width:750px) 1500px 750px"
      width="1500"
      height="300"
      class="l-hero__bg"
      alt=""
    />
  </div>
</div>
