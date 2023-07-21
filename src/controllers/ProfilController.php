<?php 

namespace App\Controllers;

use App\Entity\Repositories;
use App\Traits\PageDisplayTrait;
use Ostyna\Component\Framework\AbstractPageController;
use Ostyna\Component\Utils\CoreUtils;

class ProfilController extends AbstractPageController 
{
  use PageDisplayTrait;

  public function display() {

    if(!$this->get_user()){
      CoreUtils::redirect('mainpage', true);
    }

    $current_user = $this->get_user();

    $tickets = Repositories::getTicketsFromUser($current_user->getId());

    foreach($tickets as $index => $ticket) {
      $tickets[$index]['state_label'] = Repositories::getStatesByTickets($ticket['id'])['name'];
    }

    return $this->render('/web/index_profil.html', [
      'title' => 'Profil de '.$current_user->getUsername(),
      'connexion_button' => $this->connected_user(),
      'user' => $current_user,
      'tickets' => $tickets,
    ]);
  }
}