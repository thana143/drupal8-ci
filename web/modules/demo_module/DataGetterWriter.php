<?php
namespace Drupal\demo_module;

use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

class DataGetterWriter implements ContainerInjectionInterface {

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
  
  public function getPerson() {
    return $this->connection
      ->select('d8_demo', 'c')
      ->fields('c')
      ->range(1,2)
      ->execute()
      ->fetchAssoc();
  }

  public function writePerson($firstName, $lastName) {
    return $this->connection->insert('d8_demo')->fields(
      [
        'first_name' => $firstName,
        'last_name' => $lastName,
      ]
    )->execute();
  }
}