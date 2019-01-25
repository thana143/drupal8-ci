<?php
namespace Drupal\demo_module\Event;

use Symfony\Component\EventDispatcher\Event;
use Drupal\node\NodeInterface;

class NodeInsertEvent extends Event {
  public $node;
  public function __construct(NodeInterface $node) {
    $this->node = $node;
  }
}