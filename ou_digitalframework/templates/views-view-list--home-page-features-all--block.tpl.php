<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */

 $row_length = sizeof($rows); //set $row_length to the number of features
?>
<?php print $wrapper_prefix; ?>
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  <div class="int-row">
    <?php foreach ($rows as $id => $row): ?>

    	<?php if(($id + 1) % 3 == 0){  // if the feature is at the end of a row

			if($id == ($row_length - 1)){
				print "<div class='int-grid4'>".$row."</div></div>"; //  if the feature is the very last feature, close the int-row div without opening a new int-row div
				break;
			}
    		else {
    		print "<div class='int-grid4'>".$row."</div></div><div class='int-row'>";//  if the feature is not the very last feature, close the int-row div and open a new int-row div to commence a new row of features
    		}
    	}
		else {
			print "<div class='int-grid4'>".$row."</div>"; //if the feature is not at the end of the row print out feature
		}

	if($id == ($row_length - 1)){
		print "</div>";  //if the feature is the very last feature close the int-row div
	}
	?>
    <?php endforeach; ?>

<?php print $wrapper_suffix; ?>