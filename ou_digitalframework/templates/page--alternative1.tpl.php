<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['hero']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */
?>

<div id="int-site"><div id="page">

  <div class="<?php print $secondary_menu ? 'with-secondary-menu': 'without-secondary-menu'; ?>"><div class="section clearfix">


<div id="int-site" class="<?php print theme_get_setting('ou_df_colour_scheme'); ?>"><div id="page">
<?php include path_to_theme() . theme_get_setting('ou_df_path_to_header'); ?>





      <?php if ($main_menu): ?>
        <div id="main-menu" class="int-nav-primary">
          <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Main menu')));?>
        </div> <!-- /#main-menu -->
      <?php endif; ?>



</div> <!-- /.section, /#header -->
    <div class="int-container">
  	<div class="int-row">
    <?php if ($messages): ?>
      <div id="messages"><div class="section clearfix">
        <?php print $messages; ?>
      </div></div> <!-- /.section, /#messages -->
  <?php endif; ?>
  </div></div><!--/.int-container /.int-row -->


  <main id="int-content">


  <?php if ($page['hero']): ?>
 	<div class="int-courses-hero">
     <div class="interaction">
      <div class="int-container">
     <?php if ($breadcrumb): ?>
       <div class="int-container">
  	  	 <div id="breadcrumb"><?php print $breadcrumb; ?></div>
 	   </div><!--/.int-container -->
     <?php endif; ?>


         <?php print render($page['hero']); ?>
      </div><!-- /.int-container-->
      <br />
  	</div></div><!-- /.int-courses-hero /.interaction-->
  	<?php endif; ?>




<?php if ($page['highlighted']): ?>
  <div class="int-promo">
  		<div class="int-container">
  			<div class="int-notice int-notice-icon int-notice-icon-academic">
  				 <div id="highlighted"><?php print render($page['highlighted']); ?></div>

  			</div>
  		</div>
	</div>
<?php endif; ?>

  <div class="int-container">

     <div id="content"><div class="section">


  	      <a id="main-content"></a>
  	      <?php print render($title_prefix); ?>
  	      <?php if ($title): ?>
  	        <h1 class="title" id="page-title">
  	          <?php print $title; ?>
  	        </h1>
  	      <?php endif; ?>
  	      <?php print render($title_suffix); ?>
  	      <?php if ($tabs): ?>
  	        <div class="tabs">
  	          <?php print render($tabs); ?>
  	        </div>
  	      <?php endif; ?>
  	      <?php print render($page['help']); ?>
  	      <?php if ($action_links): ?>
  	        <ul class="action-links">
  	          <?php print render($action_links); ?>
  	        </ul>
  	      <?php endif; ?>
  	      <?php print render($page['content']); ?>
  	      <?php print $feed_icons; ?>

    </div></div> <!-- /.section, /#content -->
<hr class="int-divider int-divider-sub int-divider-lrg int-divider-arrow">
  <div class="int-row">
    <?php if ($page['sidebar_first']): ?>
      <div id="sidebar-first" class="int-grid6"><div class="section">
        <?php print render($page['sidebar_first']); ?>
      </div></div> <!-- /.section, /#sidebar-first -->
    <?php endif; ?>


    <?php if ($page['sidebar_second']): ?>
      <div id="sidebar-second" class="int-grid6"><div class="section">
        <?php print render($page['sidebar_second']); ?>
      </div></div> <!-- /.section, /#sidebar-second -->
    <?php endif; ?>



  </div></div> <!--/.int-row /.int-container -->


  </main>

  <div id="footer-wrapper"><div class="section">


    <?php if ($page['footer']): ?>
      <div id="footer" class="clearfix">
        <?php print render($page['footer']); ?>
      </div> <!-- /#footer -->
    <?php endif; ?>

<?php include path_to_theme() . theme_get_setting('ou_df_path_to_footer') ; ?>


  </div></div> <!-- /.section, /#footer-wrapper -->

</div></div> <!-- /#page, /#page-wrapper -->
