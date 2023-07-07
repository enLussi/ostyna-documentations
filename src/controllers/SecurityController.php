<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;
use Ostyna\Component\Framework\Form\FormArchitect;
use Ostyna\Component\Framework\Form\InputEmail;
use Ostyna\Component\Framework\Form\InputPassword;
use Ostyna\Component\Framework\Form\InputSubmit;
use Ostyna\Component\Framework\Form\InputText;
use Ostyna\Component\Framework\Form\Label;
use Ostyna\Component\Utils\CoreUtils;
use Ostyna\ORM\Utils\DatabaseUtils;

class SecurityController extends AbstractPageController 
{
  public function display() {

    if(!isset($_SESSION['User'])) {
      $login_form = new FormArchitect();
      $login_form
        ->add(new InputText('username', new Label(content: "Nom d'utilisateur", HTMLclass: "form-label"), "", [
          'minlength' => [
            'value' => 5,
            'message' => "Doit contenir au moins %v caractères"
          ],
          'class' => "form-control" 
        ]))
        ->add(new InputPassword('password', new Label(content: "Mot de Passe", HTMLclass: "form-label"), "", [
          "class" => "form-control"
        ]))
        ->add(new InputSubmit(value: "Envoyer", attributes: [
          "class" => "btn btn-primary"
        ]));
        
      // traitement du formulaire
      if(isset($_POST['username'])) {
        $stmt = DatabaseUtils::prepare_request(
          "SELECT * FROM admin INNER JOIN user ON admin.id = user.id WHERE username = :username", 
          [
          'username' => $_POST['username']
          ]);
        $results = DatabaseUtils::execute_request($stmt);
        if(password_verify($_POST['password'], $results[0]['password']) && $_POST['username'] === $results[0]['username']){
          $_SESSION['User'] = [
            'username' => $results[0]['username'],
            'email' => $results[0]['email'],
            'roles' => json_decode($results[0]['roles']),
          ];
          CoreUtils::redirect('mainpage', true);
        }
      }
  
      return $this->render('/web/index_security.html', [
        'loginForm' => $login_form->build(),
      ]);
    }

    CoreUtils::redirect('mainpage', true);
  }

  public function subscribe() {
    $sub_form = new FormArchitect();
    $sub_form
      ->add(new InputText('username', new Label(content: "Nom d'utilisateur", HTMLclass: "form-label"), "", [
        'minlength' => [
          'value' => 5,
          'message' => "Doit contenir au moins %v caractères"
        ],
        "class" => "form-control"
      ]))
      ->add(new InputEmail('email', new Label(content: "Email", HTMLclass: "form-label"), "", [
        "class" => "form-control"
      ]))
      ->add(new InputPassword('password', new Label(content: "Mot de Passe", HTMLclass: "form-label"), "", [
        "class" => "form-control"
      ]))
      ->add(new InputSubmit(value: "Envoyer", attributes: [
        "class" => "btn btn-primary"
      ]));

      // traitement du formulaire

    return $this->render('/web/index_subscription.html', [
      'subForm' => $sub_form->build(),
    ]);
  }

  public function logout(){
    unset($_SESSION['User']);
    CoreUtils::redirect('mainpage', true);
  }
}