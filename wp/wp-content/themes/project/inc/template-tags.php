<?php 

// 投稿内の最初の画像取得
// function first_image() {
//     global $post, $posts;
//     $first_img = '';
//     ob_start();
//     ob_end_clean();
//     preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
//     $first_img = $matches[1][0];
//     if(empty($first_img)){
//         $first_img = '';
//     }
//     return $first_img;
// }