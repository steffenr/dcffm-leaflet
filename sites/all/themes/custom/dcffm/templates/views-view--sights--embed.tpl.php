
<div id="fewo_map_sidebar">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  <?php if ($rows): ?>
    <?php print $rows; ?>
  <?php elseif ($empty): ?>
    <?php print $empty; ?>
  <?php endif; ?>

</div><?php /* class view */ ?>