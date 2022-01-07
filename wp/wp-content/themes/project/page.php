<?php
/*
Template Name: 静的ページ
*/
get_header();
wp_head();

while (have_posts()) : the_post();
remove_filter('the_content', 'wpautop');
the_content();
endwhile;

wp_footer();
get_footer();
