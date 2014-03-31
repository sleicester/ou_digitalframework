<?php


function ou_digital_futures_preprocess_html(&$variables) {
  drupal_add_css('http://www-dev.open.ac.uk/oudigital/eep/assets/css/screen.css', array('type' => 'external'));
  drupal_add_css('http://www-dev.open.ac.uk/oudigital/headers-footers/assets/css/header.css', array('type' => 'external'));
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


/*
**Add jwyng wrapper classes -int-secondlevel/int-thirdlevel classes
*/
function ou_digital_futures_preprocess_menu_block_wrapper(&$variables) {
  if($variables['config']['level']==1){
  $variables['classes_array'][] = 'int-secondlevel-nav int-nav-level';
  }
  elseif($variables['config']['level']==2){
  $variables['classes_array'][] = 'int-thirdlevel-nav int-nav-level';
  }
}

/*
**Add jwyng ul class int-container
*/
function ou_digital_futures_menu_tree__menu_block__main_menu($variables){
	return '<ul class="int-container" >' . $variables['tree'] . '</ul>';
}

/*
**Add jwyng int-hasChildren and chevron icon to all list items that have the drupal
**class has-children, add <span> tags between the href tag and title text
**eg <li><a href=""><span>Menu item</span></a></li>
*/

function ou_digital_futures_menu_link__menu_block__main_menu($variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  //add span class between href and title text, render span tags as html
  $element['#title'] = '<span>' . check_plain($element['#title']) . '</span>';

  $element['#localized_options'] += array('html'=> TRUE);
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);

  //if the li has a class of active trail or active add the jwying class int-nav-active
  foreach($element['#attributes']['class'] as $value){
	if(($value == 'active-trail')|| ($value == 'active')){
  	   $element['#attributes']['class'][] = 'int-nav-active';
  	   break;
  	   }
	}
  //if the li has a class of has-children add the jwying class int-hasChildren and the jwyng chevron icon and return amended li
  foreach($element['#attributes']['class'] as $value){
  	if($value == 'has-children'){
  	   $element['#attributes']['class'][] = 'int-hasChildren';
	   return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . '<a class="int-nav-trigger" href="#"><span><i class="int-icon int-icon-chevron-down"></i><i class="int-icon int-icon-chevron-up"></i></span></a></li>';
  	   }
	}

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>";

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
