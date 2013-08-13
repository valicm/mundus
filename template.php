<?php

/**
 * Implements hook_preprocess_page()
 */
function mundus_preprocess_page(&$variables) {

  /** RENDER SEARCH FROM INSIDE PAGE TEMPLATE **/
  $mundus_search = drupal_render(drupal_get_form('search_form'));
  $variables['mundus_search'] = $mundus_search;

}

/**
*Implements hook_preprocess_html()
*/
function mundus_preprocess_html(&$variables) {

  /** Implements  adding Google fonts **/
  if (theme_get_setting('google_font_name')&('google_font_body')) {

    drupal_add_css('http://fonts.googleapis.com/css?family='.theme_get_setting('google_font_name').'|'.theme_get_setting('google_font_body').'',
      array(
        'type' => 'external'
        ));

    drupal_add_css('h1,h2,h3,h4,h5,h6 {font-family: '.theme_get_setting('google_font_name').'; }body {font-family: '.theme_get_setting('google_font_body').';}',
      array(
        'group' => CSS_THEME,
        'type' => 'inline'
        ));
  }
  else
  {
    drupal_add_css('http://fonts.googleapis.com/css?family=Merriweather+Sans|Ubuntu', array('type' => 'external'));
  }

  /** ADD FIXES FOR IE8 foundation grid **/
  drupal_add_css(drupal_get_path('theme', 'mundus') . '/css/foundation/foundation_ie8.css', array(
    'group' => CSS_THEME,
    'browsers' => array(
      'IE' => 'lt IE 9',
      '!IE' => FALSE
      ),
    'preprocess' => TRUE
    ));

  /** ADD FIXES FOR IE8 mundus style **/
  drupal_add_css(drupal_get_path('theme', 'mundus') . '/css/mundus_ie8.css', array(
    'group' => CSS_THEME,
    'browsers' => array(
      'IE' => 'lt IE 9',
      '!IE' => FALSE
      ),
    'preprocess' => TRUE
    ));

  /** ADD FIXES FOR IE7 mundus style **/
  drupal_add_css(drupal_get_path('theme', 'mundus') . '/css/foundation/foundation_mundus_ie7.css', array(
    'group' => CSS_THEME,
    'browsers' => array(
      'IE' => 'lt IE 8',
      '!IE' => FALSE
      ),
    'preprocess' => TRUE
    ));

  /**  Load color style from theme settings **/
  drupal_add_css(drupal_get_path('theme', 'mundus') . '/css/style/'.theme_get_setting('mundus_style').'.css',
    array(
      'group' => CSS_THEME,
      'type' => 'file'
      ));
}

/** Add mobile viewport, force IE to chrome frame **/
function mundus_html_head_alter(&$head_elements) {
  // HTML5 charset declaration.
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8',
    );

  // Optimize mobile viewport.
  $head_elements['mobile_viewport'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width',
      ),
    );

  // Force IE to use Chrome Frame if installed.
  $head_elements['chrome_frame'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'content' => 'ie=edge, chrome=1',
      'http-equiv' => 'x-ua-compatible',
      ),
    );

  // Remove image toolbar in IE.
  $head_elements['ie_image_toolbar'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'ImageToolbar',
      'content' => 'false',
      ),
    );
}

/**
 * Remove default css files from Drupal.
 */

function mundus_css_alter(&$css) {

  $remove = array(
    'misc/vertical-tabs.css',
    'misc/vertical-tabs-rtl.css',
    'misc/ui/jquery.ui.core.css',
    'misc/ui/jquery.ui.theme.css',
    'modules/aggregator/aggregator.css',
    'modules/poll/poll.css',
    'modules/comment/comment.css',
    'modules/comment/comment-rtl.css',
    'modules/field/theme/field.css',
    'modules/field/theme/field-rtl.css',
    'modules/file/file.css',
    'modules/filter/filter.css',
    'modules/node/node.css',
    'modules/search/search.css',
    'modules/search/search-rtl.css',
    'modules/system/system.admin.css',
    'modules/system/system.admin-rtl.css',
    'modules/system/system.maintenance.css',
    'modules/system/system.menus.css',
    'modules/system/system.menus-rtl.css',
    'modules/system/system.messages.css',
    'modules/system/system.messages-rtl.css',
    'modules/system/system.theme.css',
    'modules/system/system.theme-rtl.css',
    'modules/user/user.css',
    'modules/user/user-rtl.css',
    'sites/all/modules/ctools/css/ctools.css',
    );
foreach ($remove as $value) {
  unset($css[$value]);
}
}

