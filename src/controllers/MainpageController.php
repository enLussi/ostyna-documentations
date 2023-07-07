<?php 

namespace App\Controllers;

use App\Traits\PageDisplayTrait;
use Ostyna\Component\Framework\AbstractPageController;

class MainpageController extends AbstractPageController 
{
  use PageDisplayTrait;

  public function display() {
    return $this->render('/web/index_mainpage.html', [
      'title' => 'Ostyna, Framework PHP Léger pour débutant',
      'connexion_button' => $this->connected_user(),
    ]);
  }
}