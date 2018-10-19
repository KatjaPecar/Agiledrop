<?php

namespace Drupal\day_counter\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Day counter' Block.
 *
 * @Block(
 *   id = "day_counter_block",
 *   admin_label = @Translation("Day counter"),
 *   category = @Translation("Day counter module"),
 * )
 */
class DayCounter extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $eventDate = 'Fri, 10/28/2018 - 20:00';
    //$date = substr($eventDate, 4, 11);
    $date = explode("/",substr($eventDate, 4, 11));
    $day = trim($date[1]);
    $month = trim($date[0]);
    $year = trim($date[2]);

    //$todaysDate = date("m/d/Y");
    $todaysDate = date("Ymd");
    $givenDate = $year . $month . $day;

    $output = '';

    if ($givenDate < $todaysDate) {
      $output = 'The event has ended.';
    } elseif ($givenDate > $todaysDate) {
      $daysLeft = $givenDate - $todaysDate;
      $output = 'Days left to event start: ' . $daysLeft;
    } else {
      $output = 'This event is happening today.';
    }


    return array(
      '#type' => 'markup',
      //'#markup' => $this->t('My block thingie-!: '. $todaysDate . '; my date: ' . $date[2] . ', <br> given date: ' . $givenDate . '<br> today: ' . $todaysDate . '<br>' . $output),
      '#markup' => $this->t($output),
    );
  }

  public function getCacheMaxAge() {
        return 0;
    }


}
