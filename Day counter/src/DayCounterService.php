<?php

namespace Drupal\day_counter;

use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Entity\EntityManager;

/*
* Day counter service.
*/

class DayCounterService {

  private $entityQuery;
  private $entityManager;

  public function __construct(QueryFactory $entityQuery, EntityManager $entityManager) {
    $this->entityQuery = $entityQuery;
    $this->entityManager = $entityManager;
  }

  /*
  * Method for getting a date of an event.
  */
  public function getEventDate() {

    $entity = 'My random text.';
    //$node_id = $node->id();
    $articleNids = $this->entityQuery->get('node')->condition('type', 'event')->execute();
    return $this->entityManager->getStorage('node')->loadMultiple($articleNids);

  }
}

 ?>
