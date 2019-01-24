<?php
namespace Drupal\demo_module\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormInterface;



Class SimpleForm implements FormInterface {

    public function getFormId() {
        return 'simpleform';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => 'Name',        
            '#size' => 60,
            '#maxlength' => 128,
            '#required' => TRUE,
          );
          $form['submit'] = array(
            '#type' => 'submit',
            '#value' => 'submit',        
          );
          return $form;

    }
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        ksm($form_state);

    }


}


