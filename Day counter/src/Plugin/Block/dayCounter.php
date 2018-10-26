<?php

namespace Drupal\day_counter\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\day_counter\GetDifference;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\DateTime;

/**
 * Provides a 'Day counter' Block.
 *
 * @Block(
 *   id = "day_counter_block",
 *   admin_label = @Translation("Day counter"),
 *   category = @Translation("Day counter module"),
 * )
 */
class DayCounter extends BlockBase implements ContainerFactoryPluginInterface {

  protected $getDifference;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, GetDifference $getDifference) {
     parent::__construct($configuration, $plugin_id, $plugin_definition);
     $this->getDifference = $getDifference;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
     $configuration,
     $plugin_id,
     $plugin_definition,
     $container->get('day_counter.get_difference')
   );
  }

  public function build() {

    // get currently displayed node based on url
    $node = \Drupal::routeMatch()->getParameter('node');

    // get event time from article
    $eventDate = $node->field_event_date->value;
    $eventDate = '2018-10-27 00:59:01';

    // call service method to calculate difference in days
    $output = $this->getDifference->calculateDifference(new DateTime\DrupalDateTime($eventDate));

    return array(
      '#type' => 'markup',
      '#markup' => $this->t($output),
    );
  }

  public function getCacheMaxAge() {
        return 0;
    }


}
