<?php

namespace WebFontsLoader;

defined('ABSPATH') || exit;


define('WebFontsLoader\GOOGLE_FONTS', serialize(
  array(
    'roboto' => 'Roboto',
    'roboto-condensed' => 'Roboto Condensed',
    'roboto-slab' => 'Roboto Slab',
    'roboto-mono' => 'Roboto Mono',
    'open-sans' => 'Open Sans',
    'open-sans-condensed' => 'Open Sans Condensed',
    'lato' => 'Lato',
    'montserrat' => 'Montserrat',
    'montserrat-alternates' => 'Montserrat Alternates',
    'montserrat-subrayada'  => 'Montserrat Subrayada',
    'oswald' => 'Oswald',
    'source-sans-pro' => 'Source Sans Pro',
    'source-serif-pro' => 'Source Serif Pro',
    'source-code-pro' => 'Source Code Pro',
    'slabo-27px' => 'Slabo 27px',
    'slabo-13px' => 'Slabo 13px',
    'raleway' => 'Raleway',
    'raleway-dots'  => 'Raleway Dots',
    'pt-sans' => 'PT Sans',
    'pt-sans-caption' => 'PT Sans Caption',
    'pt-sans-narrow'  => 'PT Sans Narrow',
    'pt-serif' => 'PT Serif',
    'pt-serif-caption' => 'PT Serif Caption',
    'merriweather'  => 'Merriweather',
    'merriweather-sans' => 'Merriweather Sans',
    'ubuntu' => 'Ubuntu',
    'ubuntu-condensed' => 'Ubuntu Condensed',
    'ubuntu-mono' => 'Ubuntu Mono',
    'noto-sans' => 'Noto Sans',
    'noto-serif' => 'Noto Serif',
    'poppins' => 'Poppins',
    'playfair-display' => 'Playfair Display',
    'playfair-display-sc' => 'Playfair Display SC',
    'lora' => 'Lora',
    'titillium-web' => 'Titillium Web',
    'arimo' => 'Arimo',
    'multi' => 'Muli',
    'fira-sans' => 'Fira Sans',
    'fira-sans-condensed' => 'Fira Sans Condensed',
    'fira-sans-extra-condensed' => 'Fira Sans Extra Condensed',
    'fira-mono' => 'Fira Mono',
  )
));


define('WebFontsLoader\GOOGLE_STYLES', serialize(
  array(
    '100' => 'Thin',
    '100i' => 'Thin Italic',
    '200' => 'Extra Light',
    '200i' => 'Extra Light Italic',
    '300' => 'Light',
    '300i' => 'Light Italic',
    '400' => 'Regular',
    '400i' => 'Regular Italic',
    '500' => 'Medium',
    '500i' => 'Medium Italic',
    '600' => 'Semi Bold',
    '600i' => 'Semi Bold Italic',
    '700' => 'Bold',
    '700i' => 'Bold Italic',
    '800' => 'Extra Bold',
    '800i' => 'Extra Bold Italic',
    '900' => 'Black',
    '900i' => 'Black Italic',
  )
));


function load_admin_fonts($type, $selected_option)
{
  if ($type === 'typeface') {
    $font_options = unserialize(GOOGLE_FONTS);
  } else {
    $font_options = unserialize(GOOGLE_STYLES);
  }

  array_walk($font_options, function (&$value, $key, $selected_option) {

    if ($selected_option === $value) {
      echo '<option value="' . $value . '" selected>' . $value . '</option>';
    } else {
      echo '<option value="' . $value . '">' . $value . '</option>';
    }
  }, $selected_option);
}


function update_admin_fonts()
{
  if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
  }

  $check = null;
  $posted = array_map('sanitize_text_field', $_POST);

  if (isset($posted['wfl-submitted'])) {
    array_shift($posted);
    array_pop($posted);
    $check = false;

    foreach ($posted as $name => $value) {
      $value = sanitize_option($name, $value);

      if ($value) {

        if (get_option($name)) {
          update_option($name, $value, 'yes');
        } else {
          add_option($name, $value, '64', 'yes');
        }

        $check = true;
      }

      update_option($name, $value, 'yes');
    }
  }

  if ($check === null) {
    $message = sprintf('<span class="wfl-text-primary">%s</span>', __('Select global typeface and styles & save.', TEXT_DOMAIN));
  } else if ($check === false) {
    $message = sprintf('<span class="wfl-text-failure">%s</span>', __('No fonts were loaded.', TEXT_DOMAIN));
  } else {
    $message = sprintf('<span class="wfl-text-success">%s</span>', __('Fonts are saved and loaded successfully.', TEXT_DOMAIN));
  }

  return $message;
}
