<?php
namespace App\Entity;

use Ostyna\ORM\Base\BaseEntity;
use Ostyna\ORM\Utils\DatabaseUtils;

class User extends BaseEntity{

  private int $id;
	private string $email;
	private string $username;
	private string $password;

  public function __construct(?int $identifier){
    if(!is_null($identifier) && is_int($identifier)) {
      $entity = DatabaseUtils::get_entity($identifier, 'user');
      $this->id = $entity['id'];
			$this->email = $entity['email'];
			$this->username = $entity['username'];
			$this->password = $entity['password'];
    }
  }

  public function  setId(int $id) { 
  $this->id = $id; 
	}

	public function  getId(): int { 
		return $this->id; 
	}
	public function  setEmail(string $email) { 
		$this->email = $email; 
	}

	public function  getEmail(): string { 
		return $this->email; 
	}
	public function  setUsername(string $username) { 
		$this->username = $username; 
	}

	public function  getUsername(): string { 
		return $this->username; 
	}
	public function  setPassword(string $password) { 
		$this->password = $password; 
	}

	public function  getPassword(): string { 
		return $this->password; 
	}
}