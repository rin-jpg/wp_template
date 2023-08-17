</div><!-- /.l-body__content-main -->
<?php
  global $l_body__2col;
  if($l_body__2col){
    get_sidebar();
  }
  ?>

</div><!-- /.l-body__content -->
</main><!-- /.l-body__main -->

<?php require_once( __DIR__ . '/components/component-footer.php' ); ?>

<?php if(is_page('contact')): ?>
<script>
  document.addEventListener('wpcf7mailsent', function(event) { // CF7コンバージョン
    location = '<?php echo home_url(); ?>/contact/thanks/';
  }, false);
</script>
<?php endif; ?>
<?php echo fv_get_add_field('js') . "\n"; ?>
<?php wp_footer(); ?>
</body>
</html>
