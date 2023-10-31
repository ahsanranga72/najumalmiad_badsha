<?php
/*
  Plugin Name:  Web Fonts Loader
  Plugin URI:   https://krasenslavov.com/plugins/web-fonts-loader/
  Description:  Load the 20 most popular Google Fonts within your WordPress.
  Version:      1.2.1
  Author:       Krasen Slavov
  Author URI:   https://krasenslavov.com/
  License:      GNU General Public License, version 2
  License URI:  https://www.gnu.org/licenses/gpl-2.0.html
  Text Domain:  web-fonts-loader

  Copyright 2018 - 2022 Krasen Slavov (email: hello@krasenslavov.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

namespace WebFontsLoader;

defined('ABSPATH') || exit;

define('WebFontsLoader\UUID', 'wfl');
define('WebFontsLoader\NAME', 'Web Fonts Loader');
define('WebFontsLoader\SLUG', 'web-fonts-loader');
define('WebFontsLoader\TEXT_DOMAIN', 'web-fonts-loader');
define('WebFontsLoader\DOC_PAGE', 'https://krasenslavov.com/plugins/web-fonts-loader/');
define('WebFontsLoader\RATE_PAGE', 'https://wordpress.org/support/plugin/developry-google-fonts/reviews/?filter=5');
define('WebFontsLoader\VERSION', '1.2.1');
define('WebFontsLoader\MIN_PHP_VERSION', '7.2');
define('WebFontsLoader\MIN_WP_VERSION', '5.0');
define('WebFontsLoader\FILE',  __FILE__);
define('WebFontsLoader\DIR_PATH', plugin_dir_path(__FILE__));
define('WebFontsLoader\BASENAME', plugin_basename(__FILE__));
define('WebFontsLoader\URL',  plugins_url('/', __FILE__));

require_once DIR_PATH . 'inc/config.php';
require_once DIR_PATH . 'inc/settings.php';
require_once DIR_PATH . 'inc/load-admin-fonts.php';
require_once DIR_PATH . 'inc/load-frontend-fonts.php';