/**
 * Style main menu / show submenu as dropdown
 */

function mundus_links__system_main_menu($vars) {
  // Get all the main menu links
  $menu_links = menu_tree_output(menu_tree_all_data('main-menu'));

  // Initialize some variables to prevent errors
  $output = '';
  $sub_menu = '';

  foreach ($menu_links as $key => $link) {
    // Add special class needed for Foundation dropdown menu to work
    !empty($link['#below']) ? $link['#attributes']['class'][] = 'has-dropdown' : '';

    // Render top level and make sure we have an actual link
    if (!empty($link['#href'])) {
      $output .= '<li' . drupal_attributes($link['#attributes']) . '>' . l($link['#title'], $link['#href']);
      // Get sub navigation links if they exist
      foreach ($link['#below'] as $key => $sub_link) {
        if (!empty($sub_link['#href'])) {
          $sub_menu .= '<li class="submenu">' . l($sub_link['#title'], $sub_link['#href']) . '</li>';
        }
      }
      $output .= !empty($link['#below']) ? '<ul class="dropdown">' . $sub_menu . '</ul>' : '';

      // Reset dropdown to prevent duplicates
      unset($sub_menu);
      $sub_menu = '';

      $output .=  '</li>';
    }
  }
  return '<ul class="left">' . $output . '</ul>';
}

/**
 * Remove filter tips from comment form.
 */

function mundus_form_comment_form_alter(&$form, &$form_state) {

  $form['comment_body']['#after_build'][] = 'mundus_customize_comment_form';
  $form['author']['homepage']['#access'] = FALSE;

}

function mundus_customize_comment_form(&$form) {
  $form[LANGUAGE_NONE][0]['format']['#access'] = FALSE;
  return $form;
}

/**
* Adding separate template for teaser / adding block region to node template
*/
function mundus_preprocess_node(&$variables){

  //If the node is a teaser
  if($variables['teaser']){
    //Allow us to use a different template
    $variables['theme_hook_suggestions'][] = 'node__' . $variables['node']->type . '_teaser';
  }
  //Adding block region to node.tpl.php
  if ($blocks = block_get_blocks_by_region('node_block')) {
    $variables['node_block'] = $blocks;
  }
}

/**
 * Override for node teaser - display single image.
 */
function mundus_process_field(&$vars) {
  $element = $vars['element'];
  // Field type image
  if ($element['#field_type'] == 'image') {
    // Reduce number of images in teaser view mode to single image
    if ($element['#view_mode'] == 'teaser') {
      $item = reset($vars['items']);
      $vars['items'] = array($item);
    }
  }

}

/**
* Label theming
*/
function mundus_field($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div ' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }

  foreach ($variables['items'] as $delta => $item) {
    $output .= drupal_render($item);
  }

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}


function mundus_form_alter(&$form, &$form_state) {

  // Button style submit
  if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
    $form['actions']['submit']['#attributes'] = array('class' => array('secondary', 'small button', 'radius'));
  }
  // Button style preview
  if (!empty($form['actions']) && !empty($form['actions']['preview'])) {
    $form['actions']['preview']['#attributes'] = array('class' => array('secondary', 'small button', 'radius'));
  }
  // Button style delete
  if (!empty($form['actions']) && !empty($form['actions']['delete'])) {
    $form['actions']['delete']['#attributes'] = array('class' => array('secondary', 'small button', 'radius'));
  }
}

/**
 * Breadcrumb
 */
function mundus_breadcrumb($vars) {
  $breadcrumb = $vars['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $breadcrumbs = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $breadcrumbs .= '<ul class="breadcrumbs">';

    foreach ($breadcrumb as $key => $value) {
      $breadcrumbs .= '<li>' . $value . '</li>';
    }

    $title = strip_tags(drupal_get_title());
    $breadcrumbs .= '<li class="current"><a href="#">' . $title. '</a></li>';
    $breadcrumbs .= '</ul>';

    return $breadcrumbs;
  }
}

/** FUNCTION FOR USING SLIDESHOW ON VIEWS **/

function mundus_preprocess_views_view_list(&$vars) {
  $handler  = $vars['view']->style_plugin;

  $class = explode(' ', $handler->options['class']);
  $class = array_map('views_clean_css_identifier', $class);

  $vars['class'] = implode(' ', $class);

    if ($vars['class'] == 'data-orbit') {
    $vars['list_type_prefix'] = '<' . $handler->options['type'] . ' ' . $vars['class'] . '>';
  }
}
