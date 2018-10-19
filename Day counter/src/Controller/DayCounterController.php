<?php
/**
* @file
* Contains \Drupal\day_counter\Controller\DayCounterController.
*/

namespace Drupal\day_counter\Controller;


class DayCounterController {
  public function content() {

    $myVariable = date("m/d/Y");

    return [
      '#type' => 'markup',
      '#markup' => 'Today is: ' . $myVariable,
    ];
  }
}
