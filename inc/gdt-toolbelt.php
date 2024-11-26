<?php

/**
 * Collection of misc functions that are "core" like, but not in core. 
 * They help you out, but don't apply elsewhere in the theme files.
 */


// *************** DETETERMINE IF A PAGE IS WITHIN A TREE ********************
function is_tree($pid)
{      // $pid = The ID of the page we're looking for pages underneath
  global $post;          // load details about this page
  if (is_page($pid))
    return true;        // we're at the page or at a sub page
  $anc = get_post_ancestors($post->ID);
  foreach ($anc as $ancestor) {
    if (is_page() && $ancestor == $pid) {
      return true;
    }
  }
  return false;          // we aren't at the page, and the page is not an ancestor
}

// ************** CHECK IF PAGE HAS PARENT ****************
function page_has_parent()
{
  global $post;

  $children = get_pages('child_of=' . $post->ID);
  if (count($children) > 0) {
    $parent = true;
  }

  return $parent;
}

?>