<?php
namespace App\Entity;

use Ostyna\ORM\Base\BaseEntity;
use Ostyna\ORM\Utils\DatabaseUtils;

class State extends BaseEntity{

	private int $id;
	private string $name;

  public function __construct(?int $identifier){
    if(!is_null($identifier) && is_int($identifier)) {
      $entity = DatabaseUtils::get_entity($identifier, 'state');
    	$this->id = $entity['id'];
			$this->name = $entity['name'];
    }
  }

	public function  setId(int $id) { 
		$this->id = $id; 
	}

	public function  getId(): int { 
		return $this->id; 
	}
	public function  setName(string $name) { 
		$this->name = $name; 
	}

	public function  getName(): string { 
		return $this->name; 
	}
  
}