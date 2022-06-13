<div id="body-side" class="l-body__side" data-component="side">
  <?php
    $this_post_type = get_post_type();
    $cat = 'category_' . $this_post_type;
    $terms = get_terms($cat);
    if( !empty($terms) && !is_wp_error($terms) ):
  ?>
  <div id="body-side-inner" class="l-body__side-inner">
    <aside class="l-sidebar">
      <header class="l-sidebar__header">
        <h3 class="l-sidebar__header-heading">カテゴリ</h3>
      </header>
      <ul class="c-list l-sidebar-nav">
        <?php
          $args = array(
            'title_li' => '',
            'taxonomy' => $cat,
          );
          wp_list_categories($args);
        ?>
      </ul>
    </aside>

    <aside class="l-sidebar">
      <header class="l-sidebar__header">
        <h3 class="l-sidebar__header-heading">アーカイブ</h3>
      </header>
      <span class="c-selectbox">
        <select name="archive" id="pulldown-archive" onchange="document.location.href=this.options[this.selectedIndex].value;">
          <option value="">月を選択</option>
          <?php wp_get_archives (array(
            'post_type' => $this_post_type,
            'format' => 'option',
            'show_post_count' => '1'
            ));
          ?>
        </select>
      </span>
    </aside>
  </div>
  <?php endif; ?>
</div>
