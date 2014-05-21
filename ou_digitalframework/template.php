<?php

function ou_digital_futures_preprocess_html( & $variables)
{
  drupal_add_css('/oudigital/eep/assets/css/screen.css', array('type'=> 'external'));

  /* add new classes to body from theme settings */
  $variables['classes_array'][] = theme_get_setting('ou_df_colour_scheme');

  /*
  ** Add the NID to the body custom ID
  ** This is used by the OU Framework H&F to determine the current menu item and
  ** and open the correct Navigation level accordingly
  */

  if ( arg(0) == 'node' && is_numeric(arg(1)) && ! arg(2) ) {
    $nid = arg(1);
  }
  else {
    $nid = 'home';
  }

  // Establish what the level of the current menu item is
  // Looping through menu to bottom


  $tree = menu_tree_page_data('main-menu');

  $level= 0;
  // Go down the active trail as far as possible.
  while ($tree) {
    // Loop through the current level's items until we find one that is in trail.
    while ($item = array_shift($tree)) {
      if ($item['link']['in_active_trail']) {
        // If the item is in the active trail, we count a new level.
        $level++;
        if (!empty($item['below'])) {
          // If more items are available, we continue down the tree.
          $tree = $item['below'];
          break;
        }
        // If we are at the end of the tree, our work here is done.
        break 2;
      }
    }
  }

// add a class to indicate the current drupal level
  $variables['classes_array'][] = 'item-menu-level-' . $level;
  // Depending on the current theme
  // we set the menu depth to compare against
  // ou_digital_futures renders 2 Levels (drupal)
  // ou_digital_futures renders 3 levels (drupal)

  $menuDepth = ($GLOBALS['theme'] == 'ou_digital_futures' ? 2 : 3);

  if ($level > $menuDepth) {
    $mlid = db_select('menu_links' , 'ml')
    ->condition('ml.link_path' , 'node/' . $nid)
    ->fields('ml' , array('mlid'))
    ->execute()
    ->fetchField();

    $plid = db_select('menu_links' , 'ml')
    ->condition('ml.mlid' , $mlid)
    ->fields('ml' , array('plid'))
    ->execute()
    ->fetchField();

    $path = db_select('menu_links' , 'ml')
    ->condition('ml.mlid' , $plid)
    ->fields('ml' , array('link_path'))
    ->execute()
    ->fetchField();

    $nid = str_replace('node/','',$path);
  }

  if ($level > $menuDepth + 1) {
    $pplid = db_select('menu_links' , 'ml')
    ->condition('ml.mlid' , $plid)
    ->fields('ml' , array('plid'))
    ->execute()
    ->fetchField();

    $path = db_select('menu_links' , 'ml')
    ->condition('ml.mlid' , $pplid)
    ->fields('ml' , array('link_path'))
    ->execute()
    ->fetchField();

    $nid = str_replace('node/','',$path);
  }
  // Set the data-page-id with the relevant parent node
  $variables['attributes_array']['data-page-id'][] = 'ou-page-'.$nid;
  }

/*
**Theme the appearance of the breadcrumb to add jywing classes
*/

function ou_digital_futures_breadcrumb($variables)
{
  if (count($variables['breadcrumb']) > 0) {
    $lastitem = sizeof($variables['breadcrumb']);
    $title    = drupal_get_title();

    global $language_content;
    if ($language_content->language == 'cy') {
      $crumbs = '<dl class="breadcrumb"><dt>Rydych chi yma:</td><dd>';
      $variables['breadcrumb'][0] = str_replace('Home','Hafan',$variables['breadcrumb'][0]);
    }
    else {
      $crumbs = '<dl class="breadcrumb"><dt>You are here: </td><dd>';

    }

    $a = 1;

    foreach ($variables['breadcrumb'] as $value) {
      if ($a != $lastitem) {
        $crumbs .= '<span>'. $value . ' ' . '</span> &nbsp; <i class="int-icon int-icon-chevron-right"></i> &nbsp;';
        $a++;
      }
      else {
        $crumbs .= '<span>'.$value.'<span>';
      }
    }
    $crumbs .= '&nbsp; <i class="int-icon int-icon-chevron-right"></i>  &nbsp;'.$title.'</dd></dl>';
    return $crumbs;
  }
}


/*
**Hide the <h1> title when node type is a panel
*/

function ou_digital_futures_preprocess_page( & $variables)
{

  if ((!empty($variables['node'])) && ($variables['node']->type == 'panel')) {
    $variables['title'] = "";
  }
}



