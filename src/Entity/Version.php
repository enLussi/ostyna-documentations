<?php
namespace App\Entity;

use Ostyna\ORM\Base\BaseEntity;
use Ostyna\ORM\Utils\DatabaseUtils;

class Version extends BaseEntity{

	private int $id;
	private string $link;
	private string $name;
	private bool $issupported;

  public function __construct(?int $identifier){
    if(!is_null($identifier) && is_int($identifier)) {
      $entity = DatabaseUtils::get_entity($identifier, 'Version');
    	$this->id = $entity['id'];
			$this->link = $entity['link'];
			$this->name = $entity['name'];
			$this->issupported = $entity['issupported'];
    }
  }

	public function  setId(int $id) { 
		$this->id = $id; 
	}

	public function  getId(): int { 
		return $this->id; 
	}
	public function  setLink(string $link) { 
		$this->link = $link; 
	}

	public function  getLink(): string { 
		return $this->link; 
	}
	public function  setName(string $name) { 
		$this->name = $name; 
	}

	public function  getName(): string { 
		return $this->name; 
	}
	public function  setIssupported(bool $issupported) { 
		$this->issupported = $issupported; 
	}

	public function  getIssupported(): bool { 
		return $this->issupported; 
	}
  
}