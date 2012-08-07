<?php

/**
 * Add body classes if certain regions have content.
 */
function apple_preprocess_html(&$variables) {
  if (!empty($variables['page']['featured'])) {
    $variables['classes_array'][] = 'featured';
  }

  if (!empty($variables['page']['triptych_first'])
    || !empty($variables['page']['triptych_middle'])
    || !empty($variables['page']['triptych_last'])) {
    $variables['classes_array'][] = 'triptych';
  }

  if (!empty($variables['page']['footer_firstcolumn'])
    || !empty($variables['page']['footer_secondcolumn'])
    || !empty($variables['page']['footer_thirdcolumn'])
    || !empty($variables['page']['footer_fourthcolumn'])) {
    $variables['classes_array'][] = 'footer-columns';
  }
  if (!(arg(0) == 'node' && arg(1) != null )) {
  	drupal_add_css(path_to_theme(). "/css/layout.css",array('media' => 'all','group' => CSS_DEFAULT, 'every_page' => TRUE));
  	drupal_add_css(path_to_theme(). "/css/style.css",array('media' => 'all','group' => CSS_DEFAULT, 'every_page' => TRUE));
  	drupal_add_css(path_to_theme(). "/css/colors.css",array('media' => 'all','group' => CSS_DEFAULT, 'every_page' => TRUE));
  	drupal_add_css(path_to_theme(). "/css/print.css",array('media' => 'print','group' => CSS_DEFAULT, 'every_page' => TRUE));
  }else {
  	$css = drupal_add_css();
	unset($css[drupal_get_path('module','system').'/system.base.css']); 
    unset($css[drupal_get_path('module','system').'/system.menus.css']);
    unset($css[drupal_get_path('module','system').'/system.messages.css']);
    unset($css[drupal_get_path('module','system').'/system.theme.css']);
    unset($css[drupal_get_path('module','system').'/comment.css']);
    unset($css[drupal_get_path('module','system').'/field.css']);
    unset($css[drupal_get_path('module','system').'/node.css']);
    unset($css[drupal_get_path('module','system').'/search.css']);
    unset($css[drupal_get_path('module','system').'/user.css']);
	$variables['styles'] = drupal_get_css($css);
  }

  // Add conditional stylesheets for IE
  drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
  drupal_add_css(path_to_theme() . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function apple_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function apple_process_page(&$variables) {
	if (arg(0) == 'taxonomy')
	{
	    $variables['theme_hook_suggestions'][] = 'page__'.arg(0);
  	}  
}


/**
 * Override or insert variables into the node template.
 */
function apple_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
    drupal_add_css(path_to_theme(). "/css/39art2010.css", "theme");
  }
  	
	//优先级越后越高
  	if($variables['type'] == 'article')
  	{
  		$variables['theme_hook_suggestions'][] = 'node__'.$variables['type'];
  	}
	if(arg(0) == 'taxonomy')
	{
    	$variables['theme_hook_suggestions'][] = 'node__'.arg(0);
 	}
  	
}

/**
 * Override or insert variables into the block template.
 */
function apple_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}


/**
 * Implements theme_menu_tree().
 */
function apple_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function apple_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</div>';

  return $output;
}


function apple_css_alter(&$css) {
    
}
