<?php

namespace Drupal\time_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class TimeLocationForm extends ConfigFormBase {
    

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'time_location_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
        'time_location.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('time_location.settings');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#description' => $this->t('Enter the Country Name'),
      '#default_value' => $config->get('country'),
      '#required' => true,
    ];
    $form['city'] = [
        '#type' => 'textfield',
        '#title' => $this->t('City'),
        '#description' => $this->t('Enter the City Name'),
        '#default_value' => $config->get('city'),
        '#required' => true,
      ];
    $form['time_zone'] = [
        '#type' => 'select',
        '#title' => $this->t('Select the Time Zone'),
        '#options' => [
            'America/Chicago' => $this->t('America/Chicago'),
            'America/New_York' => $this->t('America/New_York'),
            'Asia/Tokyo' => $this->t('Asia/Tokyo'),
            'Asia/Dubai' => $this->t('Asia/Dubai'),
            'Asia/Kolkata' => $this->t('Asia/Kolkata'),
            'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
            'Europe/Oslo' => $this->t('Europe/Oslo'),
            'Europe/London' => $this->t('Europe/London'),
          ],
        '#default_value' => $config->get('time_zone'),
        '#required' => true,
      ];
      
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->configFactory->getEditable('time_location.settings');
    $config->set('country', $form_state->getValue('country'));
    $config->set('city', $form_state->getValue('city'));
    $config->set('time_zone', $form_state->getValue('time_zone'));
    $config->save();
    
    parent::submitForm($form, $form_state);
  }

}