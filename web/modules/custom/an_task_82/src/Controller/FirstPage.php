<?php

/**
 * @file
 *   Contains \Drupal\an_task_82\Controller\FirstPage.
 */

namespace Drupal\an_task_82\Controller;

/**
 * Provides route for an_task_82 module.
 */

class FirstPage {

/**
 * Displays simple page.
 */

    public function an_task_82_content() {
        return array(
            '#markup' => 'Hello, World!',
        );
    }
}
