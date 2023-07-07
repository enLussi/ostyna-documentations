<?php

namespace App\Traits;

trait PageDisplayTrait {

  public function connected_user() {
    if(!isset($_SESSION['User'])) {
      return [
        'link' =>  '/connexion',
        'label' => 'Connexion'
      ];
    } else {
      if(in_array('ROLE_ADMIN', $_SESSION['User']['roles'])) {
        return [
          'link' => '/admin/tickets',
          'label' => 'Administration',
        ];
      } else {
        return [
          'link' =>  '/profil',
          'label' => 'Profil'
        ];
      }
    }
  }

}