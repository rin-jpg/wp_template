</div><!-- /#main -->
<?php
  global $l_body__2col;
  if($l_body__2col){
    get_sidebar();
  }
  ?>
</div><!-- /#container -->

<div id="body-footer" class="l-body__footer" data-component="footer">
  <div id="footer" data-view-over="footer" class="l-footer">

  </div><!-- /#footer -->
</div>
</div><!-- /#body -->

<div data-logic="drawer-close" class="l-drawer-overlay"></div>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.runtime.bundle.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.bundle.js"></script>
<?php if(is_page('contact')): ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/yubinbango.js"></script>
<?php endif; ?>
<?php echo fv_get_add_field('js') . "\n"; ?>
<?php wp_footer(); ?>
</body>
</html>
