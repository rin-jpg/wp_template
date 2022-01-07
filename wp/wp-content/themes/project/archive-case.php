<?php
  get_header();
?>

<main class="M:u-pt80 u-pt10 u-pb100">
  <?php if ( have_posts() ) : ?>
  <div class="c-container">
    <?php
      $cats = get_terms("category_case");
      if(!empty($cats)) :
    ?>
    <div class="p-case-cat js-accordion" data-mq="breakMd">
      <p class="p-case-cat__tit" data-accordion="accordion-trigger"><span>記事を探す</span></p>
      <div data-accordion="accordion-content">
        <ul>
          <?php
            foreach($cats as $cat) {
              echo '<li><a href="' . esc_url(get_term_link($cat->term_id, "category_case")) . '" class="c-hover-underline-less">' . esc_html( $cat->name ) . '</a></li>';
            }
          ?>
        </ul>
      </div>
    </div>
    <?php endif; ?>

    <h2 class="p-case__current-cat"><?php echo my_get_archive_title(); ?></h2>

    <div class="c-flex c-flex--y20 M:c-flex--x20">
      <?php while ( have_posts() ) : the_post(); ?>
      <article class="M:u-w-4 u-w-12 p-case-post">
        <a href="<?php the_permalink(); ?>" class="c-hover-underline-less">
        <figure class="c-object-fit-box u-borderRadius-30">
          <?php if(get_field("acf_post_thumb")) : ?>
            <img src="<?php echo my_get_retina_url('url') ?>"
              srcset="<?php echo my_get_retina_url('url') ?> <?php echo my_get_retina_url('w') ?>w, <?php echo my_get_retina_url('url', 'case_thumb@2x') ?> <?php echo my_get_retina_url('retina') ?>w"
              sizes="(min-width: <?php echo my_get_retina_url('half') ?>px) <?php echo my_get_retina_url('w') ?>px, 100vw"
              decoding="async" loading="lazy"
              width="<?php echo my_get_retina_url('w') ?>" height="<?php echo my_get_retina_url('h') ?>" alt="" class="c-object-fit-cover">
          <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimg-350x260.jpg"
              srcset="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimg-350x260.jpg 350w, <?php echo get_template_directory_uri(); ?>/assets/images/common/noimg-350x260@2x.jpg 700w"
              sizes="(min-width: 176px) 350px, 100vw"
              decoding="async" loading="lazy"
              width="350" height="260" alt="" class="c-object-fit-cover">
          <?php endif; ?>
          </figure>
          <h3><?php if(!empty($post->post_title)) :
                the_title();
              else :
                echo 'NO TITLE';
              endif; ?></h3>
          <p><?php the_excerpt(); ?></p>
          <ul>
            <?php
              $data = [];
              $data[ 'taxonomy_name' ] = 'category_case'; // タクソノミースラッグ
              $data[ 'terms' ] = get_the_terms( get_the_ID(), $data[ 'taxonomy_name' ] );
              $data[ 'term_list' ] = '';

              if ( $data[ 'terms' ] && !is_wp_error( $data[ 'terms' ] ) ) :
                foreach ($data[ 'terms' ] as $term) :
                  $data[ 'term_name' ] = esc_html( $term->name ); // ターム名
                  $data[ 'term_list' ] .= '<li>' . $data[ 'term_name' ] . '</li>';
                endforeach;
              else :

              endif;

              echo $data[ 'term_list' ];
            ?>
          </ul>
        </a>
      </article>
      <?php endwhile;?>
    </div>
  </div>

  <div class="p-pager u-mt100 c-flex M:u-wrap-no u-items-center u-justify-center M:u-pb50">
    <?php pager_num_list(); ?>
  </div>
  <?php else : ?>
    <div class="u-textcenter">
      <p>まだお届け事例がありません</p>
    </div>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
