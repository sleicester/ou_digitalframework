<?php

function ou_digital_futures_preprocess_html(&$variables) {
  drupal_add_css('http://www-dev.open.ac.uk/oudigital/eep/assets/css/screen.css', array('type' => 'external'));
  drupal_add_css('http://www-dev.open.ac.uk/oudigital/headers-footers/assets/css/header.css', array('type' => 'external'));


  // add new classes to body from theme settings
  $variables['classes_array'][] = theme_get_setting('ou_df_colour_scheme');

}

/*
**Theme the appearance of the breadcrumb to add jywing classes
*/
function ou_digital_futures_breadcrumb($variables) {
   if (count($variables['breadcrumb']) > 0) {
     $lastitem = sizeof($variables['breadcrumb']);
     $title = drupal_get_title();
     $crumbs = '<dl class="breadcrumb"><dt>You are here: </td><dd>';
     $a=1;
     foreach($variables['breadcrumb'] as $value) {
         if ($a!=$lastitem){
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
function ou_digital_futures_preprocess_page(&$variables) {

      if ((!empty($variables['node'])) && ($variables['node']->type == 'panel')) {
           $variables['title']="";
      }
 }


function ou_digital_futures_menu_tree__menu_block__main_menu($variables){

    //return '<ul>' . $variables['tree'] . '</ul>';
  $test = '';
  $test = '<div role="navigation" id="ou-global-primary-navigation">';
  $test .= '<div class="int-primary">';
  $test .= '<div class="int-toplevel-nav int-nav-level">';
  $test .= '<ul class="int-container">';
  $test .= '<li class="ou-df-ia-home int-home"><a href="#"><span>Home</span></a></li>';
  $test .= '<li class="ou-df-ia-courses"><a href="/courses"><span>Courses</span></a></li>';
  $test .= '<li class="ou-df-ia-postgraduate"><a href="/postgraduate"><span>Postgraduate</span></a></li>';
  $test .= '<li class="ou-df-ia-research"><a href="http://www.open.ac.uk/research/main/"><span>Research</span></a></li>';
  $test .= '<li class="ou-df-ia-about"><a href="http://www.open.ac.uk/about/main/"><span>About</span></a><ul>' . $variables['tree'] . '</ul></li>';
  $test .= '<li class="ou-df-ia-news"><a href="http://www.open.ac.uk/news"><span>News &amp; media</span></a></li>';
  $test .= '<li class="ou-df-ia-employers"><a href="http://www.open.ac.uk/employers"><span>Employers</span></a></li>';
  $test .= '</ul>';
  $test .= '</div>';
  $test .= '<div class="int-secondlevel-nav int-nav-level">';
  $test .= '</div>';
  $test .= '<div class="int-thirdlevel-nav int-nav-level">';
  $test .= '</div>';
  $test .= '</div>';
  $test .= '</div>';

  return $test;
}

/*
**Remove drupal classes
*/
function ou_digital_futures_preprocess_menu_block_wrapper(&$variables) {
  $variables['classes_array'][] = '';
}

 function ou_digital_futures_menu_link__menu_block__main_menu($variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    unset($element['#below']['#theme_wrappers']);
    $sub_menu = '<ul>'.drupal_render($element['#below']).'</ul>';
  }

  //add span class between href and title text, render span tags as html
  $element['#title'] = '<span>' . check_plain($element['#title']) . '</span>';

  $element['#localized_options'] += array('html'=> TRUE);

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li>' . $output . $sub_menu . "</li>";

}

/**
 * Theme a set of radio buttons.
 */
function ou_digital_futures_radios($variables) {
  $element = $variables['element'];
  $attributes = array();

  $attributes['class'] = 'ou_webform_radio_set';
  if (!empty($element['#attributes']['class'])) {
    $attributes['class'] .= ' ' . implode(' ', $element['#attributes']['class']);
  }


  // Add custom classes.
  // To target specific elements you can use the $element variable.
  // You can target the label using:
  // .your-custom-class label
  //  $attributes['class'] .= 'ou_webform_radio';

  return '<div' . drupal_attributes($attributes) . '>' . (!empty($element['#children']) ? $element['#children'] : '') . '</div>';
}


/**
 * Theme a single radio button.
 */
function  ou_digital_futures_radio($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'radio';
  element_set_attributes($element, array('id', 'name','#return_value' => 'value'));

  if (isset($element['#return_value']) && $element['#value'] !== FALSE && $element['#value'] == $element['#return_value']) {
    $element['#attributes']['checked'] = 'checked';
  }
  _form_set_class($element, array('form-radio'));

  // Set custom classes.
  // Use $element to target specific fields.
  $element['#attributes']['class'][] = 'int-row ou_webform_radio_single';

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}
