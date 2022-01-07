<?php
get_header();
?>

<div class="c-wp-template">
  <div class="c-wp-template-header">
    <h2>Not Found</h2>
    <p>存在しないページです</p>
  </div>

  <p class="c-wp-template-textarea">アクセスしようとしたページは上記の理由で表示できませんでした。</p>

  <a href="<?php echo home_url(); ?>" class="c-wp-template-btn  c-wp-template-btn--start">トップページへ移動</a>
</div>

<?php
get_footer();
?>