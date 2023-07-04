<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;

class DocumentationController extends AbstractPageController 
{
  public function display() {
    return $this->render('/web/mainpage.html', [
      'controller' => "Controller DocumentationController",
    ]);
  }
}