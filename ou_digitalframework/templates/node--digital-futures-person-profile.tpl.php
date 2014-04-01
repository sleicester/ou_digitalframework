<?php

/**
 * @file
 * Digital Futures theme implementation to display a personal profile node.
 *
 */
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>



  <div class="content clearfix"<?php print $content_attributes; ?>>


    <h2><?php print $content['field_name'][0]['#markup'] ?></h2>
    <div class="int-row">

    <?php if (isset($content['field_associated_image'])): ?>
		<div class="profile-image">
       		<?php print render($content['field_associated_image']) ?>
    	</div>
    <?php endif; ?>

    <?php if ($content['field_role']): ?>
      	<h3><?php print $content['field_role']['#title'] ?></h3>
      	<?php print $content['field_role'][0]['#markup'] ?>
    <?php endif; ?>


    <?php if (isset($content['field_career'])): ?>
      <h3><?php print $content['field_career']['#title'] ?></h3>
      <?php print $content['field_career'][0]['#markup'] ?>
    <?php endif; ?>

    <?php if (isset($content['field_contact'])): ?>
      <h3><?php print $content['field_contact']['#title'] ?></h3>
      <?php print $content['field_contact'][0]['#markup'] ?>
    <?php endif; ?>
    </div>

  </div>

  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</div>
