<?php
namespace App\Entity;

use Ostyna\ORM\Base\BaseEntity;
use Ostyna\ORM\Utils\DatabaseUtils;
use DateTimeImmutable;

class Remark extends BaseEntity{

	private int $id;
	private string $content;
	private DateTimeImmutable $date;
	private int $ticket_id;
	private int $author_id;

  public function __construct(?int $identifier){
    if(!is_null($identifier) && is_int($identifier)) {
      $entity = DatabaseUtils::get_entity($identifier, 'Remark');
    	$this->id = $entity['id'];
			$this->content = $entity['content'];
			$this->date = new DateTimeImmutable($entity['date']);
			$this->ticket_id = $entity['ticket_id'];
			$this->author_id = $entity['author_id'];
    }
  }

	public function  setId(int $id) { 
		$this->id = $id; 
	}

	public function  getId(): int { 
		return $this->id; 
	}
	public function  setContent(string $content) { 
		$this->content = $content; 
	}

	public function  getContent(): string { 
		return $this->content; 
	}
	public function  setDate(DateTimeImmutable $date) { 
		$this->date = $date; 
	}

	public function  getDate(): DateTimeImmutable { 
		return $this->date; 
	}
	public function  setTicket_id(int $ticket_id) { 
		$this->ticket_id = $ticket_id; 
	}

	public function  getTicket_id(): int { 
		return $this->ticket_id; 
	}
	public function  setAuthor_id(int $author_id) { 
		$this->author_id = $author_id; 
	}

	public function  getAuthor_id(): int { 
		return $this->author_id; 
	}
  
}