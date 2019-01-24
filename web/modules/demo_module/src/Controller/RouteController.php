<?php

namespace Drupal\demo_module\Controller;

use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use Drupal\Core\DependencyInjection\ContainerInjectionInterface; --1
use Drupal\Core\Controller\ControllerBase;



//Class RouteController implements ContainerInjectionInterface{ --1
Class RouteController extends ControllerBase { # allows to use traits and string translation.
    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }
    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
        $container->get('http_client')
        );
    }
    public function hello_world() {
        $response = $this->client->request('GET', 'http://jsonplaceholder.typicode.com/posts/1');
        $markup = $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'    
        return [
            '#type' => '#markup',
            '#markup' => $markup
        ];
    }
    public function helloDynamic($name) {
        return [
            '#type' => '#markup',
            '#markup' => 'Hello ' . $name . '!',
        ];
    }
    public function helloDynamicTitleCallback($name) {
        return 'Hello ' . $name . '!';        
    }
    public function helloDynamicEntity(UserInterface $user) {
      // kint_trace($user);//exit;
        return [
            '#type' => '#markup',
            '#markup'  =>  'Hello'." ".$user->getUsername(),
        ];
        //return 'Hello ' . $name . '!';        
    }
    public function helloDynamicEntityTitleCallback(UserInterface $user) {
        return 'Hello ' . $user->getUsername();       
    }
    public function helloDynamicEntityNode(NodeInterface $node) {
        //$node->getT
      // ksm($node->getRevisionAuthor()->getDisplayName());
        return [
            '#type' => '#markup',
            '#markup'  =>  'Hello' . $node->getTitle() . '-'.  $node->getRevisionAuthor()->getDisplayName(),
        ];
        //return 'Hello ' . $user->getUsername();       
    }
    public function helloDynamicEntityTitleNode(NodeInterface $node) {
        return 'Hello '. $node->getTitle() .'-'. $node->getRevisionAuthor()->getDisplayName();       
    }
    public function listNodeAccess(NodeInterface $node, AccountInterface $account) {
       // ksm($node->getOwnerId());
        //ksm($account->id());
        return AccessResult::allowedIf($node->getOwnerId() === $account->id());
 }

}