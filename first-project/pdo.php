<?php
function getPDO() {
  $host = '127.0.0.1';
  $db   = 'test';
  $user = 'chad-db';
  $pass = 'realchad';
  $charset = 'utf8mb4';
  
  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  return new PDO($dsn, $user, $pass, $options);
}

?>