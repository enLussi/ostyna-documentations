<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;

class BticketsController extends AbstractPageController 
{
  public function display() {
    return $this->render('/web/mainpage.html', [
      'controller' => "Controller BticketsController",
    ]);
  }
}