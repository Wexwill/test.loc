/**
 * @file
 * Simple JavaScript hello world file.
 */

 (function ($, Drupal, drupalSettings) {

  "use strict";

  Drupal.behaviors.anTask94Page = {
    attach: function (context, settings) {
      var attributes = $("body").attr("class");
      $("#block-bartik-content").text(attributes);
    }
  }
})(jQuery, Drupal, drupalSettings);
