<?php
namespace App\Entity;

use Ostyna\ORM\Base\BaseEntity;
use Ostyna\ORM\Utils\DatabaseUtils;
use DateTimeImmutable;

class Changelog extends BaseEntity{

	private int $id;
	private DateTimeImmutable $date;
	private string $content;
	private int $version;
	private int $author;

  public function __construct(?int $identifier){
    if(!is_null($identifier) && is_int($identifier)) {
      $entity = DatabaseUtils::get_entity($identifier, 'changelog');
    	$this->id = $entity['id'];
			$this->date = new DateTimeImmutable($entity['date']);
			$this->content = $entity['content'];
			$this->version = $entity['version_id'];
			$this->author = $entity['author_id'];
    }
  }

	public function  setId(int $id) { 
		$this->id = $id; 
	}

	public function  getId(): int { 
		return $this->id; 
	}
	public function  setDate(DateTimeImmutable $date) { 
		$this->date = $date; 
	}

	public function  getDate(): DateTimeImmutable { 
		return $this->date; 
	}
	public function  setContent(string $content) { 
		$this->content = $content; 
	}

	public function  getContent(): string { 
		return $this->content; 
	}
	public function  setVersion(int $version) { 
		$this->version = $version; 
	}

	public function  getVersion(): int { 
		return $this->version; 
	}
	public function  setAuthor(int $author) { 
		$this->author = $author; 
	}

	public function  getAuthor(): int { 
		return $this->author; 
	}
  
}