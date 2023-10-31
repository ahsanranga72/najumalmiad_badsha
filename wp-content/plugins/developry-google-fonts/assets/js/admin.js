(function ($) {
  plugin = {
    $: jQuery,
    typefaces: {
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
    },
    styles: {
      100: "Thin",
      "100i": "Thin Italic",
      200: "Extra Light",
      "200i": "Extra Light Italic",
      300: "Light",
      "300i": "Light Italic",
      400: "Regular",
      "400i": "Regular Italic",
      500: "Medium",
      "500i": "Medium Italic",
      600: "Semi Bold",
      "600i": "Semi Bold Italic",
      700: "Bold",
      "700i": "Bold Italic",
      800: "Extra Bold",
      "800i": "Extra Bold Italic",
      900: "Black",
      "900i": "Black Italic",
    },
  };

  plugin.add_toolbar_message = function () {
    $("<div/>")
      .attr("class", "web-fonts-loader-custom-toolbar-message")
      .html(
        `<span class="tinymce-toolbar-hint" title="Click on editor element to see the font fiamly/weight/style; Double click to select the whole element for update.">
        <strong>Hint</strong> Click on editor element to see the font <em>fiamly/weight/style</em>; Double click to select the whole element for update.
      </span>`
      )
      .insertAfter("#insert-media-button");
  };

  plugin.apply_font = function (editor, section, value) {
    var html_output = "";
    var html_select = editor.selection.getContent({ format: "html" });
    // If no content is selected apply the font/style to the body.
    if (!html_select) {
      html_select = editor.getBody().innerHTML;
    }
    // Add remove classes to the node elements.
    var html_blocks = $.parseHTML(html_select);
    $.each(html_blocks, function (idx, block) {
      // In case only text is seleted to style need to wrap it into <span/>
      if ($(block).get(0).nodeType === 3) {
        html_output += `<span class="mce-ga mce-${section}-${value}">${
          $(block).get(0).nodeValue
        }</span>`;
      } else if ($(block).get(0).tagName === "SPAN") {
        // Reset and add first class set to SPAN.
        if (
          $(block)
            .get(0)
            .className.match(/(^|\s)mce-family-\S+/g) &&
          $(block)
            .get(0)
            .className.match(/(^|\s)mce-styles-\S+/g)
        ) {
          $(block).get(0).className = "mce-ga  mce-" + section + "-" + value;
        } else {
          // Append classes to current SPAN.
          $(block).get(0).className += " mce-" + section + "-" + value;
        }
        html_output += `<span class="${$(block).get(0).className}">${
          $(block).get(0).innerHTML
        }</span>`;
      } else {
        // The element doesn't have any styling yet, apply it.
        if (!$(block).hasClass("mce-ga")) {
          $(block).addClass("mce-ga mce-" + section + "-" + value);
        } else {
          // Type is font-family we want remove all the existing classes and add the current one selected.
          if (section === "family") {
            $(block).removeClass(function (idx, class_name) {
              return (class_name.match(/(^|\s)mce-family-\S+/g) || []).join(" ");
            });
            $(block).addClass("mce-ga mce-" + section + "-" + value);
          }
          // Type is font-weight we want remove all the existing classes and add the current one selected.
          if (section === "styles") {
            $(block).removeClass(function (idx, class_name) {
              return (class_name.match(/(^|\s)mce-styles-\S+/g) || []).join(" ");
            });
            $(block).addClass("mce-ga mce-" + section + "-" + value);
          }
        }
        // Append all the formatted outer HTML.
        html_output += block.outerHTML;
      }
    });
    // Replace if we have selected content, otherwise update the full body content.
    if (editor.selection.getContent({ format: "html" })) {
      editor.selection.setContent(html_output, { format: "html" });
    } else {
      editor.setContent(html_output, { format: "html" });
    }
  };

  // Load the up plugin Google font typefaces and styles.
  plugin.load_button_values = function (editor, section, values) {
    var editor_values = [];
    if (section === "family") {
      // Add the top level empty value.
      editor_values.push({
        text: "Select typeface...",
        value: "",
        onclick: function (event) {
          alert("Make a selection and then choose your font typeface...");
        },
      });
    } else if (section === "styles") {
      // Add the top level empty value.
      editor_values.push({
        text: "Select weight & style...",
        value: "",
        onclick: function (event) {
          alert("Make a selection and then choose your font weight & style...");
        },
      });
    }
    // Loop over the options and build the listbox button group body.
    $.each(values, function (key, value) {
      editor_values.push({
        text: value,
        classes: section + "-" + key,
        value: key,
        onclick: function () {
          plugin.apply_font(editor, section, key);
        },
      });
    });
    return editor_values;
  };

  // Change the Toolbar listbox value with the selected
  // element Google font family / weight & style.
  plugin.change_button_node = function (editor, section, values) {
    editor.on("NodeChange", function (event) {
      var selected = [];
      if ($(event.element).hasClass("mce-ga")) {
        var google_font_values = $(event.element)
          .attr("class")
          .replace("mce-ga", "")
          .replace("mce-family-", "")
          .replace("mce-styles-", "")
          .trim()
          .split(" ");
        selected.push(google_font_values);
        if (editor.value) {
          // Each family and styles can be set as 0 or 1 options.
          if (section === "family") {
            if (values.hasOwnProperty(selected[0][0])) {
              editor.value(selected[0][0]);
            } else {
              editor.value(selected[0][1]);
            }
          } else if (section === "styles") {
            if (values.hasOwnProperty(selected[0][1])) {
              editor.value(selected[0][1]);
            } else {
              editor.value(selected[0][0]);
            }
          }
        }
      }
      // Do reset.
      if (!selected.length) {
        editor.value("");
      }
    });
  };

  plugin.editor = function () {
    this.add_toolbar_message();
    tinymce.create("tinymce.plugins.DGF", {
      init: function (editor, url) {
        var typefaces = plugin.typefaces;
        var styles = plugin.styles;
        //  Double click to select the whole element for update.
        editor.on("dblclick", function (elem) {
          editor.selection.select($(elem.target).get(0));
        });
        // Add TinyMCE Toolbar button groups.
        editor.addButton("web-fonts-loader-typeface-button", {
          type: "listbox",
          name: "font-family",
          icon: "dashicon dashicons-admin-appearance",
          value: "",
          onpostrender: function () {
            plugin.change_button_node(this, "family", typefaces);
          },
          values: plugin.load_button_values(editor, "family", typefaces),
        });
        editor.addButton("web-fonts-loader-style-button", {
          type: "listbox",
          name: "font-styles",
          icon: "dashicon dashicons-filter",
          value: "",
          onpostrender: function () {
            plugin.change_button_node(this, "styles", styles);
          },
          values: plugin.load_button_values(editor, "styles", styles),
        });
      },
    });
    tinymce.PluginManager.add("web-fonts-loader", tinymce.plugins.DGF);
  };

  plugin.editor();
})(jQuery);
