<?php

namespace Drupal\an_task_27\Controller;

/**
 * Provides route for an_task_27 module.
 */
class AnTask27 {

  /**
   * Displays nodes.
   */
  public function anTask27Content() {
    return [
      '#theme' => 'an-task-27',
      '#nodes' => $this->anTask27QueryResult(),
    ];
  }

  /**
   * Gets content from database and creates HTML structure.
   *
   * @return string
   *   String with HTML structure
   */
  private function anTask27QueryResult() {
    $query_result = \Drupal::database()
      ->select('node_field_data', 'n')
      ->fields('n', ['title', 'created'])
      ->orderBy('n.nid', 'DESC')
      ->range(0, 5)
      ->execute()
      ->fetchAll();

    foreach ($query_result as $item) {
      $item->created = date('Y-m-d H:i:s', $item->created);
    }

    return $query_result;
  }

}
