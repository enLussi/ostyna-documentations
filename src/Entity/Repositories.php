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

    return isset($results[0]) ? $results[0] : false;
  }

  public static function getAllAdmin () {
    $stmt = DatabaseUtils::prepare_request(
      "SELECT * FROM admin INNER JOIN user ON admin.id = user.id");
    $results = DatabaseUtils::execute_request($stmt);

    return !empty($results) ? $results : false;
  }

  //Users
  public static function getUserFromUsername (string $username) {
    $stmt = DatabaseUtils::prepare_request(
      "SELECT * FROM user WHERE username = :username", 
      [
      'username' => $username
      ]);
    $results = DatabaseUtils::execute_request($stmt);

    return isset($results[0]) ? $results[0] : false;
  }
  public static function getUserFromEmail (string $email) {
    $stmt = DatabaseUtils::prepare_request(
      "SELECT * FROM user WHERE email = :email", 
      [
      'email' => $email
      ]);
    $results = DatabaseUtils::execute_request($stmt);

    return isset($results[0]) ? $results[0] : false;
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

  public static function getTicketsFromUser(int $id) {
    $ticket = DatabaseUtils::sql("SELECT tickets.id,title,date,content,seriousness,state_id FROM tickets INNER JOIN user ON tickets.author_id = user.id WHERE user.id =:id", [
      "id" => $id
    ], respond: true);

    return $ticket;
  }

  public static function verifyTicket(int $id) {
    $exist = count(DatabaseUtils::sql("SELECT * FROM tickets WHERE id = :id", [
      "id" => $id
    ], respond: true)) > 0; 
    return $exist;
  }

  //States
  public static function getAllStates() {
    $state = DatabaseUtils::get_entities('state');
    return $state;
  }

  public static function getStatesByTickets(int $id) {
    $state = DatabaseUtils::sql("SELECT name FROM state INNER JOIN tickets ON tickets.state_id = state.id WHERE tickets.id =:id", [
      "id" => $id
    ], respond: true)[0];
    return $state;
  }

  //Changelogs
  public static function getAllChangelogs() {
    $changelogs = DatabaseUtils::sql("SELECT * FROM changelog", respond: true);

    return $changelogs;
  }

  public static function verifyChangelogs(int $id) {
    $exist = count(DatabaseUtils::sql("SELECT * FROM changelog WHERE id = :id", [
      "id" => $id
    ], respond: true)) > 0; 
    return $exist;
  }

  public static function getChangelog(int $id) {
    $changelog = DatabaseUtils::sql("SELECT * FROM changelog WHERE id =:id", [
      "id" => $id
    ], respond: true)[0]['id'];

    return new Changelog($changelog);
  }

  public static function getChangelogsByVersion(int $version_id) {
    $changelogs = DatabaseUtils::sql("SELECT * FROM changelog INNER JOIN version version ON changelog.version_id = version.id WHERE version_id = :id", [
      "id" => $version_id
    ], respond: true);

    return $changelogs;
  }

  //Versions
  public static function getAllVersions() {
    $versions = DatabaseUtils::sql("SELECT * FROM version", respond: true);

    return $versions;
  }

  public static function verifyVersions(int $id) {
    $exist = count(DatabaseUtils::sql("SELECT * FROM version WHERE id = :id", [
      "id" => $id
    ], respond: true)) > 0; 
    return $exist;
  }

  public static function getVersion(int $id) {
    $version = DatabaseUtils::sql("SELECT * FROM version WHERE id =:id", [
      "id" => $id
    ], respond: true)[0]['id'];

    return new Version($version);
  }

}