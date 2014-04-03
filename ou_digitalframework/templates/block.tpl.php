<?php

/**
* @file
* Default theme implementation to display a block.
*
* Available variables:
* - $block->subject: Block title.
* - $content: Block content.
* - $block->module: Module that generated the block.
* - $block->delta: An ID for the block, unique within each module.
* - $block->region: The block region embedding the current block.
* - $classes: String of classes that can be used to style contextually through
*   CSS. It can be manipulated through the variable $classes_array from
*   preprocess functions. The default values can be one or more of the
*   following:
*   - block: The current template type, i.e., "theming hook".
*   - block-[module]: The module generating the block. For example, the user
*     module is responsible for handling the default user navigation block. In
*     that case the class would be 'block-user'.
* - $title_prefix (array): An array containing additional output populated by
*   modules, intended to be displayed in front of the main title tag that
*   appears in the template.
* - $title_suffix (array): An array containing additional output populated by
*   modules, intended to be displayed after the main title tag that appears in
*   the template.
*
* Helper variables:
* - $classes_array: Array of html class attribute values. It is flattened
*   into a string within the variable $classes.
* - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
* - $zebra: Same output as $block_zebra but independent of any block region.
* - $block_id: Counter dependent on each block region.
* - $id: Same output as $block_id but independent of any block region.
* - $is_front: Flags true when presented in the front page.
* - $logged_in: Flags true when the current user is a logged-in member.
* - $is_admin: Flags true when the current user is an administrator.
* - $block_html_id: A valid HTML ID and guaranteed unique.
*
* @see template_preprocess()
* @see template_preprocess_block()
* @see template_process()
*
* @ingroup themeable
*/

// This block has been amended render

// Get the current node ID

