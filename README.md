# LaunchPad: Ready for takeoff

Get ready to launch into Full Site Editing with style. Credit goes to Trevor Robertson(CreativeLogic) and to Eddie Machado who created the [Bones Theme](https://themble.com/bones/), which provided the inspiration and original structure of this theme years ago.

## THEME SETUP
* This theme uses the new theme.json setup, start here and setup your theme defualts.
* Hop over to variables.scss and match up your layout widths and colors etc.
* gdt-plugins in Functions.php is there to make some plugin installs faster, you can comment it out once you setup your theme, no reason to leave that in there for a live site unless you want to just leave in the REQUIRE ACF message when someone deactives it.


## DETAILS & TIPS
* Custom ACF blocks are registerd in gdt-gutenberg.php and managed in template-part/block/blockname 
* Theme supports Toolset blocks and WP Stackable blocks.

## TO DO
* nothing...

## KNOWN ISSUES
* Gutenberg defualt blocks are pushing towards an "inner block inherit width" setting which is not what most 3rd party plugins are using so our block-dufualts.scss is complex to accomodate the best nesting of blocks I could manage.

## SOURCES & REFERENCE
* 


## Project Setup
* Theme has now been converted to use [Prepros.io](https://prepros.io/), for ease of setup. Config file is ready to use. Just edit the server -> External Server and update it to your dev URL. and you can get going.