<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;

class ChangelogController extends AbstractPageController 
{
  public function display() {
    return $this->render('/web/mainpage.html', [
      'controller' => "Controller ChangelogController",
    ]);
  }
}