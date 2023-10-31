// Check if there are global options applied otherwise init.
if (!wfl_font_families) {
  var wfl_font_families = [];
}

(function ($) {
  plugin = {
    $: jQuery,
  };

  plugin.load_frontend_fonts = function () {
    var fonts = {
      roboto: "Roboto",
      "roboto-condensed": "Roboto Condensed",
      "roboto-slab": "Roboto Slab",
      "roboto-mono": "Roboto Mono",
      "open-sans": "Open Sans",
      "open-sans-condensed": "Open Sans Condensed",
      lato: "Lato",
      montserrat: "Montserrat",
      "montserrat-alternates": "Montserrat Alternates",
      "montserrat-subrayada": "Montserrat Subrayada",
      oswald: "Oswald",
      "source-sans-pro": "Source Sans Pro",
      "source-serif-pro": "Source Serif Pro",
      "source-code-pro": "Source Code Pro",
      "slabo-27px": "Slabo 27px",
      "slabo-13px": "Slabo 13px",
      raleway: "Raleway",
      "raleway-dots": "Raleway Dots",
      "pt-sans": "PT Sans",
      "pt-sans-caption": "PT Sans Caption",
      "pt-sans-narrow": "PT Sans Narrow",
      "pt-serif": "PT Serif",
      "pt-serif-caption": "PT Serif Caption",
      merriweather: "Merriweather",
      "merriweather-sans": "Merriweather Sans",
      ubuntu: "Ubuntu",
      "ubuntu-condensed": "Ubuntu Condensed",
      "ubuntu-mono": "Ubuntu Mono",
      "noto-sans": "Noto Sans",
      "noto-serif": "Noto Serif",
      poppins: "Poppins",
      "playfair-display": "Playfair Display",
      "playfair-display-sc": "Playfair Display SC",
      lora: "Lora",
      "titillium-web": "Titillium Web",
      arimo: "Arimo",
      multi: "Muli",
      "fira-sans": "Fira Sans",
      "fira-sans-condensed": "Fira Sans Condensed",
      "fira-sans-extra-condensed": "Fira Sans Extra Condensed",
      "fira-mono": "Fira Mono",
    };
    var font_elements = $(".mce-ga") || {};
    var font_stack = [];
    var font_stack_unique = [];
    // Get all page available fonts and font weight/styles
    $.each(font_elements, function (key, value) {
      font_stack.push(
        $(value)
          .attr("class")
          .replace("mce-ga", "")
          .replace("mce-family-", "")
          .replace("mce-styles-", "")
          .trim()
          .split(" ")
      );
    });

    // Remove all duplicates.
    $.each(font_stack, function (key, value) {
      if ($.inArray(value[0], font_stack_unique) === -1) {
        font_stack_unique.push(value[0]);
      }
    });

    // Bulild the Google Font families array.
    $.each(font_stack_unique, function (key, value) {
      // Here check for font weight/style from the main stack
      // and assign it the font that's going to be loaded.
      if (!font_stack[key][1]) {
        font_stack[key][1] = "";
      } else {
        font_stack[key][1] = ":" + font_stack[key][1];
      }

      // Build the GF array.
      if (fonts[value]) {
        wfl_font_families.push(fonts[value] + font_stack[key][1]);
      }
    });

    // Load all Google Fonts for the current page.
    if (wfl_font_families.length) {
      WebFont.load({
        google: {
          families: wfl_font_families,
        },
      });
    }
  };

  plugin.load_frontend_fonts();
})(jQuery);
