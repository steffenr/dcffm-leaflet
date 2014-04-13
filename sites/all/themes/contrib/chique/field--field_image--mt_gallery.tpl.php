<?php if (!$label_hidden) : ?>
<div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
<?php endif; ?>

<?php
// Reduce number of images in teaser view mode to single image
if ($element['#view_mode'] == 'teaser') : ?>
<div class="field-item field-type-image even"<?php print $item_attributes[0]; ?>><?php print render($items[0]); ?></div> 
<?php return; endif; ?>

<?php $node=$element['#object']; $lang ='und'; ?>

<div class="yoxview">

    <div class="yoxview-image-preview">
        <div class="field-type-image">
        <a href="<?php print file_create_url($node->field_image[$lang][0]['uri']) ?>">
        <img src="<?php print image_style_url('large', $node->field_image[$lang][0]['uri']); ?>" alt="<?php print $node->field_image[$lang][0]['alt']; ?>" title="<?php print $node->field_image[$lang][0]['title']; ?>"/>
        </a>
        
        <?php if ($node->field_image[$lang][0]['alt']) : ?>
        <div class="field-type-image-caption"><?php print $node->field_image[$lang][0]['alt']; ?></div>
        <?php endif; ?>
        
        </div>
    </div>

	<?php $numberOfImages=0; foreach ($node->field_image[$lang] as $key=>$file) { $numberOfImages++; } ?>  
    
    <?php if ($numberOfImages>1) { ?>   
    <div class="yoxview-image-items clearfix">
    
        <?php $i=0; foreach ($node->field_image[$lang] as $key=>$file) { 
		if ($key==0) { continue; } 
		$i++; ?>
        <div class="yoxview-image-item <?php $mod = $i % 4; if (!$mod) { print 'last'; } ?>">
        <a href="<?php print file_create_url($node->field_image[$lang][$key]['uri']) ?>">
        <img src="<?php print image_style_url('small', $node->field_image[$lang][$key]['uri']); ?>" alt="<?php print $node->field_image[$lang][$key]['alt']; ?>" title="<?php print $node->field_image[$lang][$key]['title']; ?>"/>
        </a>
        </div> 
        <?php } ?> 
         
    </div>
    <?php }  ?>

</div>

<?php
drupal_add_js(base_path() . drupal_get_path('theme', 'chique') .'/js/yoxview/yoxview-init.js');

drupal_add_js('jQuery(document).ready(function($) { 
jQuery(".yoxview").yoxview({lang: "en" });
});',
array('type' => 'inline', 'scope' => 'footer')); 
?>