<?php

namespace Drupal\demo_module\Access;

use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;


class UserAuthorSame implements AccessInterface {
  public function access(NodeInterface $node, AccountInterface $account) {
    return AccessResult::allowedIf($node->getOwnerId() === $account->id());
  }
}