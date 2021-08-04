<?php

namespace Drupal\an_task_31\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form.
 */
class AnTask31Form extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'an_task_31_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['user'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('email'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $message = 'User: ' . $form_state->getValue('user') . ' | email: ' . $form_state->getValue('email');
    \Drupal::logger('my_module')->notice($message);
  }

}
