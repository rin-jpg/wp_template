<?php
  $l_body__2col = true;
  $this_post_type = get_post_type();
  $hero_main = esc_html(get_post_type_object(get_post_type())->label);
  $hero_sub = esc_html(get_post_type_object(get_post_type())->name);
  $hero_image = 'hero-news';

  $data = []; // タクソノミー格納用配列
  $data[ 'taxonomy_name' ] = 'category_' . $this_post_type; // タクソノミースラッグ
  $data[ 'terms' ] = get_the_terms( get_the_ID(), $data[ 'taxonomy_name' ] );
  $data[ 'term_list' ] = '';

  $fv_pagetitle = esc_html(get_the_title()) . '｜' . esc_html(get_post_type_object(get_post_type())->label);
  get_header();
?>



<?php
  get_footer();
?>
