<?php
/*
Template Name: 静的ページ
*/
get_header();

while (have_posts()) : the_post();
remove_filter('the_content', 'wpautop');
the_content();
endwhile;

get_footer();
