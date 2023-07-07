<?php 

namespace App\Controllers;

use App\Traits\PageDisplayTrait;
use DateTime;
use Ostyna\Component\Framework\AbstractPageController;
use Ostyna\Component\Framework\Form\FormArchitect;
use Ostyna\Component\Framework\Form\InputCheckbox;
use Ostyna\Component\Framework\Form\InputText;
use Ostyna\Component\Framework\Form\Label;
use Ostyna\Component\Framework\Form\Option;
use Ostyna\Component\Framework\Form\Select;
use Ostyna\Component\Framework\Form\Textarea;
use Ostyna\ORM\Utils\DatabaseUtils;

class TicketsController extends AbstractPageController 
{
  use PageDisplayTrait;

  public function display() {


    $version_form = new FormArchitect(id: "version");
    $version_form
      ->add(new Select("version-select", new Label(content: "Sélectionner une version", HTMLclass: "form-label"), options: [
        new Option([
          'value' => ''
        ], content: ""),
        new Option([
          'value' => '1'
        ], content: "dev"),
        new Option([
          'value' => '2'
        ], content: "1.0 stable")
      ], attributes:[
        "class" => 'form-control',
        "id" => "version-select"
      ] ));
    
    $tickets_form = new FormArchitect(id: "list");
    $tickets_form
      ->add(new Select("tickets", new Label(content: "Sélectionner un ticket similaire", HTMLclass: "form-label"), options:[
        new Option(attributes: [
          'value' => ""
        ], content: ""),
        new Option(attributes: [
          'value' => "1"
        ], content: "bug sur l'affichage des arrays."),
        new Option(attributes: [
          'value' => "2"
        ], content: "ajout d'une logique au template (if, for)"),
      ], attributes:[
        "class" => "form-control",
        "id" => "tickets",
      ] ))
      ->add(new InputCheckbox('new_ticket', new Label(content: "Créer un nouveau ticket"), attributes: [
        'required' => 'false',
        "class" => 'form-check-input',
        "id" => "new_ticket",
      ]))
      ;

    $new_ticket_form = new FormArchitect(id: "ticket");
    $new_ticket_form
      ->add(new InputText('title', new Label(content: "Titre", HTMLclass:"form-label"), attributes: [
        "class" => 'form-control'
      ]))
      ->add(new Textarea('content', new Label(content: "Expliquez votre problème", HTMLclass: 'form-label'), attributes: [
        "class" => "form-control"
      ]))
      ->add(new Select('seriousness', new Label(content: "Gravité", HTMLclass: 'form-label'), attributes: [
        "class" => "form-control"
      ],
      options: [
        new Option(attributes: [
          'value' => '1'
        ], content: "faible"),
        new Option(attributes: [
          'value' => '2'
        ], content: "important"),
        new Option(attributes: [
          'value' => '3'
        ], content: "urgent"),
      ]));

    $add_remark_form = new FormArchitect(id: "remark");
    $add_remark_form
      ->add(new Textarea('remark', new Label(content: "Ajouter une remarque", HTMLclass: "form-label"), attributes: [
        "class" => "form-control"
      ]));

    //traitement du formulaire
    if(isset($_POST['version'])) {
      var_dump($_POST);
      if(isset($_POST['isnew']) && $_POST['isnew'] === "true") {

        $title = $_POST['title'];
        $date = date('Y-m-d G:i:s', time());
        $content = preg_quote($_POST['content']);
        $seriousness = intval($_POST['seriousness']);
        
        DatabaseUtils::sql(
          "INSERT INTO tickets (title, date, content, seriousness, author_id, resolver_id, state_id)
          VALUES ('$title', '$date', \"$content\", $seriousness, 3, 3, 1)", respond: true);

      } elseif(isset($_POST['isnew']) && $_POST['isnew'] === "false") {

        $content = preg_quote($_POST['remark']);
        $date = date('Y-m-d G:i:s', time());
        DatabaseUtils::sql(
          "INSERT INTO remark (content, date, ticket_id, author_id)
          VALUES (\"$content\", '$date', 2, 3)");
      }
      // $stmt = DatabaseUtils::prepare_request('INSERT')

      return json_encode('ok');
    }

    return $this->render('/web/index_tickets.html', [
      'title' => "Rapporter un bug",
      'connexion_button' => $this->connected_user(),
      'ticketsForms' => [ 
        'version' => $version_form->build(), 
        'list' => $tickets_form->build(), 
        'ticket' => $new_ticket_form->build(), 
        'remark' => $add_remark_form->build()
      ],
    ]);
  }
}