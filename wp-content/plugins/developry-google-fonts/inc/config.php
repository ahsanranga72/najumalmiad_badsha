<?php


namespace WebFontsLoader;

defined('ABSPATH') || exit;


register_activation_hook(
  FILE,
  function () {
  }
);


register_deactivation_hook(
  FILE,
  function () {
  }
);

add_action('admin_notices', function() {
  if (!get_option('wfl_rating_notice')) {
    ?>
      <div class="notice notice-success is-dismissible">
        <h3>Web Fonts Loader</h3>
        <p>
          Could you please kindly help the plugin in your turn by giving it 5 stars rating? (Thank you in advance)
        </p>
        <p>
          <a href="<?php echo esc_url(RATE_PAGE); ?>" target="_blank" class="button button-primary">Rate Us @ WordPress.org</a>
          <a href="?wfl_rating_notice_dismiss" class="button"><strong>I already did</strong></a>
          <a href="?wfl_rating_notice_dismiss" class="button"><strong>Don't show this notice again!</strong></a>
        </p>
        </p>
      </div>
    <?php
  }
});

add_action('admin_init', function() {
  if (isset($_GET['wfl_rating_notice_dismiss'])) {
    add_option('wfl_rating_notice', 1);
  }
});

add_action(
  'admin_init',
  function () {

    if (
      version_compare(PHP_VERSION, MIN_PHP_VERSION) >= 0
      && version_compare($GLOBALS['wp_version'], MIN_WP_VERSION) >= 0
    ) {
 
      add_action(
        'plugin_action_links',
        function ($links, $filepath) {

          if (BASENAME === $filepath) {
            $html = '<a href="%s">' . __('Settings', TEXT_DOMAIN) . '</a>';
            $links['settings'] = sprintf($html, esc_url(admin_url('themes.php?page=' . SLUG)));
            return array_reverse($links);
          }

          return $links;
        },
        10,
        2
      );

      add_action(
        'plugin_row_meta',
        function ($links, $filepath) {

          if (BASENAME === $filepath) {
            $html = '<a href="%s" target="_blank">' . __('Docs', TEXT_DOMAIN) . '</a>';
            $links['docs'] = sprintf($html, DOC_PAGE);
          }

          return $links;
        },
        10,
        2
      );

      add_action(
        'admin_enqueue_scripts',
        function () {
          // wp_enqueue_style(SLUG . '-admin', URL . 'assets/css/admin.css', null, VERSION, 'all');
          wp_enqueue_style(
            SLUG . '-admin',
            URL . 'assets/css/admin.min.css',
            null,
            VERSION,
            'all'
          );
          // wp_enqueue_script(SLUG . '-admin', URL . 'assets/js/admin.js', array('jquery'), VERSION, true);
          // wp_enqueue_script(
          //   SLUG . '-admin',
          //   URL . 'assets/js/admin.min.js',
          //   array('jquery'),
          //   VERSION,
          //   true
          // );
          wp_localize_script(
            SLUG . '-admin',
            'DGF',
            array('ajax_url' => admin_url('admin-ajax.php'))
          );
          add_action('mce_external_plugins', function ($plugins) {
            // $plugins[SLUG] = URL . 'assets/js/admin.js';
            $plugins[SLUG] = URL . 'assets/js/admin.min.js';
            return $plugins;
          });
          add_action('mce_buttons', function ($buttons) {
            array_unshift(
              $buttons,
              SLUG . '-typeface-button',
              SLUG . '-style-button'
            );
            return $buttons;
          });
          add_editor_style(URL . 'assets/css/admin.css');
          // add_editor_style(URL . 'assets/css/admin.min.css');
        }
      );

      load_plugin_textdomain(TEXT_DOMAIN);
           
    } else {

      require_once(ABSPATH . 'wp-admin/includes/plugin.php');
      
      deactivate_plugins(BASENAME);

      add_action(
        'admin_notices',
        function () {
          $html = '<div class="notice notice-error is-dismissable"><h2>WordPress '
            . __('Plugin Minimum Requirements', TEXT_DOMAIN) . '<hr /></h2><p><strong></strong> '
            . __('requires', TEXT_DOMAIN) . ' <em>PHP %s</em> ' . __('and', TEXT_DOMAIN)
            . ' <em>WordPress %s</em> ' . __('or above', TEXT_DOMAIN) . '.</p><p>'
            . __('You are currently running', TEXT_DOMAIN)
            . ' <strong>PHP %s</strong> and <strong>WordPress %s</strong>. '
            . __('Please upgrade to the minimum supported versions for the plugin to be loaded', TEXT_DOMAIN)
            . '.</p><p><a href="%s">&larr; Go Back</a></p></div>';
          printf(
            $html,
            MIN_PHP_VERSION,
            MIN_WP_VERSION,
            PHP_VERSION,
            $GLOBALS['wp_version'],
            esc_url(admin_url('plugins.php'))
          );
        }
      );
    }
  }
);


add_action(
  'after_setup_theme',
  function () {
    add_action(
      'wp_enqueue_scripts',
      function () {
        wp_enqueue_script(SLUG . '-webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', [], VERSION, true);
        // wp_enqueue_style(SLUG . '-frontend', URL . 'assets/css/frontend.css', null, VERSION, 'all');
        wp_enqueue_style(
          SLUG . '-frontend',
          URL . 'assets/css/frontend.min.css',
          null,
          VERSION,
          'all'
        );
        // wp_enqueue_script(SLUG . '-frontend', URL . 'assets/js/frontend.js', array('jquery'), VERSION, true);
        wp_enqueue_script(
          SLUG . '-frontend',
          URL . 'assets/js/frontend.min.js',
          array('jquery'),
          VERSION,
          true
        );
        wp_localize_script(
          SLUG . '-frontend',
          'DGF',
          array('ajax_url' => admin_url('admin-ajax.php'))
        );
        load_frontend_fonts();
      },
      9999
    );
  }
);
