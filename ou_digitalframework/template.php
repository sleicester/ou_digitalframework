<?php

function ou_digital_futures_breadcrumb($variables) {
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

 function ou_digital_futures_preprocess_html(&$variables) {
   if (!empty($variables['page']['sidebar_second'])) {
    $variables['my_files_path'] = 'This is a test';
    }
  }