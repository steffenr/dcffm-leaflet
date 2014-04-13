<div class="<?php print $classes . ' ' . $zebra; ?>"<?php print $attributes; ?>>

  <?php if ($new) : ?>
    <span class="new"><?php print drupal_ucfirst($new) ?></span>
  <?php endif; ?>

	<div class="submitted"><?php print $submitted ?></div>
    
    <div class="comment-inner">
    
    	<?php print $picture ?>
    
		<?php print render($title_prefix); ?>
        <h3<?php print $title_attributes; ?>><?php print $title ?></h3>
        <?php print render($title_suffix); ?>
    
        <div class="content"<?php print $content_attributes; ?>>
          <?php hide($content['links']); print render($content); ?>
          <?php if ($signature): ?>
          <div class="clearfix signature">
            <div>—</div>
            <?php print $signature ?>
          </div>
          <?php endif; ?>
        </div>
        
        <?php print render($content['links']) ?>
        
    </div>
    
  
</div>