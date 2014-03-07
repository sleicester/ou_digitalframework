<?php

function ou_digital_futures_breadcrumb($variables) {
//customise the appearance of the breadcrumb to add jywing classes
   if (count($variables['breadcrumb']) > 0) {
     $lastitem = sizeof($variables['breadcrumb']);
     $title = drupal_get_title();
     $crumbs = '<dl class="breadcrumb"><dd>';
     $a=1;
     foreach($variables['breadcrumb'] as $value) {
         if ($a!=$lastitem){
          $crumbs .= '<span>'. $value . ' ' . '</span><i class="int-icon int-icon-chevron-right"></i>';
          $a++;
         }
         else {
             $crumbs .= '<span>'.$value.'<span>';
         }
     }
     $crumbs .= '</dd></dl>';
   return $crumbs;
   }
   else {
     return t("Home");
   }
 }


 //change the class of the main content column depending on whether sidebar_second or sidebar_first is enabled, classes implement grid system based on 12 columns

function ou_digital_futures_preprocess_page(&$variables) {
   if((!empty($variables['page']['sidebar_second']))&&(!empty($variables['page']['sidebar_first']))){
     $variables['main_grid_int'] = "4";
     }
   elseif((!empty($variables['page']['sidebar_second']))||(!empty($variables['page']['sidebar_first']))){
     $variables['main_grid_int'] = "8";
     }
    else{
       $variables['main_grid_int'] = "12";
     }
   }



 //change the html of the main menu to reflect the jwing design, each menu item to be output as <li><a href><span>Menu Title

function ou_digital_futures_links__system_main_menu($variables) {

  $html = "  <ul class='int-container int-nav-prim-list'>\n";

   foreach ($variables['links'] as $link) {
     $html .= "<li>".t('<a href="@link"><span>@title</span></a>', array('@link' => url($link['href']), '@title' => $link['title']))."</li>";
   }

  $html .= "  </ul>\n";

  return $html;
}
