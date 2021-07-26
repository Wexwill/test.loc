<?php

/**
 * @file
 *   Contains \Drupal\an_task_95\Plugin\Block\An_task_95.
 */

namespace Drupal\an_task_95\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a an_task_95 block.
 *
 * @Block(
 *   id = "an_task_95",
 *   admin_label = @Translation("an_task_95"),
 *   category = @Translation("an_task_95"),
 * )
 */
class An_task_95 extends BlockBase {

  /**
  * {@inheritdoc}
  */
  public function defaultConfiguration() {
    return ['label_display' => FALSE];
  }

  /**
  * {@inheritdoc}
  */
  public function build() {
    return [
      '#theme' => 'an-task-95',
      '#data' => 'Hello world',
    ];
  }
}
