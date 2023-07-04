<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;

class TicketsController extends AbstractPageController 
{
  public function display() {
    return $this->render('/web/mainpage.html', [
      'controller' => "Controller TicketsController",
    ]);
  }
}