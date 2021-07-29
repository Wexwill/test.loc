<?php

namespace Drupal\an_task_28\Controller;

use Drupal\block_content\Entity\BlockContent;

/**
 * Provides route for an_task_28 module.
 */
class AnTask28 {

  /**
   * Gets block content and display them.
   *
   * @return array
   *   array of blocks to render
   */
  public function anTask28Content($first) {

    $block = BlockContent::load(1);
    $block_content = \Drupal::entityTypeManager()
      ->getViewBuilder('block_content')
      ->view($block);

    if (!empty($first)) {
      for ($i = 0; $i < $first; $i++) {
        $array_blocks[] = $block_content;
      }
    }
    return [
      '#theme' => 'an-task-28',
      '#block' => $array_blocks,
    ];
  }

}
