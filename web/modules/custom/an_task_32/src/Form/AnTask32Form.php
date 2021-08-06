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
   * Contains arrays with countries.
   *
   * @return array
   *   array of countries.
   */
  public function getCountries($vocabulary) {
    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', $vocabulary);
    $tids = $query->execute();
    $terms = Term::loadMultiple($tids);
    $countries['empty'] = NULL;
    foreach ($terms as $term) {
      $countries[$term->name->value] = $term->name->value;
    }

    return $countries;
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
      '#options' => $this->getCountries('country'),
      '#ajax' => [
        'callback' => '::countryCallback',
        'event' => 'change',
        'wrapper' => 'edit-city',
      ],
    ];

    $cities = [];
    $country = $form_state->getValue('country');
    if (!empty($country)) {
      $cities = $this->getCitiesByCountry($country);
    };

    $form['city'] = [
      '#type' => 'select',
      '#title' => $this->t('Cities'),
      '#options' => $cities,
      '#prefix' => '<div id="edit-city">',
      '#suffix' => '</div>',
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

    return $form['city'];
  }

  /**
   * Contains array with cities depends on selected country.
   *
   * @return array
   *   array of cities.
   */
  public function getCitiesByCountry($country) {
    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', 'city');
    $query->condition('field_country.entity.name', $country);
    $tids = $query->execute();
    $terms = Term::loadMultiple($tids);
    foreach ($terms as $term) {
      $cities[$term->name->value] = $term->name->value;
    }

    return $cities;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $country = $form_state->getValue('country');
    $city = $form_state->getValue('city');
    $message = 'Country: ' . $country . ' | City: ' . $city;
    \Drupal::logger('an_task_32')->notice($message);
  }

}
