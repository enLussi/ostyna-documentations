<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;

class BchangelogController extends AbstractPageController 
{
  public function display() {
    return $this->render('/web/mainpage.html', [
      'controller' => "Controller BchangelogController",
    ]);
  }
}