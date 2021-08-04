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
  public function getTerms() {
    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', "Country");
    $tids = $query->execute();
    $country_terms = Term::loadMultiple($tids);
    foreach ($country_terms as $term) {
      $terms['Country'][] = $term->name->value;
    }

    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', "City");
    $tids = $query->execute();
    $city_terms = Term::loadMultiple($tids);
    foreach ($city_terms as $term) {
      $terms['City'][] = $term->name->value;
    }

    return $terms;
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
    $form['country_fields'] = [
      '#type' => 'select',
      '#title' => $this->t('Countries'),
      '#options' => $this->getTerms()['Country'],
    ];

    $form['city_fields'] = [
      '#type' => 'select',
      '#title' => $this->t('Cities'),
      '#options' => $this->getTerms()['City'],
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
    $message = 'Country: ' . $form_state->getValue('country_fields') . ' | city: ' . $form_state->getValue('city_fields');
    \Drupal::logger('an_task_32')->notice($message);
  }

}
