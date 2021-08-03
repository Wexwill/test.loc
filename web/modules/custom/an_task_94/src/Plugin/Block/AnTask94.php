<?php

namespace Drupal\an_task_94\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a an_task_94 block.
 *
 * @Block(
 *   id = "an_task_94",
 *   admin_label = @Translation("an_task_94"),
 *   category = @Translation("an_task_94"),
 * )
 */
class AnTask94 extends BlockBase {

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
      '#attached' => [
        'library' => ['an_task_94/an_task_94_block'],
      ],
    ];
  }

}
