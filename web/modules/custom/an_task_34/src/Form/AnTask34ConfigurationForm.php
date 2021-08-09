<?php

namespace Drupal\an_task_34\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class AnTask34ConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'an_task_34_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'an_task_34.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('an_task_34.settings');

    $form['author'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Age of the site author'),
      '#default_value' => $config->get('an_task_34.author'),
    ];

    $form['cat'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Maximum number of cat paws'),
      '#default_value' => $config->get('an_task_34.cat'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('an_task_34.settings')
      ->set('an_task_34.author', $form_state->getValue('author'))
      ->set('an_task_34.cat', $form_state->getValue('cat'))
      ->save();
    return parent::submitForm($form, $form_state);
  }

}
