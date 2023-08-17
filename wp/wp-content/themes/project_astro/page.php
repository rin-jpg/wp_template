<?php
$slug = $post->post_name;
$hero_main = get_the_title();
$hero_sub = $slug;
if(get_field('acf_page_title')){
  $fv_pagetitle = get_field('acf_page_title');
}else{
  $fv_pagetitle = get_the_title(); // ページタイトル
}
get_header();

while (have_posts()) : the_post();
the_content();
endwhile;

get_footer();
