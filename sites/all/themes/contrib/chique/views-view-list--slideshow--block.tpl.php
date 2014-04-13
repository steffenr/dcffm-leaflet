<!-- #slideshow-wrapper -->
<div id="slideshow-wrapper">
<!-- #slideshow -->
<div id="slideshow">
    <!-- #slider -->
    <div id="slider">
		<?php foreach ($rows as $id => $row) { ?>
        <div class="slider-item clearfix">
		
			<!-- Overriding $row result -->
			<?php $view = views_get_current_view();
            $nid = $view->result[$id]->nid; 
            $node = node_load($nid);
			$lang = 'und';

			if ($node->type=='mt_slideshow_entry') {
			
			//Slideshow image
			if ($node->field_slideshow) { 
			
			$image = image_style_url('slideshow', $node->field_slideshow_image[$lang][0]['uri']); 
			$title = $node->field_slideshow_image[$lang][0]['title'];
			$alt = $node->field_slideshow_image[$lang][0]['alt']; ?>
			
				<?php if ($node->field_slideshow_entry_path) { 
                $path = $node->field_slideshow_entry_path[$lang][0]['value']; ?>
                <a href="<?php print url($path); ?>"><img  src="<?php print $image; ?>" title="<?php print $title; ?>" alt="<?php print $alt; ?>"/></a>
                <?php } else { ?> 
                <img title="<?php print $title; ?>" alt="<?php print $alt; ?>" src="<?php print $image; ?>"/>
                <?php } ?>
			
			<?php } ?> 
			
            <div class="slider-text">
            <div class="slider-text-title"><?php print $node->title; ?></div>
            <div class="slider-text-submitted"><?php print date("l, F j, Y - H:i", $node->created); ?></div>
            </div>
			
			<?php } else { print $row; } ?> 
            <!-- EOF: Overriding $row result -->   
        
        </div>
        <?php } ?>
    </div><!-- EOF: #slider -->
    
    <div id="slideshow-navigation-container">
    <a id="previous" href="#"></a>
    <ul id="slideshow-navigation">
    <?php foreach ($rows as $id => $row){
	$view = views_get_current_view();
	$nid = $view->result[$id]->nid; 
	$node = node_load($nid);
	$lang = 'und';
    $image = image_style_url('slideshow-thumbnail', $node->field_slideshow_image[$lang][0]['uri']); 
    $title = $node->field_slideshow_image[$lang][0]['title'];
    $alt = $node->field_slideshow_image[$lang][0]['alt'];
    ?>
    <li><a href="#"><img title="<?php print $title; ?>" alt="<?php print $alt; ?>" src="<?php print $image; ?>"/></a></li>
    <?php } ?>
    </ul>
    <a id="next" href="#"></a>
    </div>
    
</div><!-- EOF: #slideshow -->
</div><!-- EOF: #slideshow-wrapper -->