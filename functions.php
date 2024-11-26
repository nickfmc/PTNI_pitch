<?php
/*
Welcome to Launchpad Theme! This is where we include all the function files for FDT. 
Probably best to not edit anything in here.
 */

// ************* INCLUDE FUNCTION FILES ***************

// CORE FLEXDEV FUNCTIONS 
require_once('inc/gdt-cleanup.php'); // if you remove this the Internet blows up, just sayin'
require_once('inc/gdt-gutenberg.php'); // all the Gutenberg theme support and customizations
require_once('inc/gdt-enqueues.php'); // WP enqueues
require_once('inc/gdt-menus.php'); // declare and create menus / navigation
require_once('inc/gdt-content.php'); // functions that alter, edits, and assist with pure content (text mostly)
require_once('inc/gdt-images.php'); // images yo!
require_once('inc/gdt-toolbelt.php'); // those little tools to make your WP life easier

// FOR CREATING CPT / CUSTOM TAXONOMY
// require_once('inc/custom-post-type.php');  // you can disable this line if not using CPTs
// require_once('inc/custom-taxonomy.php');  // you can disable this line if not using Custom Taxonomy

// CUSTOMIZE THE WORDPRESS ADMIN
require_once('inc/admin.php'); // things that happen only in the admin

// CUSTOM FUNCTIONS FOR EACH WEBSITE
require_once('inc/gdt-custom.php'); // per project custom functions


/* DON'T DELETE THIS CLOSING TAG */ ?>
