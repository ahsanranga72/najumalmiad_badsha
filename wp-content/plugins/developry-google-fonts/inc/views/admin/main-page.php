<?php

namespace WebFontsLoader;

defined('ABSPATH') || exit;
?>
<div class="wrap">
  <div id="poststuff">
    <div id="post-body">
      <div id="post-body-content">
        <div class="wrap-card-container web-fonts-loader">
          <div class="wrap card">
            <h1><?php echo NAME; ?></h1>
            <p class="mlr-text-large">
              Load the 20 most popular <strong>Google Web Fonts</strong> within your WordPress. Apply them to the whole site or individually to each Page or Post.
            </p>
            <p>
              Below you have the option to select global fonts and apply typeface, style and weight to the body text and all the headings.
            </p>
            <p>
              Moreover you can style your website content directly within the Classic Editor and overwrite the global options.
            </p>
            <hr />
            <p class="mlr-text-small">
              * All styles applied via the WYSIWYG editor will overwrite the global font settings. Also, some of the classes shown below are Bootstrap specific so if you have the framework loaded it will apply the font settings as well. </p>
          </div>
          <div class="wrap card">
            <h3>
              Global Fonts
            </h3>
            <p>
              Using the form below will apply global font typefaces and styles for each of the specified tags or class names.
            </p>
            <form id="wfl-from" name="wfl-from" method="post" action="">
              <?php $message = update_admin_fonts(); ?>
              <?php if ($message) : ?>
                <h3>
                  <?php echo $message; ?> &rarr;
                  <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank">Visit Site...</a>
                </h3>
              <?php endif; ?>
              <input type="hidden" name="wfl-submitted" value="1" />
              <table class="wfl-form-table">
                <tbody>
                  <tr>
                    <th scope="row">
                      <label>Body Text</label><br />(p, ul, ol, etc.)
                    </th>
                    <td>
                      <select name="<?php echo SLUG; ?>-body_typeface">
                        <option value="">Select typeface...</option>
                        <?php load_admin_fonts('typeface', get_option(SLUG . '-body_typeface')); ?>
                      </select>
                      <select name="<?php echo SLUG; ?>-body_style">
                        <option value="">Select weight &amp; style...</option>
                        <?php load_admin_fonts('style', get_option(SLUG . '-body_style')); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <label>Heading 1</label><br />(h1, .h1, .display-1)
                    </th>
                    <td>
                      <select name="<?php echo SLUG; ?>-heading_1_typeface">
                        <option value="">Select typeface...</option>
                        <?php load_admin_fonts('typeface', get_option(SLUG . '-heading_1_typeface')); ?>
                      </select>
                      <select name="<?php echo SLUG; ?>-heading_1_style">
                        <option value="">Select weight &amp; style...</option>
                        <?php load_admin_fonts('style', get_option(SLUG . '-heading_1_style')); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <label>Heading 2</label><br />(h2, .h2, .display-2)
                    </th>
                    <td>
                      <select name="<?php echo SLUG; ?>-heading_2_typeface">
                        <option value="">Select typeface...</option>
                        <?php load_admin_fonts('typeface', get_option(SLUG . '-heading_2_typeface')); ?>
                      </select>
                      <select name="<?php echo SLUG; ?>-heading_2_style">
                        <option value="">Select weight &amp; style...</option>
                        <?php load_admin_fonts('style', get_option(SLUG . '-heading_2_style')); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <label>Heading 3</label><br />(h3, .h3, .display-3)
                    </th>
                    <td>
                      <select name="<?php echo SLUG; ?>-heading_3_typeface">
                        <option value="">Select typeface...</option>
                        <?php load_admin_fonts('typeface', get_option(SLUG . '-heading_3_typeface')); ?>
                      </select>
                      <select name="<?php echo SLUG; ?>-heading_3_style">
                        <option value="">Select weight &amp; style...</option>
                        <?php load_admin_fonts('style', get_option(SLUG . '-heading_3_style')); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <label>Heading 4</label><br />(h4, .h4)
                    </th>
                    <td>
                      <select name="<?php echo SLUG; ?>-heading_4_typeface">
                        <option value="">Select typeface...</option>
                        <?php load_admin_fonts('typeface', get_option(SLUG . '-heading_4_typeface')); ?>
                      </select>
                      <select name="<?php echo SLUG; ?>-heading_4_style">
                        <option value="">Select weight &amp; style...</option>
                        <?php load_admin_fonts('style', get_option(SLUG . '-heading_4_style')); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <label>Heading 5</label><br />(h5, .h5)
                    </th>
                    <td>
                      <select name="<?php echo SLUG; ?>-heading_5_typeface">
                        <option value="">Select typeface...</option>
                        <?php load_admin_fonts('typeface', get_option(SLUG . '-heading_5_typeface')); ?>
                      </select>
                      <select name="<?php echo SLUG; ?>-heading_5_style">
                        <option value="">Select weight &amp; style...</option>
                        <?php load_admin_fonts('style', get_option(SLUG . '-heading_5_style')); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <label>Heading 6</label><br />(h6, .h6)
                    </th>
                    <td>
                      <select name="<?php echo SLUG; ?>-heading_6_typeface">
                        <option value="">Select typeface...</option>
                        <?php load_admin_fonts('typeface', get_option(SLUG . '-heading_6_typeface')); ?>
                      </select>
                      <select name="<?php echo SLUG; ?>-heading_6_style">
                        <option value="">Select weight &amp; style...</option>
                        <?php load_admin_fonts('style', get_option(SLUG . '-heading_6_style')); ?>
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
              <p>
                <input type="submit" name="Submit" class="button button-primary" value="Save Changes" />
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>