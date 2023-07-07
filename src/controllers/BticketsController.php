<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;

class BticketsController extends AbstractPageController 
{
  public function display() {

    if(isset($_SESSION['User']) && in_array('ROLE_ADMIN', $_SESSION['User']['roles'])){
      
    }

    return $this->render('/web/index_btickets.html', [
      'controller' => "Controller BticketsController",
    ]);
  }
}