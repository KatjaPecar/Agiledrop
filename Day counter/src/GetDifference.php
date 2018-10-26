<?php

namespace Drupal\day_counter;

use Drupal\Core\DateTime;


class GetDifference {

  /*
  * calculate time difference.
  */
  public function calculateDifference(DateTime\DrupalDateTime $eventDate) {

    //get current datetime, set timezone
    $todaysDate = new DateTime\DrupalDateTime();
    $todaysDate = $todaysDate->modify('+2 hours');

    //get only dates (not hours)
    $todaysDateOnly = new DateTime\DrupalDateTime($todaysDate->format('Ymd'));
    $eventDateOnly = new DateTime\DrupalDateTime($eventDate->format('Ymd'));

    if ($todaysDateOnly > $eventDateOnly) {
      return 'Event ended.';
    } elseif ($todaysDateOnly < $eventDateOnly) {
      $dayDifference = $eventDateOnly->diff($todaysDateOnly);
      return 'Event will happen in: ' . $dayDifference->format('%d days');
    } elseif ($todaysDateOnly == $eventDateOnly) {
      if ($todaysDate >= $eventDate) {
        return 'Event happened today.';
      } else {
        $timeDifference = $eventDate->diff($todaysDate);
        return 'Time left until todays event: ' . $timeDifference->format("%H h %I min");
      }
    }

  }
}

 ?>
