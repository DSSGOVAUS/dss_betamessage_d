<?php

/**
*	DSS Beta Message Configuration form
*/

namespace Drupal\dss_betamessage\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SettingsForm extends ConfigFormBase {

  // Return Form ID
  public function getFormId() {
    return 'dss_betamessage_settings_form';
  }

  // Return array of settings that can be modified
  protected function getEditableConfigNames() {
    return array('dss_betamessage.credentials');
  }

  // Build the form
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get the defaults from the config file
    $config = $this->config('dss_betamessage.credentials');

		$form['messagewords'] = array(
			'#type' => 'textarea',
			'#title' => t('Message words'),
			'#default_value' => $config->get('messagewords'),
      '#rows' => 4,
      '#cols' => 60,
		);
    $form['attach_tag'] = array(
      '#type' => 'checkbox',
      '#title' => t('Attach tag to page element'),
      '#default_value' => $config->get('attach_tag'),
    );
		$form['attach_to'] = array(
			'#type' => 'textfield',
			'#title' => t('Element to attach the tag to'),
			'#default_value' => $config->get('attach_to'),
			'#size' => 32,
			'#maxlength' => 32,
		);
    $form['tag'] = array(
      '#type' => 'select',
      '#title' => t('Tag label'),
      '#options' => [
        'none' => '- None -',
        'pilot' => 'Pilot',
        'alpha' => 'Alpha',
        'beta' => 'Beta',
        ],
      '#default_value' => $config->get('tag'),
    );
    $form['behaviour'] = array(
      '#type' => 'select',
      '#title' => t('Behaviour'),
      '#options' => [
        'fixed' => 'Fixed, can’t be hidden',
        'session' => 'Hideable, returns on next session',
        'local' => 'Dismissible, doesn’t return (unless localStorage is cleared)',
        ],
      '#default_value' => $config->get('behaviour'),
    );
    $form['theme'] = array(
      '#type' => 'select',
      '#title' => t('Theme'),
      '#options' => [
        'dark' => 'Dark',
        'light' => 'Light',
        ],
      '#default_value' => $config->get('theme'),
    );
		return parent::buildForm($form, $form_state);
	}

  // Save new values on Form Submit
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('dss_betamessage.credentials')
		->set('messagewords', $form_state->getValue(array('messagewords')))
    ->set('attach_tag', $form_state->getValue(array('attach_tag')))
		->set('attach_to', $form_state->getValue(array('attach_to')))
    ->set('theme', $form_state->getValue(array('theme')))
    ->set('tag', $form_state->getValue(array('tag')))
    ->set('behaviour', $form_state->getValue(array('behaviour')))
    ->save();
    parent::submitForm($form, $form_state);
  }

}
