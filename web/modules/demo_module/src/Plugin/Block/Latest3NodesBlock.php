<?php

namespace Drupal\demo_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManager;

use Drupal\Core\Routing\CurrentRouteMatch;

/**
 * Provides a latest 3 nodes block.
 *
 * @Block(
 *   id = "demo_module_latest_3_nodes",
 *   admin_label = @Translation("Latest 3 nodes"),
 *   category = @Translation("Custom")
 * )
 */
class Latest3NodesBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity.query service.
   *
   * @var \Symfony\Component\DependencyInjection\ContainerAwareInterface
   */
  protected $entityQuery;
  protected $entityManager;
  protected $currentRoute;

  /**
   * Constructs a new Latest3NodesBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Symfony\Component\DependencyInjection\ContainerAwareInterface $entity_query
   *   The entity.query service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ContainerAwareInterface $entity_query, EntityManager $entity_manager, CurrentRouteMatch $current_route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityQuery = $entity_query;
    $this->entityManager = $entity_manager;
    $this->currentRoute = $current_route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity.query'),
      $container->get('entity.manager'),
      $container->get('current_route_match')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'foo' => $this->t('Hello world!'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['foo'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Foo'),
      '#default_value' => $this->configuration['foo'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['foo'] = $form_state->getValue('foo');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    /*
    $nids = $this->entityQuery->get('node')
      ->condition('status', 1)
      ->condition('type', 'article')
      ->range(0,3)
      ->execute();
    //  ksm($nids);
    $all_data = '';
      $data= node_load_multiple($nids);
      foreach($data as $dat) {
        $all_data .= '<li>'. $dat->getTitle() .'</li>';
      }
        
    //$nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($nids);
    //foreach ($nodes as $node) {
      //$build['last_3_nodes_block']['#markup'] .= $node->getTitle() . '<br>';
   // }
    //$build['#cache']['tags'] = ['node_list'];
    //return $build;
    

    $build['content'] = [
      '#markup' =>  $all_data,      
    ];
    $build['#cache']['tags'] = ['node_list'];
    return $build;    
    */

///////

$node = \Drupal::routeMatch()->getParameter('node');
//ksm($node);
if ($node instanceof \Drupal\node\NodeInterface) {
  // You can get nid and anything else you need from the node object.
  // $nid = $node->title;
   //ksm($node->title->value);
  // ksm($node->getTitle());
   // dsm($node->getValue('title'));
}
$build['content'] = [
  '#markup' =>  'test',      
];
/*
$build['#cache'] = [
  'contexts' => [
    'route',
    'user'
  ],
  'tags' => [
    'node:' . $node->id(),
   // 'user:' . $this->currentUser->id(),
  ]
];*/
return $build;
  }

}
