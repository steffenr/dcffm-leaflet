<?php
/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function chique_breadcrumb($variables){
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    $breadcrumb[] = drupal_get_title();
    return '<div class="breadcrumb">' . implode(' <span class="breadcrumb-separator">/</span> ', $breadcrumb) . '</div>';
  }
}

/**
 * Override or insert variables into the html template.
 */
function chique_preprocess_html(&$variables) {

	$color_scheme = theme_get_setting('color_scheme');

	if ($color_scheme != 'default') {
	drupal_add_css(drupal_get_path('theme', 'chique') . '/style-' .$color_scheme. '.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	/**
	* Font settings
	*/
	// Adding Lato embedded font
	drupal_add_css(drupal_get_path('theme', 'chique') . '/font-styles/lato-font.css', array('group' => CSS_THEME, 'type' => 'file'));

	// Adding SortsMillGoudy embedded font
	drupal_add_css(drupal_get_path('theme', 'chique') . '/font-styles/sortsmillgoudy-font.css', array('group' => CSS_THEME, 'type' => 'file'));

	// Adding PT Serif embedded font
	if (theme_get_setting('sitename_font_family')=='sff-1' || theme_get_setting('paragraph_font_family')=='pff-4') {
	drupal_add_css(drupal_get_path('theme', 'chique') . '/font-styles/ptserif-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	// Adding PT Serif Caption embedded font
	if (theme_get_setting('sitename_font_family')=='sff-2') {
	drupal_add_css(drupal_get_path('theme', 'chique') . '/font-styles/ptserifcaption-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	// Adding PT_Sans embedded font
	if (theme_get_setting('headings_font_family')=='hff-1' || theme_get_setting('paragraph_font_family')=='pff-1') {
	drupal_add_css(drupal_get_path('theme', 'chique') . '/font-styles/ptsans-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	// Adding Podkova embedded font
	if (theme_get_setting('headings_font_family')=='hff-2') {
	drupal_add_css(drupal_get_path('theme', 'chique') . '/font-styles/podkova-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	// Adding Asap embedded font
	if (theme_get_setting('paragraph_font_family')=='pff-5') {
	drupal_add_css(drupal_get_path('theme', 'chique') . '/font-styles/asap-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

}

/**
 * Override or insert variables into the html template.
 */
function chique_process_html(&$vars) {

  $classes = explode(' ', $vars['classes']);
  $classes[] = theme_get_setting('page_bg');
  $classes[] = theme_get_setting('sitename_font_family');
  $classes[] = theme_get_setting('headings_font_family');
  $classes[] = theme_get_setting('paragraph_font_family');
  $vars['classes'] = trim(implode(' ', $classes));

}

function chique_preprocess_node(&$vars, $hook) {

$vars['submitted'] = t('!username - @datetime', array(
'!username' => $vars['name'],
'@datetime' => date("F j, Y", $vars['created']),
));

}

function chique_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {

    unset($form['search_block_form']['#title']);

    $form['search_block_form']['#title_display'] = 'invisible';
	$form_default = t('Enter your keywords to Search...');
    $form['search_block_form']['#default_value'] = $form_default;

	$color_scheme = theme_get_setting('color_scheme');
	$color_folder = '';
	if ($color_scheme != 'default') { $color_folder = '/' . theme_get_setting('color_scheme'); }

    $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images'. $color_folder . '/search-button.png');

 	$form['search_block_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = '{$form_default}';}", 'onfocus' => "if (this.value == '{$form_default}') {this.value = '';}" );
  }
}

/**
 * Add javascript for enable/disable scroll to top action button
 */
if (theme_get_setting('scrolltop_display')) {
drupal_add_js('jQuery(document).ready(function($) {

$("#scroll-to-top").click(function() {
	$("body,html").animate({scrollTop:0},800);
});

});',
array('type' => 'inline', 'scope' => 'header'));
}
//EOF:Javascript

/**
 * Add javascript for equal columns height
 */
drupal_add_js('
jQuery(document).ready(function($) {

var mainHeight = $("div#main").height();
var sidebarHeight = $("div#sidebar").height();

if (sidebarHeight > mainHeight) {
document.getElementById("main").style.minHeight = sidebarHeight+"px";
}

});
',array('type' => 'inline', 'scope' => 'footer'));
//EOF:Javascript

?>