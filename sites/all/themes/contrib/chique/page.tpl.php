<!-- #header-top -->
<div id="header-top" class="clearfix">

    <!-- #header-top-inside -->
    <div id="header-top-inside">
    
        <!-- #header-top-left -->
        <?php if ($page['header_left']) : ?>
        <div id="header-top-left">
        <?php print render($page['header_left']); ?>
        </div>
        <?php endif; ?>
        <!-- EOF: #header-top-left -->
        
        
        <!-- #header-top-right -->
        <?php if ($page['header_right']) : ?>
        <div id="header-top-right">        
        <?php print render($page['header_right']); ?>
        </div>
        <?php endif; ?>
        <!-- EOF: #header-top-right -->
    
    </div><!-- EOF: #header-top-inside -->

</div><!-- EOF: #header-top -->

<!-- #page -->
<div id="page">

    <!-- #page -->
    <div id="page-inside">
    
        <!-- #header -->
        <div id="header" class="clearfix">
        
            <!-- #header-left -->
            <div id="header-left">

				<?php if ($logo): ?>
                    <div id="logo">
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
                    <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
                    </a>
                    </div>
                <?php endif; ?>
                
                <?php if ($site_name || $site_slogan): ?>
                    <?php if ($site_name): ?>
                    <div id="site-name"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a></div>
                    <?php endif; ?>
                    
                    <?php if ($site_slogan): ?>
                    <div id="slogan"><?php print $site_slogan; ?></div>
                    <?php endif; ?>
                <?php endif; ?>

            </div><!-- EOF: #header-inside-left -->
            
            <!-- #header-right -->
            <div id="header-right">
            
            <!-- #header -->
            <?php if ($page['header']): ?>
            <?php print render($page['header']); ?>
            <?php endif; ?>
            <!-- EOF: #header -->

            </div><!-- EOF: #header-right -->

        </div><!-- EOF: #header -->
    
        <!-- #navigation -->
        <div id="navigation" class="clearfix">
        
			<?php if ($page['navigation']) : ?>
            <?php print drupal_render($page['navigation']); ?>
            <?php else : ?>
                <div id="main-menu">
                <?php print theme('links__system_main_menu', array(
                  'links' => $main_menu,
                  'attributes' => array(
                    'class' => array('links', 'main-menu', 'menu'),
                  ),
                  'heading' => array(
                    'text' => t('Main menu'),
                    'level' => 'h2',
                    'class' => array('element-invisible'),
                  ),
                )); ?>
                </div>
            <?php endif; ?>

        </div><!-- EOF: #navigation -->
        
        <!-- #page-content -->
        <div id="page-content" class="clearfix">
        
            <!-- #banner -->
            <?php if ($page['banner']): ?>
            <div id="banner" class="clearfix">
            <?php print render($page['banner']); ?>
            </div>
            <?php endif; ?>
            <!-- EOF: #banner -->
        
            <!-- #main -->
            <div id="main">
            
            	<?php print $messages; ?>
            
            	<?php if ($breadcrumb && theme_get_setting('breadcrumb_display')): ?>
                <div id="breadcrumb"  class="clearfix">
				<?php print $breadcrumb; ?>
                </div>
                <?php endif; ?>
            
                <?php if ($page['highlighted']): ?>
                <div id="highlighted" class="clearfix">
                <?php print render($page['highlighted']); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($tabs): ?>
                <div class="tabs">
                <?php print render($tabs); ?>
                </div>
                <?php endif; ?>
                
                <?php print render($page['help']); ?>
                
                <a id="main-content"></a>
                <?php print render($title_prefix); ?>
                <?php if ($title): ?>
                <h1 class="title"><?php print $title; ?></h1>
                <?php endif; ?>
                <?php print render($title_suffix); ?>
                
                <?php if ($action_links): ?>
                <ul class="action-links">
                <?php print render($action_links); ?>
                </ul>
                <?php endif; ?>
                
                <?php if ($is_front) {
				if (theme_get_setting('frontpage_content_print')):
                print render($page['content']);
				print $feed_icons;
				endif;
				} else {
				print render($page['content']);
				print $feed_icons;  
				} ?>
                
            </div><!-- EOF: #main -->
            
            <!-- #sidebar -->
            <?php if ($page['sidebar_first']): ?>
            <div id="sidebar">
            <?php print render($page['sidebar_first']); ?>
            </div>
            <?php endif; ?>
            <!-- EOF: #sidebar -->
            
            <?php if (theme_get_setting('scrolltop_display')): ?>
            <div id="scroll-to-top"><span class="scroll-text"><?php print t('Scroll to Top'); ?></span></div>
            <?php endif; ?>
                 
        </div><!-- EOF: #page-content -->
        
    </div><!-- EOF: #page-inside -->

</div><!-- EOF: #page -->

<!-- #footer -->
<div id="footer">

    <!-- #footer-inside -->
    <div id="footer-inside">
    
        <!-- #footer-first -->
        <div id="footer-first">
        <?php if ($page['footer_first']): ?>
		<?php print render($page['footer_first']); ?>
		<?php endif; ?>
        </div>
        <!-- EOF: #footer-first -->
        
        <!-- #footer-second -->
        <div id="footer-second">
        <?php if ($page['footer_second']): ?>
		<?php print render($page['footer_second']); ?>
		<?php endif; ?>
        </div><!-- EOF: #footer-second -->
        
        <!-- #footer-third -->
        <div id="footer-third">
        <?php if ($page['footer_third']): ?>
		<?php print render($page['footer_third']); ?>
		<?php endif; ?>
        </div><!-- EOF: #footer-third -->
   
    </div><!-- EOF: #footer-inside -->

</div><!-- EOF: #footer -->

<!-- #subfooter -->
<div id="subfooter">

    <!-- #subfooter-inside -->
    <div id="subfooter-inside">

        <!-- #subfooter-left -->
        <div id="subfooter-left">
		<?php print render($page['footer']); ?>
        </div><!-- EOF: #subfooter-left -->
        
        <!-- #subfooter-right -->
        <div id="subfooter-right">
		<?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('class' => array('secondary-menu', 'links', 'clearfix')))); ?>
        <?php print render($page['footer_bottom_right']); ?>
        </div><!-- EOF: #subfooter-right -->

    </div><!-- EOF: #subfooter-inside -->

</div><!-- EOF: #subfooter -->