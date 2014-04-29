<?php


function ou_digital_futures_nations_menu_tree__menu_block__main_menu($variables)
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
            $insert_menu .= '<li class="'.$key.'"><a href="'.$value['a_href'].'"><span>'.$value['title'].'</span></a><ul>' . $variables['tree'] . '</ul></li>';
          }
          else {
            $insert_menu .= '<li class="'.$key.'"><a href="'.$value['a_href'].'"><span>'.$value['title'].'</span></a></li>';
          }

        }
        $block_output = '<div role="navigation" id="ou-global-primary-navigation">';
        $block_output .= '<div class="int-primary">';
        $block_output .= '<div class="int-toplevel-nav int-nav-level">';
        $block_output .= '<ul class="int-container">';
      
        $block_output .= $variables['tree'] ;    // add in the header titles from the array
               
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
   function ou_digital_futures_nations_menu_link__menu_block__main_menu($variables)
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
    
    $drupal_classes = _ou_digital_futures_nations_get_menu_link_classes($element['#attributes']['class']);
    
      $output = l($element['#title'], $element['#href'], $element['#localized_options']);
      return '<li class="'.$drupal_classes.'">' . $output . $sub_menu . "</li>";
  }

function _ou_digital_futures_nations_get_menu_link_classes($element){
    if (in_array('active',$element)){
        $classes_to_return ='ou-df-ia-about '; // add in an extra class to be matched with body tag
    }
    else {
     $classes_to_return ='';       
    }
    
    foreach($element as $key=>$value){
        $classes_to_return .= $value . ' ' ;        
    }
       $classes_to_return .=' ';
       return $classes_to_return;
}