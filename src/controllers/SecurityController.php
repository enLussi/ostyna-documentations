<?php 

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;
use Ostyna\Component\Framework\Form\FormArchitect;
use Ostyna\Component\Framework\Form\InputEmail;
use Ostyna\Component\Framework\Form\InputPassword;
use Ostyna\Component\Framework\Form\InputSubmit;
use Ostyna\Component\Framework\Form\InputText;
use Ostyna\Component\Framework\Form\Label;

class SecurityController extends AbstractPageController 
{
  public function display() {

    $login_form = new FormArchitect();
    $login_form
      ->add(new InputText('username', new Label(content: "Nom d'utilisateur"), "", [
        'minlength' => [
          'value' => 5,
          'message' => "Doit contenir au moins %v caractères"
        ]
      ]))
      ->add(new InputPassword('password', new Label(content: "Mot de Passe"), "", [
      ]))
      ->add(new InputSubmit(value: "Envoyer"));

    return $this->render('/web/index_security.html', [
      'loginForm' => $login_form->build(),
    ]);
  }

  public function subscribe() {
    $sub_form = new FormArchitect();
    $sub_form
      ->add(new InputText('username', new Label(content: "Nom d'utilisateur"), "", [
        'minlength' => [
          'value' => 5,
          'message' => "Doit contenir au moins %v caractères"
        ]
      ]))
      ->add(new InputEmail('email', new Label(content: "Email"), "", [
      ]))
      ->add(new InputPassword('password', new Label(content: "Mot de Passe"), "", [
      ]))
      ->add(new InputSubmit(value: "Envoyer"));

    return $this->render('/web/index_subscription.html', [
      'subForm' => $sub_form->build(),
    ]);
  }
}