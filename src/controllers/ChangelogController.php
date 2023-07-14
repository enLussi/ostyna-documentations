<?php 

namespace App\Controllers;

use App\Entity\Repositories;
use App\Traits\PageDisplayTrait;
use Ostyna\Component\Framework\AbstractPageController;

class ChangelogController extends AbstractPageController 
{
  use PageDisplayTrait;

  public function display() {

    if(isset($_GET['id']) && Repositories::verifyVersions($_GET['id'])) {
      $version = Repositories::getVersion($_GET['id']);
      $changelogs = Repositories::getChangelogsByVersion($_GET['id']);
      $blocks = json_decode($changelogs[0]['content'], true)['blocks'];
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

      return $this->render('/web/index_changelog.html', [
        'title' => "Changelogs ".$version->getName(),
        'version' => $version->getName(),
        'content' => $content,
        'connexion_button' => $this->connected_user(),
      ]);
    }

    $versions = Repositories::getAllVersions();
    $version_format = "<ul>";

    foreach($versions as $version) {
      $version_format .="<li><a href='/changelog?id=$version[id]'>$version[name]</a></li>";
    }
    $version_format .= "</ul>";

    return $this->render('/web/index_changelogs.html', [
      'title' => 'Changelogs',
      'versions' => $version_format,
      'connexion_button' => $this->connected_user(),
    ]);
  }
}