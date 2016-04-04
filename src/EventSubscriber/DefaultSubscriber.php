<?php

/**
 * @file
 * Contains \Drupal\datetime_repeat\DefaultSubscriber.
 */

namespace Drupal\datetime_repeat\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class DefaultSubscriber.
 *
 * @package Drupal\datetime_repeat
 */
class DefaultSubscriber implements EventSubscriberInterface {

  /**
   * Constructor.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {

    return $events;
  }


}
