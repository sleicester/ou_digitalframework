<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?> <?php print $attributes;?>">
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>

<div id="int-site">
     <script type="text/javascript" src="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/js/ou-df-header.js"></script>
      <script type="text/javascript">if (typeof window.ou_sitestat=='function')ou_sitestat();</script>
      <script type="text/javascript" src="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/js/ou-cookie-policy.js"></script>

	    <link rel="stylesheet" href="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/css/header.css">
      <link rel="stylesheet" href="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/css/footer.css">
      <link rel="stylesheet" href="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/css/ou-df-header.css">

      <!--[if lt IE 8]>
            <link  rel="stylesheet" href="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/css/ie.css">
      <![endif]-->

      <!--[if IE 7]>
            <link  rel="stylesheet" href="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/fonts/fontawesome/css/font-awesome-ie7.css">
      <![endif]-->

        <div id="int-ouHeader" role="banner">

            <!--Header -->
            <div id="int-header">
                <a href="#int-content" class="btn-skip">
                    <i class="int-icon int-icon-chevron-down"></i>
                    <span> Skip to content</span>
                </a>
                <a class="int-ouLogo" href="http://www.open.ac.uk/">
                    <img src="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/img/ou-logo.png" alt="The Open University" />
                </a>
                <div role="navigation" id="int-serviceLinks" class="int-serviceLinks sg-responsive int-container">
                    <ul>
                        <li class="ou-role-signin" id="ou-signin1">
                            <a href="https://msds.open.ac.uk/signon/sams001.aspx" id="ou-signin2">Sign in</a> <span>|</span>
                        </li>
                        <li>
                            <a href="#">My account</a> <span></span>
                        </li>
                        <li id="ou-signout" class="ou-role-signout">
                            <a href="https://msds.open.ac.uk/signon/samsoff.aspx" id="ou-signout2">Sign out</a> <span>|</span>
                        </li>
                        <li>
                            <a href="http://www.open.ac.uk/contact">Contact us</a> <span>|</span>
                        </li>
                        <li id="ou-studenthome" class="ou-role-studenthome">
                            <a href="http://www.open.ac.uk/students/" id="ou-studenthome2">Current students</a>
                        </li>
                        <li class="int-headerSearch">
                            <div class="int-inputAppend">
                                <label for="headerSearch" class="int-hide">Search</label>
                                <input id="headerSearch" type="search" placeholder="Search..."/>
                                <a id="headerSearchButton" href="#" onclick="javascript:ou_search();" class="int-button" role="button">Search</a>
                            </div>
                        </li>
                    </ul>
                    <a href="#" class="int-mob-menu-toggle">
                        <span>Menu title</span>
                        <i class="int-icon int-icon-chevron-down"></i>
                        <i class="int-icon int-icon-chevron-up"></i>
                    </a>
                </div>
            </div>
            <!--end of Header -->

            <div id="int-nav-mobile" class="int-nav-alt-mob">
                <div class="int-nav-mob-overlay"></div>
                <div class="int-nav-alt-primary"></div>
                <a href="#" id="int-nav-toggle" class="int-nav-toggle">
                    <i class="int-icon int-icon-bars int-icon-lg"></i>
                    <i class="int-icon int-icon-times int-icon-lg"></i>
                </a>
            </div>
        </div>


  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>

  <?php include $filepath.theme_get_setting('ou_df_path_to_footer') ; ?>
</div>

  <script src="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/js/vendor/jquery-1.10.2.min.js"></script>
  <script> var $j = jQuery.noConflict();</script>
  <script src="http://www-dev.open.ac.uk/oudigital/headers-footers/assets/js/modules/global.primarynavigation_1.js"></script>


    <script type="text/javascript">
        //Function that has to be called on the page to initialise the nav
        (function($j, window){

            window.OU.PrimaryNavigation = new window.OU.DigitalFramework.Global.PrimaryNavigation({
                activeItem: true //Set to true to initialise the nav item using js
            });

        })(jQuery, window);
    </script>

     <script type="text/javascript">if (typeof window.ou_init=='function')ou_init();</script>
  	<script>jQuery.noConflict(true);</script>




</body>
</html>
