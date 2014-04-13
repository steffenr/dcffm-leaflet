<?php

/**
 * Implements template_preprocess_field().
 */
function dcffm_preprocess_field(&$variables, $hook) {
  $element = $variables['element'];
  // Add additional link to geofield map to link to google maps
  // for route planning and more
  if ($element['#field_name'] == 'field_sight_geo') {
    $sight_wrapper = entity_metadata_wrapper('node', $element['#object']);
    $address = $sight_wrapper->field_sight_address->value();
    $geodata = $sight_wrapper->field_sight_geo->value();
    $lat_lon = round($geodata['lat'], 4) . ', ' . round($geodata['lon'], 4);

    // Check for locality - if not provided use lat/lon.
    if (!empty($address['locality'])) {
      $url_params = $address['thoroughfare'] . ',' . $address['postal_code'] . ' ' . $address['locality'] . ',Deutschland';
    } else {
      $url_params = $lat_lon;
    }

    $link_to_gmap = l('Hier gelangen Sie zur größeren Kartenansicht', 'https://maps.google.com/maps', array(
      'query' => array(
        'q' => $url_params,
        'z' => 16,
        'hl' => 'de'),
      'attributes' => array(
        'target' => '_blank',
        'external' => 'true')));
    $variables['link_to_gmap'] = $link_to_gmap;
    $variables['geodata_gmap'] = t('Latitude/ Longitude: ') . $lat_lon;

  }
}

/**
 * Themes a select element as a set of checkboxes
 *
 * @see theme_select(), http://api.drupal.org/api/function/theme_select/6
 * @param array $vars - An array of arrays, the 'element' item holds the properties of the element.
 *                      Properties used: title, value, options, description
 * @return HTML string representing the form element.
 */
function dcffm_select_as_checkboxes($vars) {
  $element = $vars['element'];
  if (!empty($element['#bef_nested'])) {
    if (empty($element['#attributes']['class'])) {
      $element['#attributes']['class'] = array();
    }
    $element['#attributes']['class'][] = 'form-checkboxes';
    return theme('select_as_tree', array(
      'element' => $element));
  }

  // the selected keys from #options
  $selected_options = empty($element['#value']) ? $element['#default_value'] : $element['#value'];

  // Grab exposed filter description.  We'll put it under the label where it makes more sense.
  $description = '';
  if (!empty($element['#bef_description'])) {
    $description = '<div class="description">' . $element['#bef_description'] . '</div>';
  }

  $output = '<div class="bef-checkboxes">';
  foreach ($element['#options'] as $option => $elem) {
    if ('All' === $option) {
      // TODO: 'All' text is customizable in Views
      // No need for an 'All' option -- either unchecking or checking all the checkboxes is equivalent
      continue;
    }

    // Check for Taxonomy-based filters
    if (is_object($elem)) {
      $slice = array_slice($elem->option, 0, 1, TRUE);
      list($option, $elem) = each($slice);
    }

    /*
     * Check for optgroups.  Put subelements in the $element_set array and add a group heading.
     * Otherwise, just add the element to the set
     */
    $element_set = array();
    $is_optgroup = FALSE;
    if (is_array($elem)) {
      $output .= '<div class="bef-group">';
      $output .= '<div class="bef-group-heading">' . $option . '</div>';
      $output .= '<div class="bef-group-items">';
      $element_set = $elem;
      $is_optgroup = TRUE;
    }
    else {
      $wrapped_term = entity_metadata_wrapper('taxonomy_term', $option);
      $category_icon = $wrapped_term->field_sight_icon->value();
      $icon_url = '';
      if (!empty($category_icon)) {
        $icon_url = theme_image(array(
          'path' => $category_icon['uri'], 'attributes' => array()));
      }
      $element_set[$option] = $icon_url . $elem;
    }

    foreach ($element_set as $key => $value) {
      $output .= dcffm_bef_checkbox($element, $key, $value, array_search($key, $selected_options) !== FALSE);
    }

    if ($is_optgroup) {
      $output .= '</div></div>';    // Close group and item <div>s
    }
  }
  $output .= '</div>';

  // Fake theme_checkboxes() which we can't call because it calls theme_form_element() for each option
  $attributes['class'] = array(
    'form-checkboxes',
    'bef-select-as-checkboxes');
  if (!empty($element['#bef_select_all_none'])) {
    $attributes['class'][] = 'bef-select-all-none';
  }
  if (!empty($element['#attributes']['class'])) {
    $attributes['class'] = array_merge($element['#attributes']['class'], $attributes['class']);
  }

  return '<div' . drupal_attributes($attributes) . ">$description$output</div>";
}