if ( arg(0) == 'node' && is_numeric(arg(1)) && ! arg(2) ) {
  $node = node_load(arg(1));
  $nid  = arg(1);

  if ($block->delta == theme_get_setting('ou_df_siblings_block_id')) {

    function get_array_columns_siblings($array, $columns)
    {
      // Function to split array into columns
      $columns_map = array();
      for ($i = 0; $i < $columns; $i++) {
        $columns_map[] = 0;
      }//init columns

      //create map
      $count    = count($array);
      $position = 0;
      while ($count > 0) {
        $columns_map[$position]++;
        $position = ($position < $columns - 1) ? ++$position : 0;
        $count--;
      }

      //chunk the array based on map
      $chunked = array();
      foreach ($columns_map as $map) {
        $chunked[] = array_splice($array,0,$map);
      }
      return $chunked;

    }//end get_array_columns

    // Set up some variables
    $wrapperCss      = 'int-container';
    $innerWrapperCss = 'int-row';
    $columnClass     = 'int-grid4';
    $ulCss           = 'int-bordered-list';
    $liCss           = '';
    $aClass          = 'int-icon-text';
    $block_output    = '';
    $numberOfColumns = 3;

    // Build the content variable
    $block_output .= '<div class="'.$wrapperCss.'"><div class="'.$innerWrapperCss.'">';

    // Create our own Flat array of MLID / PLID / NID 4 Levels

    $arrayOfAllMenuItems = array();

    // Fetch the menu tree
    $menuTree = menu_tree_all_data('main-menu');

    foreach ($menuTree as $key=>$value) {

      $arrayOfAllMenuItems[$key]['nid'] = str_replace('node/','',$value['link']['link_path']);
      $arrayOfAllMenuItems[$key]['mlid'] = $value['link']['mlid'];
      $arrayOfAllMenuItems[$key]['plid'] = $value['link']['plid'];

      foreach ($value['below'] as $levelTwoKey=>$levelTwoValue) {

        $arrayOfAllMenuItems[$levelTwoKey]['nid'] = str_replace('node/','',$levelTwoValue['link']['link_path']);
        $arrayOfAllMenuItems[$levelTwoKey]['mlid'] = $levelTwoValue['link']['mlid'];
        $arrayOfAllMenuItems[$levelTwoKey]['plid'] = $levelTwoValue['link']['plid'];

        foreach ($levelTwoValue['below'] as $levelThreeKey=>$levelThreeValue) {

          $arrayOfAllMenuItems[$levelThreeKey]['nid'] = str_replace('node/','',$levelThreeValue['link']['link_path']);
          $arrayOfAllMenuItems[$levelThreeKey]['mlid'] = $levelThreeValue['link']['mlid'];
          $arrayOfAllMenuItems[$levelThreeKey]['plid'] = $levelThreeValue['link']['plid'];

          foreach ($levelThreeValue['below'] as $levelFourKey=>$levelFourValue) {

            $arrayOfAllMenuItems[$levelFourKey]['nid'] = str_replace('node/','',$levelFourValue['link']['link_path']);
            $arrayOfAllMenuItems[$levelFourKey]['mlid'] = $levelFourValue['link']['mlid'];
            $arrayOfAllMenuItems[$levelFourKey]['plid'] = $levelFourValue['link']['plid'];
          }
        }
      }
    }

    // Detect the Parent ID for this node PLID
    foreach ($arrayOfAllMenuItems as $key=>$value) {

      if (isset($value['nid']) && $value['nid'] == $nid && $value['nid'] != '' && $value['nid'] != 'home' ) {
        $mlid = (isset($value['mlid']) ? $value['mlid'] : '');
        $plid = (isset($value['plid']) ? $value['plid'] : '');
      }
    }

    foreach ($arrayOfAllMenuItems as $key=>$value) {
      if ($value['plid'] == $plid) {
        $nodes_list[] = $value['nid'];
      }
    }


    if (!empty($nodes_list)) {

      $columnizedArray = get_array_columns_siblings($nodes_list,$numberOfColumns);

      foreach ($columnizedArray as $columnkey => $columnval) {
        $block_output .= '<div class="'.$columnClass.'">';

        if (!empty($columnval) && $columnval != '0') {
          $query    = new EntityFieldQuery();
          $entities = $query->entityCondition('entity_type', 'node')
          ->propertyCondition('nid',$columnval,'IN')
          ->propertyCondition('status', 1)
          ->execute();

          // Load the nodes into an array
          $nodes    = entity_load('node', array_keys($entities['node']));

          // Loop through the array
          foreach ($nodes as $key => $val) {
            $path = drupal_get_path_alias('node/'.$val->nid);
            $block_output .= '<h3><a href="'.$path.'">' . $val->title .'</a></h3>';
            $block_output .= $val->body[$node->language][0]['summary'] ;
          }

          // Close the final column DIV
          $block_output .= '</div>';

          // Close final DIV
        }
      }
      $block_output .= '</div></div>';
      $content = $block_output;
    }
    else {
      // No items to render

      $block->subject = '';
      $content = '';
    }

  }

  elseif ($block->delta == theme_get_setting('ou_df_children_block_id') && isset($nid)) {

    function get_array_columns_children($array, $columns)
    {

      $columns_map = array();
      for ($i = 0; $i < $columns; $i++) {
        $columns_map[] = 0;
      }//init columns

      //create map
      $count    = count($array);
      $position = 0;
      while ($count > 0) {
        $columns_map[$position]++;
        $position = ($position < $columns - 1) ? ++$position : 0;
        $count--;
      }

      //chunk the array based on map
      $chunked = array();
      foreach ($columns_map as $map) {
        $chunked[] = array_splice($array,0,$map);
      }

      return $chunked;
    }//end get_array_columns

    // Set up some variables
    $wrapperCss      = 'int-container';
    $innerWrapperCss = 'int-row';
    $columnClass     = 'int-grid4';
    $ulCss           = 'int-bordered-list';
    $liCss           = '';
    $aClass          = 'int-icon-text';
    $block_output    = '';
    $numberOfColumns = 3;

    // Build the content variable
    $block_output .= '<div class="'.$wrapperCss.'"><div class="'.$innerWrapperCss.'">';

    // Create our own Flat array of MLID / PLID / NID 4 Levels
    $arrayOfAllMenuItems = array();

    // Fetch the menu tree
    $menuTree = menu_tree_all_data('main-menu');

    foreach ($menuTree as $key=>$value) {

      $arrayOfAllMenuItems[$key]['nid'] = str_replace('node/','',$value['link']['link_path']);
      $arrayOfAllMenuItems[$key]['mlid'] = $value['link']['mlid'];
      $arrayOfAllMenuItems[$key]['plid'] = $value['link']['plid'];

      foreach ($value['below'] as $levelTwoKey=>$levelTwoValue) {

        $arrayOfAllMenuItems[$levelTwoKey]['nid'] = str_replace('node/','',$levelTwoValue['link']['link_path']);
        $arrayOfAllMenuItems[$levelTwoKey]['mlid'] = $levelTwoValue['link']['mlid'];
        $arrayOfAllMenuItems[$levelTwoKey]['plid'] = $levelTwoValue['link']['plid'];

        foreach ($levelTwoValue['below'] as $levelThreeKey=>$levelThreeValue) {


          $arrayOfAllMenuItems[$levelThreeKey]['nid'] = str_replace('node/','',$levelThreeValue['link']['link_path']);
          $arrayOfAllMenuItems[$levelThreeKey]['mlid'] = $levelThreeValue['link']['mlid'];
          $arrayOfAllMenuItems[$levelThreeKey]['plid'] = $levelThreeValue['link']['plid'];

          foreach ($levelThreeValue['below'] as $levelFourKey=>$levelFourValue) {


            $arrayOfAllMenuItems[$levelFourKey]['nid'] = str_replace('node/','',$levelFourValue['link']['link_path']);
            $arrayOfAllMenuItems[$levelFourKey]['mlid'] = $levelFourValue['link']['mlid'];
            $arrayOfAllMenuItems[$levelFourKey]['plid'] = $levelFourValue['link']['plid'];
          }
        }
      }
    }

    // Detect the MLID ID for this node PLID
    foreach ($arrayOfAllMenuItems as $key=>$value) {
      if ($value['nid'] == $nid && $value['nid'] != '' && $value['nid'] != 'home' ) {
        $mlid = (isset($value['mlid']) ? $value['mlid'] : '');
        $plid = (isset($value['plid']) ? $value['plid'] : '');
      }
    }

    foreach ($arrayOfAllMenuItems as $key=>$value) {
      if (isset($value['plid']) && $value['plid'] == $mlid) {
        $nodes_list[] = $value['nid'];
      }
    }

    if (!empty($nodes_list)) {

      $columnizedArray = get_array_columns_children($nodes_list,$numberOfColumns);

      foreach ($columnizedArray as $columnkey => $columnval) {

        $block_output .= '<div class="'.$columnClass.'">';

        if (!empty($columnval)) {

          $query    = new EntityFieldQuery();
          $entities = $query->entityCondition('entity_type', 'node')
          ->propertyCondition('nid',$columnval,'IN')
          ->propertyCondition('status', 1)
          ->execute();

          // Load the nodes into an array & count them
          $nodes    = entity_load('node', array_keys($entities['node']));

          $block_output .= '<ul class="'.$ulCss.'">';

          foreach ($nodes as $key => $val) {
            $path = drupal_get_path_alias('node/'.$val->nid);
            $block_output .= '<li><a class="'.$aClass.'" href="'.$path.'"><span>'.$val->title.'</span>';
            $block_output .= '<i class="int-icon int-icon-chevron-right" aria-hidden="true"></i></a></li>';
          }
          $block_output .= '</ul>';
        }
        $block_output .= '</div>';
      }
      $block_output .= '</div></div>';
      $content = $block_output;
    }

    else {
      // There are no matching nodes so return an empty block
      $block->subject = '';
      $content = '';
    }

  }
}

?>

<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php
  if ($block->subject): ?>
  <h2  class="int-container" <?php print $title_attributes; ?>>
    <?php print $block->subject ?>
  </h2>
  <?php endif;?>
  <?php print render($title_suffix); ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php print $content ; ?>

  </div>
</div>