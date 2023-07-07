<?php

namespace App\DataSupplies;

use Ostyna\ORM\Base\BaseSupply;

class SupplyAdmin extends BaseSupply {


  public function supply()
  {
    $admin = [
      "email" => "admin@admin.fr",
      "username" => "admin_admin",
      "password" => password_hash("password", PASSWORD_DEFAULT),
    ];


    $id = $this->send_supplies('user', $admin);
    $this->send_supplies('admin', [
      'id' => $id,
      'roles' => ['ROLE_ADMIN']
    ]);



  }
}