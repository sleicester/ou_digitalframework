<?php function ou_digital_futures_form_system_theme_settings_alter(&$form, &$form_state) {
	$form['ou_theme_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Open University Theme Settings'),
   );
  $form['ou_theme_settings']['ou_df_path_to_header'] = array(
    '#type' => 'textfield',
    '#title' => t('Path to Header'),
    '#default_value' => theme_get_setting('ou_df_path_to_header'),
    '#description' => t("The path to the OU Header to use for this site (e.g. /include/header.html)"),    

  );
    $form['ou_theme_settings']['ou_df_path_to_footer'] = array(
    '#type' => 'textfield',
    '#title' => t('Path to Footer'),
    '#default_value' => theme_get_setting('ou_df_path_to_footer'),
    '#description' => t("The path to the OU Footer to use for this site (e.g. /include/footer.html)"),    

  );
  
      $form['ou_theme_settings']['ou_df_colour_scheme'] = array(
    '#type' => 'select',
    '#title' => t('Required colour scheme'),
    '#options' => array(
       'red' => t('Red'),
       'green' => t('Green'),
       'blue' => t('Blue'),
     ),
    '#default_value' => theme_get_setting('ou_df_colour_scheme','red'),
    '#description' => t("Select the colour scheme for this site"),    

  );
  
 
}