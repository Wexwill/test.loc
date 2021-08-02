<?php

namespace Drupal\an_task_93\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class AnTask93ConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'an_task_93_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'an_task_93.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('an_task_93.settings');
    $form['values'] = [
      '#type' => 'radios',
      '#title' => $this->t('Countries'),
      '#options' => [
        'Belarus' => $this->t('Belarus'),
        'Russia' => $this->t('Russia'),
        'Ukraine' => $this->t('Ukraine'),
        'Poland' => $this->t('Poland'),
        'Latvia' => $this->t('Latvia'),
      ],
      '#default_value' => $config->get('values'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('an_task_93.settings')
      ->set('values', $form_state->getValue('values'))
      ->save();
    parent::submitForm($form, $form_state);
  }

  /**
   * Displays saved form value.
   */
  public function getConfig() {
    return $this->config->get('values');
  }

}
