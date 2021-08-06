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
   * Contains array with countries from taxonomy term.
   *
   * @return array
   *   Array of countries.
   */
  public function getCountries() {
    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', 'country');
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
      '#options' => $this->getCountries(),
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
   *
   * @return array
   *   An associative array containing the structure of the form.
   */
  public function countryCallback(array &$form) {

    return $form['city'];
  }

  /**
   * Contains array with cities depends on selected country.
   *
   * @param string $country
   *   String with country name.
   *
   * @return array
   *   Array with cities.
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
