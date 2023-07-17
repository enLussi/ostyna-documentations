<?php 

namespace App\Controllers;

use App\Traits\PageDisplayTrait;
use Ostyna\Component\Framework\AbstractPageController;

class DocumentationController extends AbstractPageController 
{
  use PageDisplayTrait;

  public function display() {
    return $this->render('/web/index_documentation.html', [
      'title' => 'Documentation',
      'connexion_button' => $this->connected_user(),
    ]);
  }
}