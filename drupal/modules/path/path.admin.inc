<?php

/**
 * @file
 * Administrative page callbacks for the path module.
 */

/**
 * Menu callback: path administration.
 */
function path_admin_content($form, $form_state, $keys = NULL) {

  $form['filter'] = path_admin_filter_form($form, $form_state,$keys);
  
  // Build the 'Update options' form.
  $form['options'] = array(
    '#type' => 'fieldset',
    '#title' => t('Update options'),
    '#attributes' => array('class' => array('container-inline')),
  );
  
  $options = array();
  foreach (module_invoke_all('path_operations') as $operation => $array) {
    $options[$operation] = $array['label'];
  }
  $form['options']['operation'] = array(
    '#type' => 'select',
    '#title' => t('Operation'),
    '#title_display' => 'invisible',
    '#options' => $options,
    '#default_value' => 'approve',
  );
  
  $form['options']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Update'),
    '#validate' => array('path_admin_form_update_validate'),
    '#submit' => array('path_admin_form_update_submit'),
  );
  
  //$form['#submit'][] = 'path_admin_filter_form_submit';
  $form['admin'] = path_admin_overview($keys);

  return $form;
}

/**
 * Returns a listing of all defined URL aliases.
 *
 * When filter key passed, perform a standard search on the given key,
 * and return the list of matching URL aliases.
 */
function path_admin_overview($keys = NULL) {
  // Add the filter form above the overview table.
  //$build['path_admin_filter_form'] = drupal_get_form('path_admin_filter_form', $keys);
  
  
  // Enable language column if locale is enabled or if we have any alias with language
  $alias_exists = (bool) db_query_range('SELECT 1 FROM {url_alias} WHERE language <> :language', 0, 1, array(':language' => LANGUAGE_NONE))->fetchField();
  $multilanguage = (module_exists('locale') || $alias_exists);

  $header = array();

  $header['alias'] = array('data' => t('Alias'), 'field' => 'alias', 'sort' => 'asc');
  $header['source'] = array('data' => t('System'), 'field' => 'source');
  if ($multilanguage) {
    $header['language'] = array('data' => t('Language'), 'field' => 'language');
  }
  $header['operations'] = array('data' => t('Operations'));

  $query = db_select('url_alias')->extend('PagerDefault')->extend('TableSort');
  if ($keys) {
    // Replace wildcards with PDO wildcards.
    $query->condition('alias', '%' . preg_replace('!\*+!', '%', $keys) . '%', 'LIKE');
  }
  $result = $query
    ->fields('url_alias')
    ->orderByHeader($header)
    ->limit(50)
    ->execute();

  $rows = array();
  $destination = drupal_get_destination();
  foreach ($result as $data) {
    $row = array();

    $row['alias']['data'] = l($data->alias, $data->source);
    $row['source']['data'] = l($data->source, $data->source, array('alias' => TRUE));
    if ($multilanguage) {
      $row['language']['data'] = module_invoke('locale', 'language_name', $data->language);
    }

    $operations = array();
    $operations['edit'] = array(
      'title' => t('edit'),
      'href' => "admin/config/search/path/edit/$data->pid",
      'query' => $destination,
    );
    $operations['delete'] = array(
      'title' => t('delete'),
      'href' => "admin/config/search/path/delete/$data->pid",
      'query' => $destination,
    );
    $row['operations']['data'] = array(
      'data' => array(
        '#theme' => 'links',
        '#links' => $operations,
        '#attributes' => array('class' => array('links', 'inline', 'nowrap')),
      ),
    );

    // If the system path maps to a different URL alias, highlight this table
    // row to let the user know of old aliases.
    if ($data->alias != drupal_get_path_alias($data->source, $data->language)) {
      $row['class'] = array('warning');
    }

    $rows[$data->pid] = $row;
  }

  $build['pathes'] = array(
    '#type' => 'tableselect',
    '#header' => $header,
    '#options' => $rows,
    '#empty' => t('No URL aliases available. <a href="@link">Add URL alias</a>.', array('@link' => url('admin/config/search/path/add'))),
  );
  $build['path_pager'] = array('#theme' => 'pager');

  return $build;
}

