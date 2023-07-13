<?php
namespace App\Entity;

use Ostyna\ORM\Base\BaseEntity;
use Ostyna\ORM\Utils\DatabaseUtils;
use DateTimeImmutable;

class Tickets extends BaseEntity{

	private int $id;
	private string $title;
	private DateTimeImmutable $date;
	private string $content;
	private int $seriousness;
	private int $author;
	private int $resolver;
	private int $state;

  public function __construct(?int $identifier){
    if(!is_null($identifier) && is_int($identifier)) {
      $entity = DatabaseUtils::get_entity($identifier, 'tickets');
    	$this->id = $entity['id'];
			$this->title = $entity['title'];
			$this->date = new DateTimeImmutable($entity['date']);
			$this->content = $entity['content'];
			$this->seriousness = $entity['seriousness'];
			$this->author = $entity['author_id'];
			$this->resolver = $entity['resolver_id'];
			$this->state = $entity['state_id'];
    }
  }

	public function  setId(int $id) { 
		$this->id = $id; 
	}

	public function  getId(): int { 
		return $this->id; 
	}
	public function  setTitle(string $title) { 
		$this->title = $title; 
	}

	public function  getTitle(): string { 
		return $this->title; 
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
	public function  setSeriousness(int $seriousness) { 
		$this->seriousness = $seriousness; 
	}

	public function  getSeriousness(): int { 
		return $this->seriousness; 
	}
	public function  setAuthor(int $author) { 
		$this->author = $author; 
	}

	public function  getAuthor(): int { 
		return $this->author; 
	}
	public function  setResolver(int $resolver) { 
		$this->resolver = $resolver; 
	}

	public function  getResolver(): int { 
		return $this->resolver; 
	}
	public function  setState(int $state) { 
		$this->state = $state; 
	}

	public function  getState(): int { 
		return $this->state; 
	}
  
}