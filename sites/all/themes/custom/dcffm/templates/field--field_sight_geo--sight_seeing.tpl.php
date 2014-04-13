<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
  <?php endif; ?>
  <div class="field-items"<?php print $content_attributes; ?>>
    <?php foreach ($items as $delta => $item): ?>
      <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>><?php print render($item); ?></div>
    <?php endforeach; ?>
  </div>
    <?php if (!empty($items)): ?>
    <div class="sight--geo-data">
      <?php print $geodata_gmap; ?>
    </div>
    <div class="sight--link-to-map">
      <?php print $link_to_gmap; ?>
    </div>
    <?php endif; ?>
</div>