/**
 * Page callback: Returns a form creating or editing a path alias.
 *
 * @param $path
 *   An array containing the path ID, source, alias, and language code.
 *
 * @return
 *   A form for adding or editing a URL alias.
 *
 * @see path_menu()
 */
function path_admin_edit($path = array()) {
  if ($path) {
    drupal_set_title($path['alias']);
    $output = drupal_get_form('path_admin_form', $path);
  }
  else {
    $output = drupal_get_form('path_admin_form');
  }

  return $output;
}

/**
 * Form constructor for the path administration form.
 *
 * @param $path
 *   An array containing the path ID, source, alias, and language code.
 *
 * @ingroup forms
 * @see path_admin_form_validate()
 * @see path_admin_form_submit()
 * @see path_admin_form_delete_submit()
 */
function path_admin_form($form, &$form_state, $path = array('source' => '', 'alias' => '', 'language' => LANGUAGE_NONE, 'pid' => NULL)) {
  $form['source'] = array(
    '#type' => 'textfield',
    '#title' => t('Existing system path'),
    '#default_value' => $path['source'],
    '#maxlength' => 255,
    '#size' => 45,
    '#description' => t('Specify the existing path you wish to alias. For example: node/28, forum/1, taxonomy/term/1.'),
    '#field_prefix' => url(NULL, array('absolute' => TRUE)) . (variable_get('clean_url', 0) ? '' : '?q='),
    '#required' => TRUE,
  );
  $form['alias'] = array(
    '#type' => 'textfield',
    '#title' => t('Path alias'),
    '#default_value' => $path['alias'],
    '#maxlength' => 255,
    '#size' => 45,
    '#description' => t('Specify an alternative path by which this data can be accessed. For example, type "about" when writing an about page. Use a relative path and don\'t add a trailing slash or the URL alias won\'t work.'),
    '#field_prefix' => url(NULL, array('absolute' => TRUE)) . (variable_get('clean_url', 0) ? '' : '?q='),
    '#required' => TRUE,
  );

  // This will be a hidden value unless locale module is enabled.
  $form['language'] = array(
    '#type' => 'value',
    '#value' => $path['language']
  );

  $form['actions'] = array('#type' => 'actions');
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );
  if ($path['pid']) {
    $form['pid'] = array(
      '#type' => 'hidden',
      '#value' => $path['pid'],
    );
    $form['actions']['delete'] = array(
      '#type' => 'submit',
      '#value' => t('Delete'),
      '#submit' => array('path_admin_form_delete_submit'),
    );
  }

  return $form;
}

/**
 * Form submission handler for the 'Delete' button on path_admin_form().
 *
 * @see path_admin_form_validate()
 * @see path_admin_form_submit()
 */
function path_admin_form_delete_submit($form, &$form_state) {
  $destination = array();
  if (isset($_GET['destination'])) {
    $destination = drupal_get_destination();
    unset($_GET['destination']);
  }
  $form_state['redirect'] = array('admin/config/search/path/delete/' . $form_state['values']['pid'], array('query' => $destination));
}

/**
 * Form validation handler for path_admin_form().
 *
 * @see path_admin_form_submit()
 * @see path_admin_form_delete_submit()
 */
function path_admin_form_validate($form, &$form_state) {
  $source = &$form_state['values']['source'];
  $source = drupal_get_normal_path($source);
  $alias = $form_state['values']['alias'];
  $pid = isset($form_state['values']['pid']) ? $form_state['values']['pid'] : 0;
  // Language is only set if locale module is enabled, otherwise save for all languages.
  $language = isset($form_state['values']['language']) ? $form_state['values']['language'] : LANGUAGE_NONE;

  $has_alias = db_query("SELECT COUNT(alias) FROM {url_alias} WHERE pid <> :pid AND alias = :alias AND language = :language", array(
      ':pid' => $pid,
      ':alias' => $alias,
      ':language' => $language,
    ))
    ->fetchField();

  if ($has_alias) {
    form_set_error('alias', t('The alias %alias is already in use in this language.', array('%alias' => $alias)));
  }
  if (!drupal_valid_path($source)) {
    form_set_error('source', t("The path '@link_path' is either invalid or you do not have access to it.", array('@link_path' => $source)));
  }
}

