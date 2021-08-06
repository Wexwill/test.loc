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
    $values['empty'] = NULL;
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
      '#validated' => TRUE,
      '#ajax' => [
        'callback' => '::countryCallback',
        'event' => 'change',
        'wrapper' => 'edit-city',
      ],
    ];

    $form['city'] = [
      '#type' => 'select',
      '#title' => $this->t('Cities'),
      '#options' => [NULL],
      '#prefix' => '<div id="edit-city">',
      '#suffix' => '</div>',
      '#validated' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * Contains callback function for Country field.
   */
  public function countryCallback(array &$form, FormStateInterface $form_state) {
    $country = $form['country']['#options'][$form_state->getValue('country')];
    $cities = $this->citiesArray($country);
    $form['city']['#options'] = $cities;

    return $form['city'];
  }

  /**
   * Gets terms and creates array with key: City and value: Country.
   *
   * @return array
   *   array with cities depends on selected country.
   */
  public function citiesArray($country) {
    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', 'city');
    $tids = $query->execute();
    $terms = Term::loadMultiple($tids);
    foreach ($terms as $term) {
      $array[$term->name->value] = $term->get('field_country')->entity->name->value;
    }
    $cities = array_keys($array, $country);

    return $cities;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $country = $form['country']['#options'][$form_state->getValue('country')];
    $city = $this->citiesArray($country)[$form_state->getValue('city')];
    $message = 'Country: ' . $country . ' | City: ' . $city;
    \Drupal::logger('an_task_32')->notice($message);
  }

}
