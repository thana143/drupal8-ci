<?php

namespace Drupal\demo_module\EventSubscriber;

use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\demo_module\Event\NodeInsertEvent;

/**
 * Drupal 8 Demo event subscriber.
 */
class NodeInsertLogSubmitSubscriber implements EventSubscriberInterface {

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;
  protected $logger;

  /**
   * Constructs event subscriber.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger.
   */
  public function __construct(MessengerInterface $messenger, LoggerChannelFactory $logger) {
    $this->messenger = $messenger;
    $this->logger =  $logger->get('demo_module');
  }



  public function nodeInsertLog(NodeInsertEvent $event) {
    $this->logger->info($event->node->getTitle());
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      'node.insert' => ['nodeInsertLog'],      
    ];
  }

}
