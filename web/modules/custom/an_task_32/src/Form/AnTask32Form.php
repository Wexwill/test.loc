<?php

namespace Drupal\an_task_32\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;

/**
 * Defines a form.
 */
class AnTask32Form extends FormBase {

  /**
   * Contains arrays with taxonomy terms.
   *
   * @return array
   *   array of taxonomy terms
   */
  public function getTerms($vocabulary) {
    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', $vocabulary);
    $tids = $query->execute();
    $terms = Term::loadMultiple($tids);
    foreach ($terms as $term) {
      $values[] = $term->name->value;
    }

    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'an_task_32_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['country'] = [
      '#type' => 'select',
      '#title' => $this->t('Countries'),
      '#options' => $this->getTerms('country'),
    ];

    $form['city'] = [
      '#type' => 'select',
      '#title' => $this->t('Cities'),
      '#options' => $this->getTerms('city'),
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
    $message = 'Country: ' . $form_state->getValue('country') . ' | city: ' . $form_state->getValue('city');
    \Drupal::logger('an_task_32')->notice($message);
  }

}
