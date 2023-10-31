<?php

namespace WebFontsLoader;

defined('ABSPATH') || exit;

define('WebFontsLoader\FONT_OPTIONS', serialize(
  array(
    SLUG . '-body_typeface',
    SLUG . '-body_style',
    SLUG . '-heading_1_typeface',
    SLUG . '-heading_1_style',
    SLUG . '-heading_2_typeface',
    SLUG . '-heading_2_style',
    SLUG . '-heading_3_typeface',
    SLUG . '-heading_3_style',
    SLUG . '-heading_4_typeface',
    SLUG . '-heading_4_style',
    SLUG . '-heading_5_typeface',
    SLUG . '-heading_5_style',
    SLUG . '-heading_6_typeface',
    SLUG . '-heading_6_style',
  )
));


define('WebFontsLoader\FONT_TAGS', serialize(
  array(
    SLUG . '-body_typeface' => 'body *',
    SLUG . '-body_style' => 'body *',
    SLUG . '-heading_1_typeface' => 'h1, h1 *,.h1 *,.display-1 *',
    SLUG . '-heading_1_style' => 'h1, h1 *,.h1 *,.display-1 *',
    SLUG . '-heading_2_typeface' => 'h2, h2 *,.h2 *,.display-2 *',
    SLUG . '-heading_2_style' => 'h2, h2 *,.h2 *,.display-2 *',
    SLUG . '-heading_3_typeface' => 'h3, h3 *,.h3 *,.display-3 *',
    SLUG . '-heading_3_style' => 'h3, h3 *,.h3 *,.display-3 *',
    SLUG . '-heading_4_typeface' => 'h4, h4 *,.h4 *,.display-4 *',
    SLUG . '-heading_4_style' => 'h4, h4 *,.h4 *,.display-4 *',
    SLUG . '-heading_5_typeface' => 'h5, h5 *,.h5 *',
    SLUG . '-heading_5_style' => 'h5, h5 *,.h5 *',
    SLUG . '-heading_6_typeface' => 'h6, h6 *,.h6 *',
    SLUG . '-heading_6_style' => 'h6, h6 *,.h6 *',
  )
));


function load_frontend_fonts()
{
  $font_options = unserialize(FONT_OPTIONS);
  $tags         = unserialize(FONT_TAGS);
  $styles       = unserialize(GOOGLE_STYLES);

  if ($font_options) {
    $output = '';

    foreach ($font_options as $option) {

      if (get_option($option)) {

        if (preg_match("/\_style$/", $option)) {
          $output .= $tags[$option] . ' {font-weight: ' . array_search(get_option($option), $styles) . ' !important;} ';
        } else {
          $output .= $tags[$option] . ' {font-family: "' . get_option($option) . '", sans-serif !important;} ';
        }
      }
    }

    wp_add_inline_style(SLUG . '-frontend',  $output);
  }


  // Set all global Google Fonts into array dynamically for webfont.js to load.
  if ($font_options) {
    $typeface_style = [];
    $fonts = [];

    // Match font typefaces with styles
    foreach ($font_options as $option) {
      // Get style vaule based on the option selected. 400 <> Regular.
      $style = array_search(get_option($option), $styles);
      $pattern = str_replace('_styles', '', str_replace('_typeface', '', $option));

      // Adds style value otherwize add the typeface
      if ($style) {
        $typeface_style[$pattern][] = $style;
      } else {
        $typeface_style[$pattern][] = get_option($option);
      }
    }

    // Get all unique Google Fonts options.
    $typeface_style = array_map('json_encode', $typeface_style);
    $typeface_style = array_unique($typeface_style);
    $typeface_style = array_map('json_decode', $typeface_style);

    // Create Google Fonts to load with [typeface:style] or attach styles sep with ','.
    if ($typeface_style[SLUG . '-body'][0]) {

      foreach ($typeface_style as $option_group) {

        if (array_key_exists($option_group[0], $fonts)) {
          $fonts[$option_group[0]] .= ',' . $option_group[1];
        } else if ($option_group[0]) {
          $fonts[$option_group[0]] = implode(':', $option_group);
        }

        // Strip the trailing ',' from Google Font option string.
        if (!empty($fonts[$option_group[0]]) && substr($fonts[$option_group[0]], -1) === ',') {
          $fonts[$option_group[0]] = substr($fonts[$option_group[0]], 0, -1);
        }
      }
    }


    if ($fonts) {
      $output = 'var wfl_font_families = [';

      foreach ($fonts as $font) {

        if ($font) {
          $output .= "'" . $font . "',";
        }
      }

      $output = substr($output, 0, -1);
      $output .= '];';

      wp_add_inline_script(SLUG . '-frontend',  $output, 'before');
    }
  }
}
