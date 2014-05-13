<?php
/**
* @file theme-settings.php
* 
*/

/**
* 
* Sets and saves variables used in the Nations theme - these variables available to the theme throughout
*/
function ou_digital_futures_form_system_theme_settings_alter( & $form, & $form_state)
{ 
  $form['ou_theme_settings'] = array(
    '#type' => 'fieldset',
    '#title'=> t('Open University Theme Settings'),
  );
  
  
  $form['ou_theme_settings']['ou_df_path_to_header'] = array(
    '#type'         => 'textfield',
    '#title'        => t('Path to Header'),
    '#default_value'=> theme_get_setting('ou_df_path_to_header'),
    '#description'  => t("The path to the OU Header to use for this site (e.g. include/header.html)"),

  );
  $form['ou_theme_settings']['ou_df_path_to_footer'] = array(
    '#type'         => 'textfield',
    '#title'        => t('Path to Footer'),
    '#default_value'=> theme_get_setting('ou_df_path_to_footer'),
    '#description'  => t("The path to the OU Footer to use for this site (e.g. include/footer.html)"),

  );

  $form['ou_theme_settings']['ou_df_nation'] = array(
    '#type'         => 'select',
    '#title'        => t('Nation'),
    '#options'                         => array(
      'no-nation'=> t('None'),
      'eng'      => t('England'),
      'ire'      => t('Ireland'),
      'nir'      => t('Northern Ireland'),
      'sct'      => t('Scotland'),
      'wls'      => t('Wales'),
    ),
    '#default_value'=> theme_get_setting('ou_df_nation'),
    '#description'  => t("Select nation if required"),

  );

  $form['ou_theme_settings']['ou_df_colour_scheme'] = array(
    '#type'         => 'select',
    '#title'        => t('Required site architecture'),
    '#options'                               => array(
      'ou-df-ia-courses'     => t('Course'),
      'ou-df-ia-postgraduate'=> t('Postgraduate'),
      'ou-df-ia-research'    => t('Research'),
      'ou-df-ia-employers'   => t('Employers'),
      'ou-df-ia-news'        => t('News'),
      'ou-df-ia-about'       => t('About'),
    ),
    '#default_value'=> theme_get_setting('ou_df_colour_scheme'),
    '#description'  => t("Select the required site Architecture (Determines which Header Menu tab is highlighted)"),

  );


  $form['ou_theme_settings']['ou_df_siblings_block_id'] = array(
    '#type'         => 'textfield',
    '#title'        => t('Block ID to display as Siblings Menu Block'),
    '#default_value'=> theme_get_setting('ou_df_siblings_block_id'),
    '#description'  => t("The block ID that will be used for the Sibling menu block - (no content for this block is displayed)"),

  );


  $form['ou_theme_settings']['ou_df_children_block_id'] = array(
    '#type'         => 'textfield',
    '#title'        => t('Block ID to display as Children Menu Block'),
    '#default_value'=> theme_get_setting('ou_df_children_block_id'),
    '#description'  => t("The block ID that will be used for the Children menu block - (no content for this block is displayed)"),

  );

  $form['ou_theme_settings']['ou_df_main_nav_block_id'] = array(
    '#type'         => 'textfield',
    '#title'        => t('Block ID to be used for the top navigation'),
    '#default_value'=> theme_get_setting('ou_df_main_nav_block_id'),
    '#description'  => t("The block ID that will be used for the top navigation - (This needs to be created first as a menu block)"),
  );
}
