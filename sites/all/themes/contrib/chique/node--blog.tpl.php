<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?> class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted"><?php print $submitted ?></div>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <div class="links"><?php print render($content['links']); ?></div>
    <?php endif; ?>
    
    <?php if ($page!= 0 && variable_get('user_signatures', 0)): $node_author = user_load($uid); ?>
    <div class="shadow-large">
        <div class="author-info">
            <div class="author-picture"><?php print $user_picture ?></div>
            <div class="author-title"><?php print t('ABOUT THE AUTHOR'); ?></div>
            <div><?php print $node_author->signature; ?></div>
        </div>
    </div>
    <?php endif;?>

    <?php print render($content['comments']); ?>
  </div>

</div>
