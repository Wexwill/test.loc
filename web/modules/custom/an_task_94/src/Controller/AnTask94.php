<?php

namespace Drupal\an_task_94\Controller;

/**
 * Provides route for an_task_94 module.
 */
class AnTask94 {

  /**
   * Display content.
   */
  public function anTask94Content() {
    return [
      '#attached' => [
        'library' => ['an_task_94/an_task_94_page'],
      ],
    ];
  }

}
