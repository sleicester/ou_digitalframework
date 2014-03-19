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
    '#title' => t('Required site colour scheme'),
    '#options' => array(
       'ou-df-ia-courses' => t('Course'),
       'ou-df-ia-postgraduate' => t('Postgraduate'),
       'ou-df-ia-research' => t('Research'),
       'ou-df-ia-employers' => t('Employers'),
       'ou-df-ia-news' => t('News'),
       'ou-df-ia-about' => t('About'),
     ),
    '#default_value' => theme_get_setting('ou_df_colour_scheme'),
    '#description' => t("Select the site scheme for this site"),    

  );
}
