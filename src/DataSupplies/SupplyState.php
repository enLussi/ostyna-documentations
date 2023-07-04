<?php

namespace App\DataSupplies;

use Ostyna\ORM\Base\BaseSupply;

class SupplyState extends BaseSupply {


  public function supply()
  {
    $states = [
      'En attente', 'En cours', 'Résolu'
    ];

    foreach($states as $state) {
      $this->send_supplies('State', [
        'name' => $state 
      ]);
    }


  }
}