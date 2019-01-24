<?php
namespace Drupal\demo_module\Form;

use Drupal\demo_module\DataGetterWriter;
use Drupal\demo_module\DataGetterWriterInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

use Drupal\Core\Database\Connection;


class DIForm extends FormBase {
  protected $connection;
 

  public function __construct(Connection $Connection) {
    $this->connection = $connection;
  }
  /**
   * {@inheritdoc}
   */

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('demo_module.data_getter_writer')
    );
  }

    /**
     * @inheritDoc
     */
    public function getFormId() {
      return 'demo_di_formsss';
    }
  

    /**
     * @inheritDoc
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
     // $person = $this->dataGetterWriter->getPerson();
      $form ['first_name'] = [
        '#type' => 'textfield',
        '#title' => t('First name'),
        '#size' => 60,
        '#maxlength' => 128,
        '#required' => TRUE,
        '#default_value' => $person['first_name'],
      ];
      $form ['last_name'] = [
        '#type' => 'textfield',
        '#title' => t('Last name'),
        '#size' => 60,
        '#maxlength' => 128,
        '#required' => TRUE,
        '#default_value' => $person['last_name'],
      ];
  
      $form['submit'] = [
        '#type' => 'submit',
        '#value' => t('Submit')
      ];
  
      return $form;
    }
  
    /**
     * @inheritDoc
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      $this->dataGetterWriter->writePerson(
        $form_state->getValue('first_name'),
        $form_state->getValue('last_name')
      );
    }
  }