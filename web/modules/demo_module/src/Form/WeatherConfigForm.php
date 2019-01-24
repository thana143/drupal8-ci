<?php
namespace Drupal\demo_module\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;



Class WeatherConfigForm extends ConfigFormBase {

    public function getFormId() {
        return 'weather_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $this->config('config.name')->get('key');
        $form['api_key'] = array(
            '#type' => 'textfield',
            '#title' => 'API Key',        
            '#size' => 60,
            '#maxlength' => 128,
            '#required' => TRUE,
            '#default_value' => $this->config('demo_module.weather')->get('api_key')
          );
         /* $form['submit'] = array(
            '#type' => 'submit',
            '#value' => 'submit',        
          );*/
          return parent::buildForm($form, $form_state);

    }
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        //ksm($form_state->getValue('api_key'));  
        $this->config('demo_module.weather')
      ->set('api_key', $form_state->getValue('api_key'))
      ->save();
      return parent::submitForm($form, $form_state);

    }
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
        'demo_module.weather',
        ];
    }
}