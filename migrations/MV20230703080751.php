<?php
namespace Migrations;

use Ostyna\ORM\Migrations\AbstractMigrations;
use Ostyna\ORM\Utils\DatabaseUtils;

final class MV20230703080751 extends AbstractMigrations
{
  public function upgrade(): void {
    		DatabaseUtils::sql(
			'CREATE TABLE User (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, email VARCHAR(255) NOT NULL , username VARCHAR(100) NOT NULL , password VARCHAR(255) NOT NULL );
			CREATE TABLE Subscriber (id INT(11) PRIMARY KEY NOT NULL, subscribeat DATETIME NOT NULL,FOREIGN KEY (id) REFERENCES User(id) ON DELETE CASCADE);
			CREATE TABLE Admin (id INT(11) PRIMARY KEY NOT NULL, FOREIGN KEY (id) REFERENCES User(id) ON DELETE CASCADE, roles TEXT NOT NULL );
			CREATE TABLE State (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(100) NOT NULL );
      CREATE TABLE Tickets (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, title VARCHAR(255) NOT NULL , date DATETIME NOT NULL , content TEXT NOT NULL , seriousness INT(11) NOT NULL DEFAULT 0 , author_id INT(11) NOT NULL , FOREIGN KEY (author_id) REFERENCES Subscriber(id) ON DELETE CASCADE, resolver_id INT(11) NOT NULL , FOREIGN KEY (resolver_id) REFERENCES Admin(id) ON DELETE CASCADE, state_id INT(11) NOT NULL , FOREIGN KEY (state_id) REFERENCES State(id) ON DELETE CASCADE);
			CREATE TABLE Version (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, link TEXT NOT NULL , name VARCHAR(100) NOT NULL , issupported BOOL NOT NULL );
			CREATE TABLE Changelog (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, date DATETIME NOT NULL , content TEXT NOT NULL , version_id INT(11) NOT NULL , FOREIGN KEY (version_id) REFERENCES Version(id) ON DELETE CASCADE, author_id INT(11) NOT NULL , FOREIGN KEY (author_id) REFERENCES Admin(id) ON DELETE CASCADE);
			CREATE TABLE Remark (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, content TEXT NOT NULL , date DATETIME NOT NULL , ticket_id INT(11) NOT NULL , FOREIGN KEY (ticket_id) REFERENCES Tickets(id) ON DELETE CASCADE, author_id INT(11) NOT NULL , FOREIGN KEY (author_id) REFERENCES Subscriber(id) ON DELETE CASCADE);'
		);
 
  }

  public function downgrade(): void{

  }
      
}
