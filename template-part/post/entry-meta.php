<div class="c-entry-meta">
  <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('boilerplate_author_bio_avatar_size', 40)); ?>
  <span class="entry-meta-author" itemprop="author" itemscope itemptype="https://schema.org/Person">By: <?php echo get_the_author(); ?></span>
  <span>Date: <time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time('d.m.Y'); ?></time></span>
  <span>Categories: <?php the_category(', '); ?></span>
</div> <!-- /entry-meta -->