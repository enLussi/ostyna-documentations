<?php

namespace App\Traits;

use Ostyna\Component\Utils\CoreUtils;
use Ostyna\ORM\Utils\DatabaseUtils;

trait PageDisplayTrait {

  public function connected_user() {
    if(!isset($_SESSION['User'])) {
      return [
        'link' =>  '/connexion',
        'label' => 'Connexion',
        'connected' => false,
      ];
    } else {
      if($this->verify_user_granted('ROLE_ADMIN')) {
        return [
          'link' => '/admin/tickets',
          'label' => 'Administration',
          'connected' => true,
        ];
      } elseif(!is_null($this->get_user())) {
        return [
          'link' =>  '/profil',
          'label' => 'Profil',
          'connected' => true,
        ];
      } else {
        CoreUtils::redirect('logout');
        return [
          'link' =>  '/connexion',
          'label' => 'Connexion',
          'connected' => false,
        ];
      }
    }
  }

}