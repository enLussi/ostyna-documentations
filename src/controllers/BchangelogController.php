<?php 

namespace App\Controllers;

use App\Entity\Repositories;
use Ostyna\Component\Framework\AbstractPageController;
use Ostyna\Component\Framework\Form\FormArchitect;
use Ostyna\Component\Framework\Form\InputSubmit;
use Ostyna\Component\Framework\Form\InputText;
use Ostyna\Component\Framework\Form\Label;
use Ostyna\Component\Framework\Form\Textarea;
use Ostyna\Component\Utils\CoreUtils;
use Ostyna\ORM\Utils\DatabaseUtils;

class BchangelogController extends AbstractPageController 
{
  public function display() {

    if($this->verify_user_granted('ROLE_ADMIN') === false){
      CoreUtils::redirect('mainpage');
    }

    if(isset($_GET['id']) && Repositories::verifyChangelogs($_GET['id'])) {
      $changelog = Repositories::getChangelog($_GET['id']);

      $blocks = json_decode($changelog->getContent(), true)['blocks'];
      // dd($blocks);
      $content = "<div>";
      foreach($blocks as $block) {

        switch($block['type']){
          case "header":
            $level = $block['data']['level'];
            $text = $block['data']['text'];
            $content .= "<h$level>$text</h$level>";
            break;
          case "paragraph":
            $text = $block['data']['text'];
            $content .= "<p>$text</p>";
        }

      }
      $content .= "</div>";

      return $this->render('/web/index_bchangelog.html', [
        'title' => 'Changelogs',
        'changelog' => $changelog,
        'content' => $content,
      ]);
    }

    $all_changelogs = Repositories::getAllChangelogs();
    $changelog_format = "<ul class='list-group'>";

    foreach($all_changelogs as $changelog) {
      $version = Repositories::getVersion($changelog['version_id']);

      $changelog_format .=
      "<li class='list-group-item'>
      <a class='link-underline link-underline-opacity-0' href='/admin/changelogs?id=$changelog[id]'>".$version->getName()."</a>
      </li>";
    }
    $changelog_format .= "</ul>";

    

    return $this->render('/web/index_bchangelogs.html', [
      'title' => 'Gestion des Changelogs',
      'changelogs' => $changelog_format,
    ]);
  }

  public function add() {

    if($this->verify_user_granted('ROLE_ADMIN') === false){
      CoreUtils::redirect('mainpage');
    }

    $version_form = new FormArchitect(id: "newChangelog");
    $version_form
      ->add(new InputText('version', new Label(content: 'Nom de la version', HTMLclass: 'form-label'), attributes: [
        "class" => "form-control"
      ]))
      ->add(new InputText('link', new Label(content: 'Lien de téléchargement', HTMLclass: "form-label"), attributes: [
        "class" => "form-control"
      ]))
      // ->add(new Textarea('content', new Label(content: 'Changements', HTMLclass: "form-label"), attributes: [
      //   "class" => "form-control"
      // ]))
      // ->add(new InputSubmit(value: "Envoyer", attributes: [
      //   "class" => "btn btn-primary"
      // ]))
      ;
    
    
    if(isset($_POST['version'])) {

      $link = $_POST['link'];
      $name = $_POST['version'];
      $version_id = DatabaseUtils::sql(
        "INSERT INTO version (link, name, issupported) VALUES ('$link', '$name', 1)", respond: true
      );

      $date = date('Y-m-d G:i:s', time());
      $content = $_POST['content'];
      $author_id = $this->get_user()->getId();

      DatabaseUtils::sql(
        "INSERT INTO changelog (date, content, version_id, author_id) VALUES (:date, :content, $version_id, $author_id)",
        [
          "date" => $date,
          "content" => $content,
        ]
      );

      return json_encode('ok');
    }

    return $this->render('/web/index_bchangelogs_add.html', [
      'title' => "Ajout d'un Changelogs",
      'changelog' => $version_form->build(),
    ]);

  }

  public function edit() {

  }

  public function delete() {

  }
}