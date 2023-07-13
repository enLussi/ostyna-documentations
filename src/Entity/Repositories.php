<?php

namespace App\Entity;

use Ostyna\ORM\Utils\DatabaseUtils;

class Repositories {


  // Admin Users
  public static function getAdminFromUsername (string $username) {
    $stmt = DatabaseUtils::prepare_request(
      "SELECT * FROM admin INNER JOIN user ON admin.id = user.id WHERE username = :username", 
      [
      'username' => $username
      ]);
    $results = DatabaseUtils::execute_request($stmt);

    return $results[0];
  }

  // Tickets
  public static function getAllTickets() {
    $tickets = DatabaseUtils::sql("SELECT * FROM tickets", respond: true);

    return $tickets;
  }

  public static function getTicket(int $id) {
    $ticket = DatabaseUtils::sql("SELECT * FROM tickets WHERE id =:id", [
      "id" => $id
    ], respond: true)[0]['id'];

    return new Tickets($ticket);
  }

  public static function verifyTicket(int $id) {
    $exist = count(DatabaseUtils::sql("SELECT * FROM tickets", respond: true)) > 0; 
    return $exist;
  }

  //States
  public static function getAllStates() {
    $state = DatabaseUtils::get_entities('state');
    return $state;
  }

  //

}