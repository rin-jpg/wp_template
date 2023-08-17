<div class="l-breadcrumbs">
  <div class="l-breadcrumbs__inner">
    <ul class="l-breadcrumbs__lists c-list">
      <li class="l-breadcrumbs__list">
        <a href="<?php echo home_url(); ?>/" class="l-breadcrumbs__link">
          <span class="l-breadcrumbs__link-label">ホーム</span>
        </a>
      </li>
      <?php
        $post_name = 'お知らせ';
        if ( is_front_page() ) {

        } else if ( is_category() ) {
          $cat = get_queried_object();
          $cat_id = $cat->parent;
          $cat_list = array();
          while($cat_id != 0) {
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li class="l-breadcrumbs__list"><a href="' . $cat_link . '" class="l-breadcrumbs__link">' . $cat->name . '</a></li>' );
            $cat_id = $cat->parent;
          }
          echo '<li class="l-breadcrumbs__list"><a href="' . home_url() . '/news/" class="l-breadcrumbs__link">' . $post_name . '</a></li>';
          foreach ($cat_list as $value) {
            echo $value;
          }
          the_archive_title('<li class="l-breadcrumbs__list"><span class="l-breadcrumbs__link">', '</span></li>');
        } else if ( is_archive() ) {
          echo '<li class="l-breadcrumbs__list"><a href="' . home_url() . '/news/" class="l-breadcrumbs__link">' . $post_name . '</a></li>';
          the_archive_title('<li class="l-breadcrumbs__list"><span class="l-breadcrumbs__link">', '</span></li>');
        } else if ( is_single() ) {
          $cat = get_the_category();
          if( isset( $cat[0]->cat_ID ) ) $cat_id = $cat[0]->cat_ID;
          echo '<li class="l-breadcrumbs__list"><a href="' . home_url() . '/news/" class="l-breadcrumbs__link">' . $post_name . '</a></li>';
          the_title('<li class="l-breadcrumbs__list"><span class="l-breadcrumbs__link">', '</span></li>');
        } else if ( is_page() ) {
          the_title('<li class="l-breadcrumbs__list"><span class="l-breadcrumbs__link">', '</span></li>');
        } else if ( is_search() ) {
          echo '<li class="l-breadcrumbs__list"><span class="l-breadcrumbs__link">「' . get_search_query() . '」の検索結果</span></li>';
        } else if ( is_404() ) {
          echo '<li class="l-breadcrumbs__list"><span class="l-breadcrumbs__link">ページが見つかりません</span></li>';
        } else if ( is_home() ){
          echo '<li class="l-breadcrumbs__list"><span class="l-breadcrumbs__link">' . $post_name . '</span></li>';
        }
      ?>
    </ul>
  </div>
</div>
