<?php 

namespace App\Controllers;

use App\Entity\Repositories;
use Ostyna\Component\Framework\AbstractPageController;
use Ostyna\Component\Framework\Form\FormArchitect;
use Ostyna\Component\Framework\Form\Label;
use Ostyna\Component\Framework\Form\Option;
use Ostyna\Component\Framework\Form\Select;
use Ostyna\Component\Utils\CoreUtils;

class BticketsController extends AbstractPageController 
{
  public function display() {

    if($this->verify_user_granted('ROLE_ADMIN') === false){
      CoreUtils::redirect('mainpage');
    }

    if(isset($_GET['id']) && Repositories::verifyTicket($_GET['id'])) {
      $ticket = Repositories::getTicket($_GET['id']);

      $states = Repositories::getAllStates();
      $options = [];
      var_dump($states);
      foreach($states as $state) {
        array_push($options, new Option([
          "value" => $state['id']
        ], content: $state['name']));
      }

      $state_form = new FormArchitect();
      $state_form->add(new Select('state', new Label(content: "Etat", HTMLclass: 'form-label'), attributes: [
        "class" => "form-control"
      ], options: $options));


      return $this->render('/web/index_bticket.html', [
        'title' => 'Gestion des Tickets',
        'ticket' => $ticket,
        'stateForm' => $state_form->build(),
      ]);
    }

    $all_tickets = Repositories::getAllTickets();
    $ticket_format = "<ul>";

    foreach($all_tickets as $ticket) {
      $ticket_format .="<li><a href='/admin/tickets?id=$ticket[id]'>$ticket[title]</a></li>";
    }

    

    return $this->render('/web/index_btickets.html', [
      'title' => 'Gestion des Tickets',
      'tickets' => $ticket_format,
    ]);
  }
}