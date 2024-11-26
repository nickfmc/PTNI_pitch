# v2.2.2
## 18-02-2020
1. [](#bugfix)
    * Remove deprecated Block Editor column classes

# v2.2.1
## 19-11-2019
1. [](#new)
    * Z-index utility classes (derived from z-index function)

# v2.2.0
## 19-11-2019
1. [](#improved)
    * Refactor editor wrapper (better alignfull / alignwide setup)
    * Tweak CSS for padded wrapper helper

# v2.1.2
## 7-11-2019
1. [](#improved)
    * Nav sass -- less nesting

# v2.1.1
## 30-10-2019
1. [](#improved)
    * Removed Updraft backup filters

# v2.1.0
## 26-10-2019
1. [](#improved)
    * Normalize images to all be dispay: block
    * Editor styles compile task now handles PostCSS usage (i.e. range media queries)
        -> This requires global install of PostCSS Preset Env

# v2.0.3
## 22-10-2019
1. [](#new)
    * Webpack setup and package updates
2. [](#improved)
    * Put back editor title

# v2.0.2
## 15-10-2019
1. [](#bugfix)
    * Webpack setup update for new version of Sass importer

# v2.0.1
## 29-09-2019
1. [](#improved)
    * Less opinionated wrapper and block padding/margin

# v2.0.0
## 12-08-2019
1. [](#new)
    * Globbing is back baby!

# v1.9.7
## 29-07-2019
1. [](#bugfix)
    * Fix modal menu esc key back button issue

# v1.9.6
## 25-07-2019
1. [](#improved)
    * Better padded wrapper utility
    * Tweak blockquote default styling

# v1.9.4
## 15-07-2019
1. [](#improved)
    * Remove a few more container references

# v1.9.3
## 4-07-2019
1. [](#improved)
    * Default side padding at smaller viewports for Gutenberg blocks that aren't full width 

# v1.9.2
## 28-06-2019
1. [](#new)
    * Remove page name from editor screen (it makes no sense there!)

# v1.9.1
## 13-06-2019
1. [](#improved)
    * List (ul) bullet styling
    * Blockquote default bg

# v1.9.0
## 3-06-2019
1. [](#new)
    * Rename object class names

# v1.8.3
## 27-05-2019
1. [](#bugfix)
    * Path wrong for template parts

# v1.8.2
## 13-05-2019
1. [](#bugfix)
    * Renamed modal script
    * Login filter

# v1.8.1
## 10-05-2019
1. [](#new)
    * Basic support for Gberg columns
2. [](#improved)
    * Replace lity with magnific

# v1.8.0
## 2-05-2019
1. [](#new)
    * Colour variant naming with numbers

# v1.7.0
## 18-04-2019
1. [](#new)
    * Add CSS minification to Webpack 
2. [](#improved)
    * Tweak Webpack PostCSS setup

# v1.6.1
## 18-03-2019
1. [](#new)
    * Removed various `:visited` link styling. Things may get weird.
2. [](#improved)
    * Variables for logo and page header size
    * Absolute positioning for logo and nav
    * Custom block colours

# v1.6.0
## 16-03-2019
1. [](#new)
    * Added sample code for adding block style options + removing included styles
    * Removed shortcodes include -- who needs them anymore?
    * Removed AiO Migration settings stuff. Plugin no good, not using.

# v1.5.3
## 15-03-2019
1. [](#improved)
    * Better (or so I think) 404 page

# v1.5.2
## 14-03-2019
1. [](#new)
    * Mobile nav menu
2. [](#improved)
    * Cleaned out functions doing stuff WP does (similarly) by default now

# v1.5.1
## 6-03-2019
1. [](#new)
    * Add narrow container object

# v1.5.0
## 1-03-2019
1. [](#new)
    * Package updates
2. [](#improved)
    * More line tightening

# v1.4.8
## 26-02-2019
1. [](#improved)
    * Block editor ready blockquote
    * Tighten things up a bit (line breaks / spacing)

# v1.4.7
## 23-02-2019
1. [](#improved)
    * Better comments on things
2. [](#bugfix)
    * Clearfix actually works now

# v1.4.6
## 19-02-2019
1. [](#new)
    * Added block editor support for custom taxonomies

# v1.4.5
## 14-02-2019
1. [](#new)
    * Folder setup for custom blocks
    * More helper mixins (because they are awesome!)
2. [](#improved)
    * Base heading setup

# v1.4.4
## 14-02-2019
1. [](#new)
    * Full width template (replacing custom page template)
2. [](#improved)
    * Naming stuff better
    * Misc little tweaks

# v1.4.3
## 12-02-2019
1. [](#improved)
    * VS Code tasks update (for running Dart Sass CLI)
    * Link to BEMIT info in tips
2. [](#bugfix)
    * Add clearfix class -- it went missing who knows when

# v1.4.2
## 8-02-2019
1. [](#improved)
    * Some better naming of Gutenberg (block editor) stuff

# v1.4.1
## 6-02-2019
1. [](#bugfix)
    * Remove wrapper class on containers with editor-content
    * Modal menu overflow stuck on

# v1.4.0
## 5-02-2019
1. [](#new)
    * Initial block editor columns support (WIP)
2. [](#improved)
    * Support for fullwidth blocks without hacks

# v1.3.9
## 24-01-2019
1. [](#new)
    * Default styles for table blocks (WIP)
2. [](#improved)
    * Cleaned up custom WP admin functions 

# v1.3.8
## 21-01-2019
1. [](#improved)
    * A few colour changes and stuff
2. [](#bugfix)
    * Glitch when anchor/hash links used with modal nav custom script

# v1.3.7
## 16-01-2019

1. [](#improved)
    * Remove scroll bars on fullwidth blocks on Windows (using a hack)
2. [](#bugfix)
    * Grid mixin missing parent class

# v1.3.6
## 14-01-2019

1. [](#bugfix)
    * Proper support for block editor fullwidth blocks
    * Touch nav class name issues

# v1.3.5
## 4-01-2019

1. [](#new)
    * Colour utilities, because that might be a good idea. Maybe.
2. [](#improved)
    * Better dropdown transition
3. [](#bugfix)
    * Flexbox powered lists just not working out, back to text-indent

# v1.3.4
## 13-12-2018

1. [](#improved)
    * Various small tweaks

# v1.3.3
## 9-12-2018

1. [](#new)
    * Added changelog (removed from readme)
2. [](#improved)
    * Webpack setup streamlined (no most postcss config file)
    * More / better utilities classes
3. [](#bugfix)
    * Media query ranges parsing

## v1.3.2
* fix list item flex bug (child elements went funky)

## v1.3.1
* various tweaks (HTML comments, screenshot, misc)

## v1.3.0
* switch to Dart Sass
* change media queries to range syntax (CSS4)
* remove media query mixin

## v1.2.6
* improve default modal navigation icons / styles
* remove site title (h1) tags on various pages
* move navigation (main, tertiary, modal) into main header wrapper

## v1.2.5
* support for latest way to style Gutenberg editor area

## v1.2.4
* comments clean up
* disable BrowserSync notify pop-up

## v1.2.3
* tweak default styles for headroom.js
* remove bg on GDT icons

## v1.2.2
* Gutenberg editor width fix
* Add support for excluding key folders / files with All in One Migration

## v1.2.1
* add headroom.js setup (commented out)
* minor tweaks
* package updates

## v1.2.0
* remove footer menu location
* widgetize footer area

## v1.1.5
* Major GDT branding update, courtesy of [MAW](https://mountainairweb.com)
* A few other tweaks/fixes

## v1.1.4
* Bug fixes + tweaks

## v1.1.3
* WP comments style and code updates
* improve object/component documentation
* remove < IE11 warning, honestly who is using IE9/10!?

## v1.1.2
* Font property added to body + headings

## v1.1.1
* Minor branding revamping
* Bug fixes + tweaks

## v1.1.0
* Fluid sizing mixin (now using to replace fluid type mixin for base font sizes)

## v1.0.1
* HTTPS support for BrowerSync (assuming you set up local SSL properly)

## v1.0.0
* GDT is 1.0.

## v0.1.0
* guten time...
* multiple webpack entry points

## v0.0.6
* root fluid responsive typography for small screens
* fluid typography mixin

## v0.0.5
* major class renaming (c- for components)
* utility building
* grid mixin stuff

## v0.0.4
* renaming classes
* objectify stuff

## v0.0.3
* sass reignition (file and folder re-org)
* tweak stuff

## v0.0.2
* webpack setup

## v0.0.1
* initial commit
