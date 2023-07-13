<?php 

namespace App\Controllers;

use App\Entity\Repositories;
use Ostyna\Component\Framework\AbstractPageController;
use Ostyna\Component\Framework\Form\FormArchitect;
use Ostyna\Component\Framework\Form\Label;
use Ostyna\Component\Framework\Form\Option;
use Ostyna\Component\Framework\Form\Select;
use Ostyna\Component\Utils\CoreUtils;
use Ostyna\ORM\Utils\DatabaseUtils;

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
      
      foreach($states as $state) {
        array_push($options, new Option(attributes: [
          'value' => strval($state['id']),
          'selected' => ($state['id'] === $ticket->getState()) ? "true" : false,
        ], content: $state['name']));
      }
      // dd($options);
      $state_form = new FormArchitect();
      $state_form->add(new Select('state', new Label(content: "Etat", HTMLclass: 'form-label'), attributes: [
        "class" => "form-control",
        "id" => "selectState"
      ], options: array_values($options)));

      if(isset($_POST['value'])) {
        DatabaseUtils::sql(
          "UPDATE tickets SET state_id = $_POST[value]  WHERE id = :id", [
            "id" => strval($_GET['id'])
          ]);
        return "prout";
      }

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
    $ticket_format .= "</ul>";
    

    return $this->render('/web/index_btickets.html', [
      'title' => 'Gestion des Tickets',
      'tickets' => $ticket_format,
    ]);
  }
}