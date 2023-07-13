<?php
namespace App\Entity;

use Ostyna\ORM\Base\BaseEntity;
use Ostyna\ORM\Utils\DatabaseUtils;

class Admin extends User{

	private int $id;
	private string $roles;

  public function __construct(?int $identifier){
    if(!is_null($identifier) && is_int($identifier)) {
      $entity = DatabaseUtils::get_entity($identifier, 'admin');
    	$this->id = $entity['id'];
			$this->roles = $entity['roles'];

      parent::__construct($identifier);
    }
  }

	public function  setRoles(string $roles) { 
		$this->roles = $roles; 
	}

	public function  getRoles(): string { 
		return $this->roles; 
	}
  
}