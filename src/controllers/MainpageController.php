<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;

class MainpageController extends AbstractPageController 
{
  public function display() {
    return $this->render('/web/index_mainpage.html', [
      'controller' => "Controller MainpageController",
    ]);
  }
}