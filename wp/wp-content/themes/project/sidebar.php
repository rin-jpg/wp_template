<div id="side" class="l-side" data-component="side">
  <div id="side-inner" class="l-side__inner">

    <div class="l-sidebar">
      <nav class="c-mb30">
        <div class="M:u-mb80 u-mb60">
          <h2>カテゴリー</h2>
          <ul>
          <li><a href="<?php echo home_url(); ?>/blog/" class="c-hover-underline-less">すべて<svg width="20" height="20" class="c-icon" aria-hidden="true"><use xlink:href="#i-circle-right"></use></svg></a></li>
            <?php
              $cats = get_categories();
              foreach($cats as $cat) {
                echo '<li><a href="' . get_category_link($cat->term_id) . '" class="c-hover-underline-less">' . esc_html($cat->name) . '<svg width="20" height="20" class="c-icon" aria-hidden="true"><use xlink:href="#i-circle-right"></use></svg></a></li>';
              }
            ?>
          </ul>
        </div>
        <div>
          <h2 class="u-mb30">アーカイブ</h2>
          <span class="c-selectbox">
            <select name="" id="" onChange='document.location.href=this.options[this.selectedIndex].value;'>
              <option value="">年を選択</option>
              <?php wp_get_archives (array(
                  'type' => 'yearly',
                  'format' => 'option',
                  'show_post_count' => '1'
                  ));
              ?>
            </select>
          </span>
        </div>

      </nav>
    </div>
  </div>
</div>