/**
 * Form submission handler for path_admin_form().
 *
 * @see path_admin_form_validate()
 * @see path_admin_form_delete_submit()
 */
function path_admin_form_submit($form, &$form_state) {
  // Remove unnecessary values.
  form_state_values_clean($form_state);

  path_save($form_state['values']);

  drupal_set_message(t('The alias has been saved.'));
  $form_state['redirect'] = 'admin/config/search/path';
}

/**
 * Form constructor for the path deletion form.
 *
 * @param $path
 *   The path alias that will be deleted.
 *
 * @see path_admin_delete_confirm_submit()
 */
function path_admin_delete_confirm($form, &$form_state, $path) {
  if (user_access('administer url aliases')) {
    $form_state['path'] = $path;
    return confirm_form(
      $form,
      t('Are you sure you want to delete path alias %title?',
      array('%title' => $path['alias'])),
      'admin/config/search/path'
    );
  }
  return array();
}

/**
 * Form submission handler for path_admin_delete_confirm().
 */
function path_admin_delete_confirm_submit($form, &$form_state) {
  if ($form_state['values']['confirm']) {
    path_delete($form_state['path']['pid']);
    $form_state['redirect'] = 'admin/config/search/path';
  }
}

/**
 * Form constructor for the path admin overview filter form.
 *
 * @ingroup forms
 * @see path_admin_filter_form_submit_filter()
 * @see path_admin_filter_form_submit_reset()
 */
function path_admin_filter_form($form, &$form_state, $keys = '') {
  $form['#attributes'] = array('class' => array('search-form'));
  $form['basic'] = array('#type' => 'fieldset',
    '#title' => t('Filter aliases'),
    '#attributes' => array('class' => array('container-inline')),
  );
  $form['basic']['filter'] = array(
    '#type' => 'textfield',
    '#title' => 'Path alias',
    '#title_display' => 'invisible',
    '#default_value' => $keys,
    '#maxlength' => 128,
    '#size' => 25,
  );
  $form['basic']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Filter'),
    '#submit' => array('path_admin_filter_form_submit_filter'),
    );
  if ($keys) {
    $form['basic']['reset'] = array(
      '#type' => 'submit',
      '#value' => t('Reset'),
      '#submit' => array('path_admin_filter_form_submit_reset'),
    );
  }
  
  return $form;
}

/**
 * Form submission handler for the path_admin_filter_form() Filter button.
 *
 * @see path_admin_filter_form_submit_reset()
 */
function path_admin_filter_form_submit_filter($form, &$form_state) {
  $form_state['redirect'] = 'admin/config/search/path/list/' . trim($form_state['values']['filter']);
}

/**
 * Form submission handler for the path_admin_filter_form() Reset button.
 *
 * @see path_admin_filter_form_submit_filter()
 */
function path_admin_filter_form_submit_reset($form, &$form_state) {
  $form_state['redirect'] = 'admin/config/search/path/list';
}

/**
 * Implements hook_path_operations().
 */
function path_path_operations() {
  $operations = array(
    'publish' => array(
      'label' => t('Publish selected content'),
    ),
  );
  return $operations;
}

function path_admin_form_update_validate($form, &$form_state) {
	if (!is_array($form_state['values']['pathes']) || !count(array_filter($form_state['values']['pathes']))) {
		form_set_error('', t('No items selected.'));
	}
}

function path_admin_form_update_submit($form, &$form_state) {
  $pathes = array_filter($form_state['values']['pathes']);

  //path_save($form_state['values']);

  //drupal_set_message(t('The alias has been saved.'));
  $form_state['redirect'] = 'admin/config/search/path';
}