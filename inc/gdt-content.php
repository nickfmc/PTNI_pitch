<?php
/**
 * CONTENTS
 *
 * CONTENT RELATED FUNCTIONS AND FIXES ------
 * Excerpt clean up.................custom excerpt length and remove read more link
 * Excerpt functions................on the fly (multiple) custom excerpt length
 * Custom title length..............display but crop title after XX chars
 * Responsive video.................add wrapper class to enable responsive video
 * Widget area......................setup widgetized areas
 * Better body classes..............default WP body classes suck
 */


/*------------------------------------*\
    CONTENT FUNCTIONS AND FIXES
\*------------------------------------*/


// custom excerpt length **************
function gdt_custom_excerpt_length($length)
{
  return 66;
}
add_filter('excerpt_length', 'gdt_custom_excerpt_length', 999);


// This removes the annoying [...] to a Read More link
function gdt_excerpt_more($more)
{
  global $post;
  // Check if $post is not null
  if($post) {
    // edit here if you like
    return '...  <a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="Read ' . get_the_title($post->ID) . '"><span>Read more &raquo;</span></a>';
  } else {
    // Return default more text
    return $more;
  }
}


// ********** FlexDev custom WP excerpt length *********************
// TIP: excerpt value must be less than gdt_custom_excerpt_length
// USAGE: echo gdt_excerpt(25);
function gdt_excerpt($charLimit)
{
  $excerptString = explode(' ', get_the_excerpt(), $charLimit);
  if (count($excerptString) >= $charLimit) {
    array_pop($excerptString);
    $excerptString = implode(" ", $excerptString) . '[...]';
  } else {
    $excerptString = implode(" ", $excerptString);
  }
  $excerptString = preg_replace('`\[[^\]]*\]`', '', $excerptString);
  return $excerptString;
}



// ********** FlexDev custom CONTENT excerpt length ********************
// USAGE: echo gdt_content_excerpt(25);
function gdt_content_excerpt( $charLimit )
{
  $excerpt = strip_tags( get_the_content() );
  $charLimit++;
  $excerpt = preg_replace('/\[[^\]]+\]/', '', $excerpt);
  if (strlen($excerpt) > $charLimit) {
    $subex = substr($excerpt, 0, $charLimit - 5);
    $exwords = explode(" ", $subex);
    $excut = -(strlen($exwords[count($exwords) - 1]));
    if ($excut < 0) {
      $excerptString = substr($subex, 0, $excut);
    } else {
      $excerptString = $subex;
    }
    $excerptString .= "[...]";
  } else {
    $excerptString = $excerpt;
  }
  return $excerptString;
}


// ************ CUSTOM TITLE LENGTH *********************
/* usage: <?php echo title_crop(55); ?> */
function title_crop($count)
{
  $title = get_the_title();
  if (strlen($title) > $count) {
    $title = substr($title, 0, $count) . '...';
  }
  return $title;
}



// Make Read More link go to top of page (not an anchor link)
function remove_more_jump_link($link)
{
  $offset = strpos($link, '#more-');
  if ($offset) {
    $end = strpos($link, '"', $offset);
  }
  if ($end) {
    $link = substr_replace($link, '', $offset, $end - $offset);
  }
  return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');



/************ RESPONSIVE VIDEOS *******************/
add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id)
{
  return '<div class="embed-responsive  ut-aspect-16x9">' . $html . '</div>';
}




/************* WIDGETIZED AREAS ********************/

// Widgetizes Areas
function gdt_register_sidebars()
{
  register_sidebar(array(
    'id' => 'sidebar',
    'name' => 'Sidebar',
    'description' => 'The primary sidebar.',
    'before_widget' => '<div id="%1$s" class="widget  clearfix  %2$s"><div class="widget-wrap">',
    'after_widget' => '</div></div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-1',
    'name' => 'Footer - Column 1',
    'description' => 'First footer column.',
    'before_widget' => '<div id="%1$s" class="widget  clearfix  %2$s"><div class="widget-wrap">',
    'after_widget' => '</div></div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-2',
    'name' => 'Footer - Column 2',
    'description' => 'Second footer column.',
    'before_widget' => '<div id="%1$s" class="widget  clearfix  %2$s"><div class="widget-wrap">',
    'after_widget' => '</div></div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  // register_sidebar(array(
  //  'id' => 'sidebar-home',
  //  'name' => 'Home Sidebar',
  //  'description' => 'The sidebar on the home page.',
  //  'before_widget' => '<div id="%1$s" class="widget  clearfix  %2$s"><div class="widget-wrap">',
  //  'after_widget' => '</div></div>',
  //  'before_title' => '<h4 class="widgettitle">',
  //  'a
  //  fter_title' => '</h4>',
  // ));

} // don't remove this bracket!



// page template name body class - removes the stuff before and the .php after the template name
function gdt_better_page_template_body_classes($classes)
{
  if (is_page()) {
    $template = get_page_template_slug(); // returns an empty string if it's loading the default template (page.php)
    if ($template === '') {
      $classes[] = 'default-page';
    } else {
      $classes[] = sanitize_html_class(str_replace('.php', '', $template));
    }
  }
  return $classes;
}
add_filter('body_class', 'gdt_better_page_template_body_classes');


// add on some nice body class names
function pretty_body_class()
{
  $term = get_queried_object();

  if (is_single()) {
    $cat = get_the_category();
  }

  if (!empty($cat)) {
    return $cat[0]->slug;
  } elseif (isset($term->slug)) {
    return $term->slug;
  } elseif (isset($term->post_name)) {
    return $term->post_name;
  } else {
    return;
  }
}


?>
