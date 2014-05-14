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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?> >

<head profile="<?php print $grddl_profile; ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
 <?php $themePath = base_path().drupal_get_path('theme',$GLOBALS['theme']); ?>


    <!-- SC added from LA 11-4-2014 -->

<!--  <link rel="stylesheet" href="/oudigital/headerandfooter/assets/css/header.css">
  <link rel="stylesheet" href="/oudigital/headerandfooter/assets/css/footer.css">-->

  <link rel="stylesheet" href="/oudigital/headerandfooter/assets/css/headerandfooter.css">

  <link rel="stylesheet" href="/oudigital/headerandfooter/assets/css/ou-df-header.css">

  <!--[if lt IE 9]>
    <link  rel="stylesheet" href="/oudigital/headerandfooter/assets/css/headerandfooter-ie.css">
    <link rel="stylesheet" href="<?php print $themePath . '/css/custom/ie-style.css'?>">
  <![endif]--> <!--media queries support on IE8 and lower -->

  <!--[if lt IE 8]>
    <link  rel="stylesheet" href="/oudigital/eep/assets/css/ie.css">
  <![endif]-->

  <!--[if IE 7]>
    <link  rel="stylesheet" href="/oudigital/eep/assets/fonts/fontawesome/css/font-awesome-ie7.css">
  <![endif]-->


    <!--  End-->

  <?php
  global $language_content;
  if ($language_content->language == 'cy') {
    $currentLanguage = 'cymraeg';
  }
  else {
    $currentLanguage = 'english';
  }

// get current theme NAME
global $theme_key;
  ?>

</head>
<body  class="<?php print $theme_key; ?> <?php print theme_get_setting('ou_df_nation'); ?> <?php print $currentLanguage; ?> <?php print $classes; ?> " <?php print $attributes;?>>
<?php
/**
*
* @param
* $codes - array that contains the possiblke country & language combinations
* add / remove items in this array to change options
* using the format $codes['COUNTRYCODE'] = 'COOKIE VALUE'
*
* Adding the Country code from the theme to the Cookie variable
*/
$codes = array();
$codes['wls'] = 'WA|GB';
$codes['eng'] = 'EN|GB';
$codes['ire'] = 'IE|IE';
$codes['nir'] = 'NI|GB';
$codes['sct'] = 'SC|GB';
$codes['no-nation'] = 'EN|GB';

/**
* @param
*
* $countryCookieCode - converts the value setting in the Theme settings file
* into a variable value (taken from the array) that is then made available to JS
**/

$countryCookieCode = $codes[theme_get_setting('ou_df_nation')];
?>
<div id="int-site">

  <?php include theme_get_setting('ou_df_path_to_header'); ?>
 <script>
   var countryCode = '<?php echo $countryCookieCode; ?>';
      doTranslation();
    
  </script>

  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>

  <?php include theme_get_setting('ou_df_path_to_footer') ; ?>
</div>

    <!--Added SC from LA 11-4-14 -->
<script src="/oudigital/eep/assets/js/vendor/jquery-1.10.2.min.js"></script>

  <script src="/oudigital/eep/assets/js/vendor/jquery.placeholder.js"></script>
  <script src="/oudigital/eep/assets/js/vendor/jquery.smartresize.js"></script>
  <script src="<?php print $themePath . '/js/app.js'?>"></script>
  <script src="/oudigital/eep/assets/js/modules/back-to-top.js"></script>
  <script src="<?php print $themePath . '/js/main.js'?>"></script>
  <script>

    // Only hide if your CMS menu has been output correctly
    $("#ou-global-primary-navigation.ou-df-header-nav").remove();
  </script>

  <script src="/oudigital/headerandfooter/assets/js/modules/ou-primary-navigation.js"></script>

 <script>
     //Function that has to be called on the page to initialise the nav
      (function ($, window) {
          window.OU.PrimaryNavigation = new window.OU.DigitalFramework.Global.PrimaryNavigation({
              serviceLink: true,    //Set to false to switch off the service links toggle functionality and responsive styling i.e. if you are not using service links on the page. Default is true.
              activeItem: true      //Set to true to initialise the nav item using js, default is false
          });
      })(jQuery, window);
  </script>
  <script type="text/javascript"> if (typeof window.ou_init=='function')ou_init();</script>
  <!--  End -->
 <script> jQuery.noConflict(true);</script>
</body>
</html>
