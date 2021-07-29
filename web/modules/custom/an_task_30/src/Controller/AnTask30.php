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
    $role = \Drupal::currentUser()->getRoles();
    if ((floor(time() / 60) % 2 == 0) && in_array('manager', $role)) {
      return TRUE;
    }
    if ((floor(time() / 60) % 2 == 1) && in_array('Authenticated', $role)) {
      return TRUE;
    }
  }

}
