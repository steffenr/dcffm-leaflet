<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function chique_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['mtt_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('MtT Theme Settings'),
    '#collapsible' => FALSE,
	'#collapsed' => FALSE,
  );

  $form['mtt_settings']['tabs'] = array(
    '#type' => 'vertical_tabs',
	'#attached' => array(
      'css' => array(drupal_get_path('theme', 'chique') . '/chique.settings.form.css'),
    ),
  );
  
  $form['mtt_settings']['tabs']['basic_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Basic Settings'),
    '#collapsible' => TRUE,
	'#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['breadcrumb'] = array(
   '#type' => 'item',
   '#markup' => t('<div class="theme-settings-title">Breadcrumb</div>'),
  );

  $form['mtt_settings']['tabs']['basic_settings']['breadcrumb_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show breadcrumb'),
  	'#description'   => t('Use the checkbox to enable or disable Breadcrumb.'),
	'#default_value' => theme_get_setting('breadcrumb_display', 'chique'),
    '#collapsible' => TRUE,
	'#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['scrolltop'] = array(
   '#type' => 'item',
   '#markup' => t('<div class="theme-settings-title">Scroll to top</div>'),
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['scrolltop_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show scroll-to-top button'),
  	'#description'   => t('Use the checkbox to enable or disable scroll-to-top button.'),
	'#default_value' => theme_get_setting('scrolltop_display', 'chique'),
    '#collapsible' => TRUE,
	'#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['frontpage_content'] = array(
   '#type' => 'item',
   '#markup' => t('<div class="theme-settings-title">Front Page Behavior</div>'),
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['frontpage_content_print'] = array(
    '#type' => 'checkbox',
    '#title' => t('Drupal frontpage content'),
  	'#description'   => t('Use the checkbox to enable or disable the Drupal default frontpage functionality. Enable this to have all the promoted content displayed in the frontpage.'),
	'#default_value' => theme_get_setting('frontpage_content_print', 'chique'),
    '#collapsible' => TRUE,
	'#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['looknfeel'] = array(
    '#type' => 'fieldset',
    '#title' => t('Look\'n\'Feel'),
    '#collapsible' => TRUE,
	'#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['looknfeel']['color_scheme'] = array(
    '#type' => 'select',
    '#title' => t('Color Schemes'),
  	'#description'   => t('From the drop-down menu, select the color scheme you prefer.'),
	'#default_value' => theme_get_setting('color_scheme', 'chique'),
    '#options' => array(
		'default' => t('Brown/Default'),
		'gray' => t('Gray'),
		'purple' => t('Purple'),
		'green' => t('Green'),
		'blue' => t('Blue'),
    ),
  );
  
  $form['mtt_settings']['tabs']['looknfeel']['page_bg'] = array(
    '#type' => 'select',
    '#title' => t('Background pattern'),
	'#description'   => t('All patterns are designed so you can use them in combination with any of the available color schemes.'),
	'#default_value' => theme_get_setting('page_bg', 'chique'),
    '#options' => array(
		'bg-default' => t('Dark & elegant vertical stripes/Default'),
		'bg-1' => t('Bright diagonal lines'),
		'bg-2' => t('Dark diagonal lines'),
		'bg-3' => t('Bright vertical lines'),
		'bg-4' => t('Dark vertical lines'),
		'bg-5' => t('Bright horizontal lines'),
		'bg-6' => t('Dark horizontal lines'),
		'bg-7' => t('Bright vertical stripes'),
		'bg-8' => t('Dark vertical stripes'),
		'bg-9' => t('Bright & elegant vertical stripes'),
		'bg-10' => t('Flowers'),
		'bg-11' => t('Noise'),
    ),
  );
  
  $form['mtt_settings']['tabs']['font'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font Settings'),
    '#collapsible' => TRUE,
	'#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['font']['font_title'] = array(
   '#type' => 'item',
   '#markup' => 'For every region pick the <strong>font-family</strong> that corresponds to your needs.',
  );
  
  $form['mtt_settings']['tabs']['font']['sitename_font_family'] = array(
    '#type' => 'select',
    '#title' => t('Site name'),
	'#default_value' => theme_get_setting('sitename_font_family', 'chique'),
    '#options' => array(
		'sff-default' => t('Sorts Mill Goudy, Helvetica, Arial, Sans-serif'),
		'sff-1' => t('PT Serif, Times, Times New Roman, Serif'),
		'sff-2' => t('PT Serif Caption, Times, Times New Roman, Serif'),
    ),
  );
  
  $form['mtt_settings']['tabs']['font']['headings_font_family'] = array(
    '#type' => 'select',
    '#title' => t('Headings'),
	'#default_value' => theme_get_setting('headings_font_family', 'chique'),
    '#options' => array(
		'hff-default' => t('Georgia, Helvetica Neue, Helvetica, Arial, Free Sans, Sans-serif'),
		'hff-1' => t('PT Sans, Myriad Pro, Helvetica, Arial, Free Sans, Sans-serif'),
		'hff-2' => t('Podkova, Georgia, Serif'),
    ),
  );
  
 $form['mtt_settings']['tabs']['font']['paragraph_font_family'] = array(
    '#type' => 'select',
    '#title' => t('Paragraph'),
	'#default_value' => theme_get_setting('paragraph_font_family', 'chique'),
    '#options' => array(
		'pff-default' => t('Lato, Helvetica Neue, Helvetica, Arial, Free Sans, Sans-serif'),
		'pff-1' => t('PT Sans, Myriad Pro, Helvetica, Arial, Free Sans, Sans-serif'),
		'pff-2' => t('Myriad Pro, Helvetica, Arial, Free Sans, Sans-serif'),
		'pff-3' => t('Georgia, Times, Times New Roman, Serif'),
		'pff-4' => t('PT Serif, Times, Times New Roman, Serif'),
		'pff-5' => t('Asap, Helvetica, Arial, Free Sans, Sans-serif'),
    ),
  );
  
  $form['mtt_settings']['tabs']['slideshow'] = array(
    '#type' => 'fieldset',
    '#title' => t('Slideshow'),
    '#collapsible' => TRUE,
	'#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['slideshow']['slideshow_effect'] = array(
    '#type' => 'select',
    '#title' => t('Effects'),
  	'#description'   => t('From the drop-down menu, select the slideshow effect you prefer.'),
	'#default_value' => theme_get_setting('slideshow_effect', 'chique'),
    '#options' => array(
		'blindX' => t('blindX'),
		'blindY' => t('blindY'),
		'blindZ' => t('blindZ'),
		'cover' => t('cover'),
		'curtainX' => t('curtainX'),
		'curtainY' => t('curtainY'),
		'fade' => t('fade'),
		'fadeZoom' => t('fadeZoom'),
		'growX' => t('growX'),
		'growY' => t('growY'),
		'scrollUp' => t('scrollUp'),
		'scrollDown' => t('scrollDown'),
		'scrollLeft' => t('scrollLeft'),
		'scrollRight' => t('scrollRight'),
		'scrollHorz' => t('scrollHorz'),
		'scrollVert' => t('scrollVert'),
		'shuffle' => t('shuffle'),
		'slideX' => t('slideX'),
		'slideY' => t('slideY'),
		'toss' => t('toss'),
		'turnUp' => t('turnUp'),
		'turnDown' => t('turnDown'),
		'turnLeft' => t('turnLeft'),
		'turnRight' => t('turnRight'),
		'uncover' => t('uncover'),
		'wipe' => t('wipe'),
		'zoom' => t('zoom'),
    ),
  );

  $form['mtt_settings']['tabs']['slideshow']['slideshow_effect_time'] = array(
    '#type' => 'textfield',
    '#title' => t('Effect duration (sec)'),
	'#default_value' => theme_get_setting('slideshow_effect_time', 'chique'),
  );
    
  $form['mtt_settings']['tabs']['slideshow']['slideshow_thumbnails'] = array(
    '#type' => 'checkbox',
    '#title' => t('Always display thumbnails'),
  	'#description'   => t('Check this box to always display thumbnails on the slide show. If you uncheck these will be shown only on mouse over.'),
	'#default_value' => theme_get_setting('slideshow_thumbnails', 'chique'),
    '#collapsible' => TRUE,
	'#collapsed' => TRUE,
  );
  
}