function ou_digital_futures_menu_tree__menu_block__main_menu($variables)
{
  $block_output     = '';
  $insert_menu      = '';

  // Create an Array of the header menu options
  $headerLinksArray = array();
  $headerLinksArray['ou-df-ia-courses']['title'] = "Courses";
  $headerLinksArray['ou-df-ia-courses']['a_href'] = "/courses";

  $headerLinksArray['ou-df-ia-postgraduate']['title'] = "Postgraduate";
  $headerLinksArray['ou-df-ia-postgraduate']['a_href'] = "/postgraduate";

  $headerLinksArray['ou-df-ia-research']['title'] = "Research";
  $headerLinksArray['ou-df-ia-research']['a_href'] = "http://www.open.ac.uk/research/main/";

  $headerLinksArray['ou-df-ia-about']['title'] = "About";
  $headerLinksArray['ou-df-ia-about']['a_href'] = "http://www.open.ac.uk/about/main/";

  $headerLinksArray['ou-df-ia-news']['title'] = "News & media";
  $headerLinksArray['ou-df-ia-news']['a_href'] = "http://www.open.ac.uk/news";

  $headerLinksArray['ou-df-ia-employers']['title'] = "Employers";
  $headerLinksArray['ou-df-ia-employers']['a_href'] = "http://www.open.ac.uk/employers";

  // Loop through the array to build the header
  foreach ($headerLinksArray as $key=>$value) {
    // If the Theme setting matches this heading then add in the sub menu
    if ($key == theme_get_setting('ou_df_colour_scheme')) {
      $insert_menu .= '<li class="'.$key.'"><a href="'.$value['a_href'].'"><span class="ou-page-home">'.$value['title'].'</span></a><ul>' . $variables['tree'] . '</ul></li>';
    }
    else {
      $insert_menu .= '<li class="'.$key.'"><a href="'.$value['a_href'].'"><span>'.$value['title'].'</span></a></li>';
    }

  }
  $block_output = '<div role="navigation" id="ou-global-primary-navigation">';
  $block_output .= '<div class="int-primary">';
  $block_output .= '<div class="int-toplevel-nav int-nav-level">';
  $block_output .= '<ul class="int-container">';
  $block_output .= '<li class="ou-df-ia-home int-home"><a href="http://www.open.ac.uk"><span>Home</span></a></li>';
  $block_output .= $insert_menu;    // add in the header titles from the array
  $block_output .= '</ul>';
  $block_output .= '</div>';
  $block_output .= '<div class="int-secondlevel-nav int-nav-level">';
  $block_output .= '</div>';
  $block_output .= '<div class="int-thirdlevel-nav int-nav-level">';
  $block_output .= '</div>';
  $block_output .= '</div>';
  $block_output .= '</div>';

  return $block_output;
}
/*
**Remove drupal classes
*/
function ou_digital_futures_preprocess_menu_block_wrapper( & $variables)
{
  $variables['classes_array'][] = '';
}


function ou_digital_futures_menu_link__menu_block__main_menu($variables)
{
  $element = $variables['element'];
  $sub_menu= '';

  if ($element['#below']) {
    unset($element['#below']['#theme_wrappers']);
    $sub_menu = '<ul >'.drupal_render($element['#below']).'</ul>';
  }

  // Use the NID as a Unique identifier for this element
  $menu_link_id = $element['#original_link']['link_path'];
  // Strip out the non - numeric characters leaving us with the NID
  $menu_nid     = str_replace('node/','',$menu_link_id);
  $menu_nid     = (is_numeric($menu_nid) ? $menu_nid : '');


  //add span class between href and title text, render span tags as html
  $element['#title'] = '<span class="ou-page-'.$menu_nid.'">' . check_plain($element['#title']) . '</span>';

  $element['#localized_options'] += array('html'=> TRUE);

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li>' . $output . $sub_menu . "</li>";

}


/**
* Theme a set of radio buttons.
*/
function ou_digital_futures_radios($variables)
{
  $element    = $variables['element'];
  $attributes = array();

  $attributes['class'] = 'ou_webform_radio_set';
  if (!empty($element['#attributes']['class'])) {
    $attributes['class'] .= ' ' . implode(' ', $element['#attributes']['class']);
  }


  // Add custom classes.
  // To target specific elements you can use the $element variable.
  // You can target the label using:
  // .your - custom - class label
  //  $attributes['class'] .= 'ou_webform_radio';

  return '<div' . drupal_attributes($attributes) . '>' . (!empty($element['#children']) ? $element['#children'] : '') . '</div>';
}


/**
* Theme a single radio button.
*/
function  ou_digital_futures_radio($variables)
{
  $element = $variables['element'];
  $element['#attributes']['type'] = 'radio';
  element_set_attributes($element, array('id'           ,'name'         ,'#return_value'=> 'value'));

  if (isset($element['#return_value']) && $element['#value'] !== FALSE && $element['#value'] == $element['#return_value']) {
    $element['#attributes']['checked'] = 'checked';
  }
  _form_set_class($element, array('form-radio'));

  // Set custom classes.
  // Use $element to target specific fields.
  $element['#attributes']['class'][] = 'int-row ou_webform_radio_single';

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}
