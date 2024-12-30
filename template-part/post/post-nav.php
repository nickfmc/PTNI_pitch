<nav class="c-post-nav" aria-label="<?php _e('Navigation des articles', 'flexdev'); ?>">
  <ul class="" role="list">
    <li class="post-nav-prev">
      <?php next_posts_link(
        sprintf(
          '<span aria-hidden="true">&laquo;</span> <span class="nav-text">%s</span>',
          __('Articles précédents', 'flexdev')
        )
      ); ?>
    </li>
    <li class="post-nav-next">
      <?php previous_posts_link(
        sprintf(
          '<span class="nav-text">%s</span> <span aria-hidden="true">&raquo;</span>',
          __('Articles suivants', 'flexdev')
        )
      ); ?>
    </li>
  </ul>
</nav> <!-- /post-nav -->
