<?php

namespace App;

use Ostyna\Core\BaseCore;

class Core {

  // Configure routes here
  // Add packages here

  private $APP;

  public function __construct(){
    
  }

  public function start(){

    $this->APP = BaseCore::getInstance();
    $this->APP->load();
  
  }

}