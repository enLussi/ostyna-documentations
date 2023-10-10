<?php

namespace App\DataSupplies;

use Ostyna\Component\Utils\CoreUtils;
use Ostyna\ORM\Base\BaseSupply;

class SupplyAdmin extends BaseSupply {


  public function supply()
  {
    $admin = json_decode(file_get_contents(CoreUtils::get_project_root().'/new_admin.json'), true);

    $admin['password'] = password_hash($admin['password'], PASSWORD_DEFAULT);

    $id = $this->send_supplies('User', $admin);
    $this->send_supplies('Admin', [
      'id' => $id,
      'roles' => ['ROLE_ADMIN']
    ]);



  }
}