<?php
namespace App\Entity;

use Ostyna\ORM\Base\BaseEntity;
use Ostyna\ORM\Utils\DatabaseUtils;
use DateTimeImmutable;

class Subscriber extends User{

	private int $id;
	private DateTimeImmutable $subscribeat;

  public function __construct(?int $identifier){
    if(!is_null($identifier) && is_int($identifier)) {
      $entity = DatabaseUtils::get_entity($identifier, 'Subscriber');
    	$this->id = $entity['id'];
			$this->subscribeat = new DateTimeImmutable($entity['subscribeat']);

      parent::__construct($identifier);
    }
  }

	public function  setSubscribeat(DateTimeImmutable $subscribeat) { 
		$this->subscribeat = $subscribeat; 
	}

	public function  getSubscribeat(): DateTimeImmutable { 
		return $this->subscribeat; 
	}
  
}