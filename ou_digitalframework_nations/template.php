<?php


function ou_digital_futures_nations_menu_tree__menu_block__main_menu($variables)
  {
    $block_output     = '';
    $insert_menu      = '';

    // Switch using the current language
        global $language_content;
    if ($language_content->language == 'cy') {
        // Welsh
        // Create an Array of the header menu options
        $headerLinksArray = array();
        $headerLinksArray['ou-df-ia-courses']['title'] = "Cyrsiau";
        $headerLinksArray['ou-df-ia-courses']['a_href'] = "/courses";

        $headerLinksArray['ou-df-ia-postgraduate']['title'] = "Ôl-raddedig";
        $headerLinksArray['ou-df-ia-postgraduate']['a_href'] = "/postgraduate";

        $headerLinksArray['ou-df-ia-research']['title'] = "Ymchwil";
        $headerLinksArray['ou-df-ia-research']['a_href'] = "http://www.open.ac.uk/research/main/";

        $headerLinksArray['ou-df-ia-about']['title'] = "Gwybodaeth am y Brifysgol Agored";
        $headerLinksArray['ou-df-ia-about']['a_href'] = "http://www.open.ac.uk/about/main/";

        $headerLinksArray['ou-df-ia-news']['title'] = "Newyddion a Chyfryngau'r DU";
        $headerLinksArray['ou-df-ia-news']['a_href'] = "http://www.open.ac.uk/news";

        $headerLinksArray['ou-df-ia-employers']['title'] = "Cyflogwyr";
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
        $block_output .= '<li class="ou-df-ia-home int-home"><a href="http://www.open.ac.uk"><span>Hafan</span></a></li>';
        /*$block_output .= $insert_menu;    // add in the header titles from the array*/

        $block_output .= $variables['tree'] ;    // add in the header titles from the array
        $block_output .= '</ul>';
        $block_output .= '</div>';
        $block_output .= '<div class="int-secondlevel-nav int-nav-level">';
        $block_output .= '</div>';
        $block_output .= '<div class="int-thirdlevel-nav int-nav-level">';
        $block_output .= '</div>';
        $block_output .= '</div>';
        $block_output .= '</div>';

    }
    else {

        // Other
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
        $block_output .= '<li class="ou-df-ia-home int-home"><a href="http://www.open.ac.uk"><span>Home</span></a></li>';
       
        /*$block_output .= $insert_menu;    // add in the header titles from the array*/

        $block_output .= $variables['tree'] ;    // add in the header titles from the array
        $block_output .= '</ul>';
        $block_output .= '</div>';
        $block_output .= '<div class="int-secondlevel-nav int-nav-level">';
        $block_output .= '</div>';
        $block_output .= '<div class="int-thirdlevel-nav int-nav-level">';
        $block_output .= '</div>';
        $block_output .= '</div>';
        $block_output .= '</div>';
    }

    return $block_output;
  }
