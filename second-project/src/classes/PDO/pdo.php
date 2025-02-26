<?php
namespace App\Classes;

use PDOException;


class PDO {

  private $user = 'chad-db';
  private $pass = 'realchad';

  private $dsn = "mysql:host=127.0.0.1;dbname=test;charset=utf8mb4";
  private $options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
  ];


  private $pdo;

  public function __construct() {

    $this->pdo = new \PDO($this->dsn, $this->user, $this->pass, $this->options);
  }


  public function execute($query, $data) {

    try {
      $statement = $this->pdo->prepare($query);
      $statement->execute($data);

      return $statement;
    } catch (PDOException $e) {
      echo var_dump($e);
      echo "error";
    }
  }
}


?>