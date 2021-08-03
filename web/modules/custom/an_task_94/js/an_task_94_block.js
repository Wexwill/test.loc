/**
 * @file
 * Simple JavaScript hello world file.
 */

 (function ($, Drupal, drupalSettings) {

  "use strict";

  Drupal.behaviors.anTask94Block = {
    attach: function (context, settings) {
      var date = new Date();
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      $("#block-an-task-94").text(day + '/' + month + '/' + year);
    }
  }

})(jQuery, Drupal, drupalSettings);