/**
 * Custom function to create checkboxes with icons in front of labels.
 */
function dcffm_bef_checkbox($element, $value, $label, $selected) {
  $value = check_plain($value);
  $id = drupal_html_id($element['#id'] . '-' . $value);
  // Custom ID for each checkbox based on the <select>'s original ID
  $properties = array(
    '#required' => FALSE,
    '#id' => $id,
    '#type' => 'bef-checkbox',
    '#name' => $id,
  );

  // Prevent the select-all-none class from cascading to all checkboxes
  if (!empty($element['#attributes']['class']) && FALSE !== ($key = array_search('bef-select-all-none', $element['#attributes']['class']))) {
    unset($element['#attributes']['class'][$key]);
  }

  // Unset the name attribute as we are setting it manually.
  unset($element['#attributes']['name']);

  $checkbox = '<input type="checkbox" '
    . 'name="' . $element['#name'] . '[]" '    // brackets are key -- just like select
    . 'id="' . $id . '" '
    . 'value="' . $value . '" '
    . ($selected ? 'checked="checked" ' : '')
    . drupal_attributes($element['#attributes']) . ' />';
  $properties['#children'] = $checkbox . '<label class="option" for=' . $id . '> ' . $label . '</label>';
  $output = theme('form_element', array(
    'element' => $properties));
  return $output;
}

/**
 * Override variables used in views template for fields.
 *
 * @see views-view-fields.tpl.php
 */
function dcffm_preprocess_views_view_fields(&$vars) {
  // Until http://drupal.org/node/939462 lands for Drupal 7 we need to specify
  // the specific preprocess functions ourself.
  $preprocess_names = array();
  $preprocess_names[] = sprintf('%s__%s', __FUNCTION__, $vars['view']->name);
  $preprocess_names[] = sprintf('%s__%s__%s', __FUNCTION__, $vars['view']->name, $vars['view']->current_display);
  // Call more specific preprocess functions.
  foreach ($preprocess_names as $function) {
    if (function_exists($function)) {
      call_user_func_array($function, array(
        &$vars));
    }
  }
}

/**
 * Override variables used in views template for a single field.
 *
 * @see views-view-field.tpl.php
 */
function dcffm_preprocess_views_view_field(&$vars) {
  // Until http://drupal.org/node/939462 lands for Drupal 7 we need to specify
  // the specific preprocess functions ourself.
  $preprocess_names = array();
  $preprocess_names[] = sprintf('%s__%s', __FUNCTION__, $vars['view']->name);
  $preprocess_names[] = sprintf('%s__%s__%s', __FUNCTION__, $vars['view']->name, $vars['view']->current_display);
  $preprocess_names[] = sprintf('%s__%s__field_%s', __FUNCTION__, $vars['view']->name, $vars['field']->options['id']);
  $preprocess_names[] = sprintf('%s__%s__%s__%s', __FUNCTION__, $vars['view']->name, $vars['view']->current_display, $vars['field']->options['id']);
  // Call more specific preprocess functions.
  foreach ($preprocess_names as $function) {
    if (function_exists($function)) {
      call_user_func_array($function, array(
        &$vars));
    }
  }
}

/**
 * Implements theme_preprocess_views_view_field for title field sights_embed.
 */
function dcffm_preprocess_views_view_field__sights__embed_sights_list__title(&$vars) {
  // We build a custom link for title containing geodata as data-attributes.
  $row = $vars['row'];
  $geo_data = $row->field_field_sight_geo[0]['raw'];
  $title = $row->node_title;
  $nid = $row->nid;
  $output = l($title, 'node/' . $nid, array(
    'attributes' => array(
      'data-lat' => $geo_data['lat'],
      'data-lon' => $geo_data['lon']
  )));
  $vars['output'] = $output;
}

/**
 * Implements theme_preprocess_views_view_field for category field sights_embed.
 */
function dcffm_preprocess_views_view_field__sights__embed_sights_list__field_sight_category(&$vars) {
  // We build a custom link for title containing geodata as data-attributes.
  $row = $vars['row'];
  $wrapped_term = entity_metadata_wrapper('taxonomy_term', $row->field_field_sight_category[0]['raw']['tid']);
  $category_icon = $wrapped_term->field_sight_icon->value();
  $icon_url = '';
  if (!empty($category_icon)) {
    $icon_url = theme_image(array('path' => $category_icon['uri'], 'attributes' => array())) . ' ';
  }
  $vars['output'] = $icon_url . $vars['output'];
}
