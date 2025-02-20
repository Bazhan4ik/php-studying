<?php
include "pdo.php";


$pdo = getPDO();

class Message {
  public $email;
  public $name;
  public $text;
  public $id;

  public function __construct(string $email, string $name, string $text, int $id = NULL) {
    $this->email = $email;
    $this->name = $name;
    $this->text = $text;
    $this->id = $id;
  }

  public function save() {
    global $pdo;

    $sql = "INSERT INTO messages (email, name, message) VALUES (:email, :name, :message)";
  
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ 'email' => $this->email, 'name' => $this->name, 'message' => $this->text]);

    $this->id = $pdo->lastInsertId();

    return;
  }

  public function delete() {

  }

  
}


function findMessages(string $email) {
  global $pdo;

  $sql = "SELECT * FROM messages WHERE email = :email";
  // $sql = "SELECT * FROM messages";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([ ':email' => $email ]);
  // $stmt->execute();

  $results = $stmt->fetchAll();


  $messages = [];
  foreach($results as $key => $value) {
    array_push($messages, new Message($value->email, $value->name, $value->message, $value->id));
  }

  return $messages;
}

?>