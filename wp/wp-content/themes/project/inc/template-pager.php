<?php

/**
 * 前後ページャー
 */

function prev_html(){
$root_assets = get_template_directory_uri();
$prev_post = get_previous_post();
$prev_post_link = get_permalink( $prev_post->ID );
$prev_html = <<< EOM
  <a href="{$prev_post_link}" class="p-pager-zengo__arrowBtn">
    <svg width="16" height="16" class="c-icon" aria-hidden="true"><use xlink:href="{$root_assets}/assets/svg/sprite.svg#i-angle-left"></use></svg>
  </a>
EOM;
  if (get_previous_post()):
      echo $prev_html;
  endif;
}

function next_html(){
$root_assets = get_template_directory_uri();
$next_post = get_next_post();
$next_post_link = get_permalink( $next_post->ID );
$next_html = <<< EOM
  <a href="{$next_post_link}" class="p-pager-zengo__arrowBtn">
    <svg width="16" height="16" class="c-icon" aria-hidden="true"><use xlink:href="{$root_assets}/assets/svg/sprite.svg#i-angle-right"></use></svg>
  </a>
EOM;
if (get_next_post()):
    echo $next_html;
endif;
}


/**
 * 連番ページャー
 */

function pager_num_list(){
  global $wp_query, $paged;

  $end_size = 1;
  $mid_size = 2;
  $show_all = false; // 全てのページ番号リストを表示するか
  $posts_per_page = get_query_var('posts_per_page'); // 1ページあたりの件数
  $current_paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1; // 現在のページ番号取得
  $total_paged = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1; // 全ページ数
  $total_posts = $wp_query->found_posts; // 全記事件数


  $is_prev_paged = false; // 前が存在するか
  $is_next_paged = false; // 次が存在するか

  // ページが2未満の場合はページャーを出力しない
  if ( $total_paged < 2 ) return false;


  /*
  * 前後
  */

  // 前のリンク取得
  $prev_html = <<< EOM
  <a class="p-btn-zengo is-desabled">
    <span class="u-size12 u-700 u-family-sans u-uppercase">←</span>
  </a>
EOM;

  if ( $current_paged > 1 ) :
    $is_prev_paged = true;
    $prev_link = esc_url( get_pagenum_link( $current_paged - 1 ) );
    $prev_paged_count = $posts_per_page; // 前のページに何件表示できるか
    $prev_html = <<< EOM
    <a href="{$prev_link}" data-count="{$prev_paged_count}" class="p-btn-zengo">
      <span class="u-size12 u-700 u-family-sans u-uppercase">←</span>
    </a>
EOM;
  endif;


  // 次のリンク取得
  $next_html = <<< EOM
  <a class="p-btn-zengo is-desabled">
    <span class="u-size12 u-700 u-family-sans u-uppercase">→</span>
  </a>
EOM;

  if ( $current_paged < $total_paged ) :
    $is_next_paged = true;
    $next_link = esc_url( get_pagenum_link( $current_paged + 1 ) );
    $next_paged_count = $current_paged === $total_paged - 1 ? ( $total_posts - $posts_per_page ) % $posts_per_page : $posts_per_page; // 前のページに何件表示できるか

    if ( $next_paged_count <= 0 ) :
      $next_paged_count = $posts_per_page;
    endif;

    $next_html = <<< EOM
    <a href="{$next_link}'" data-count="{$next_paged_count}'" class="p-btn-zengo">
      <span class="u-size12 u-700 u-family-sans u-uppercase">→</span>
    </a>
EOM;
  endif;


 /*
  * 連番処理
  */

//   $flag_dots = false;

//   // ページャーの大枠
//   $formats_pager = <<<EOM
//   <div class="p-pager__numbers M:u-pl40 M:u-pr40 u-w-12 M:u-w-auto u-pb20 M:u-pb0 u-pl5 u-pr5">
//     <ul class="c-flex c-flex--x5 c-flex--y5 M:c-flex--x10 M:c-flex--y10 u-items-center u-justify-center c-list">%1\$s</ul>
//   </div>
//   <div class="p-pager__zengo u-w-6 M:u-w-auto M:u-order-_1 u-items-center">%2\$s</div>
//   <div class="p-pager__zengo u-w-6 M:u-w-auto u-items-center">%3\$s</div>
// EOM;

//   // カレントページャー
//   $formats_list_current = <<<EOM
// <li class="u-w-auto" aria-current="%2\$s"><span class="p-pager-btn-number js-ignore is-current">%1\$s</span></li>
// EOM;

//   // ドット
//   $formats_list_dots = <<<EOM
// <li class="u-w-auto u-_ml5 u-_mr5 p-pager-dots"><span>・・・・</span></li>
// EOM;

// $formats_pager_prev_html = $prev_html;
// $formats_pager_next_html = $next_html;

// $lists = []; // liを格納するための配列

// for ( $n = 1; $n <= $total_paged; $n++ ) {
//   if ($n == $current_paged) {
//     // カレント: フォーマットを元に整形
//     $lists[] = sprintf(
//       $formats_list_current,
//       number_format_i18n( $n ),
//       esc_attr( 'page' )
//     );

//     $flag_dots = true;

//   } else {
//     if ( $show_all || ($n <= $end_size || ($current_paged && $n >= $current_paged - $mid_size && $n <= $current_paged + $mid_size) || $n > $total_paged - $end_size)) {
//       $link = get_pagenum_link($n);

//       // デフォルト: フォーマットを元に整形
//       $lists[] = sprintf(
//         $formats_list_default = <<<EOM
//         <li class="u-w-auto"><a href="%2\$s" class="p-pager-btn-number">%1\$s</a></li>
// EOM,
//         number_format_i18n( $n ),
//         esc_url( apply_filters( 'paginate_links', $link ) )
//       );

//       $flag_dots = true;

//     } elseif ( $flag_dots && !$show_all ) {

//       // 省略文字列
//       $lists[] = $formats_list_dots;

//       $flag_dots = false;
//     }
//   }
// }

// $html = sprintf(
//   $formats_pager, // ul（ラッパー）
//   implode("\n\t", $lists), // li
//   $formats_pager_prev_html, // 前リンク
//   $formats_pager_next_html, // 後リンク
// );

// echo $html;

}
