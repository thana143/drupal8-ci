<?php

namespace Drupal\d8_demo_console\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;

/**
 * Class D8DemoController.
 */
class D8DemoController extends ControllerBase {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var \Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;

  /**
   * Constructs a new D8DemoController object.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Consoleoutput.
   *
   * @return string
   *   Return Hello string.
   */
  public function consoleoutput() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: consoleoutput')
    ];
  }

}
