<?php

namespace Drupal\an_task_30\Controller;

use Drupal\Core\Access\AccessResult;

/**
 * Provides route for an_task_30 module.
 */
class AnTask30 {

  /**
   * Display content.
   */
  public function anTask30Content() {
    return [
      '#markup' => 'Hi!',
    ];
  }

  /**
   * Cheks access for a scepific request.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access() {
    return AccessResult::allowedIf($this->condition());
  }

  /**
   * Contains special condition for access method.
   */
  public function condition() {
    $roles = \Drupal::currentUser()->getRoles();
    $allowed = FALSE;
    $is_even = (floor(time() / 60) % 2 == 0);
    if ($is_even && in_array('manager', $roles) ||
        !$is_even && in_array('Authenticated', $roles)) {
      $allowed = TRUE;
    }
    return $allowed;
  }

}
