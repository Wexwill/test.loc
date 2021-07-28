<?php

namespace Drupal\an_task_27\Controller;

/**
 * Provides route for an_task_27 module.
 */
class AnTask27 {

  /**
   * Gets content from database adn displays nodes.
   *
   * @return array
   *   array of node elements to render
   */
  public function anTask27Content() {
    $query_result = \Drupal::database()
      ->select('node_field_data', 'n')
      ->fields('n', ['title', 'created'])
      ->orderBy('n.nid', 'DESC')
      ->range(0, 5)
      ->execute()
      ->fetchAll();

    foreach ($query_result as $item) {
      $item->created = \Drupal::service('date.formatter')->format($item->created, 'short');
    }

    return [
      '#theme' => 'an-task-27',
      '#nodes' => $query_result,
    ];
  }

}
