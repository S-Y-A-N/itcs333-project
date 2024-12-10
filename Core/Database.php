<?php

namespace Core;

use PDO;

class Database {
  public $connection;
  public $statement;

  public function __construct($config) {

    $dsn = 'mysql:' . http_build_query($config, '', ';');


    $this->connection = new PDO($dsn, $config['username'], $config['password'], [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  public function query($query, $params = []) {
    $this->statement = $this->connection->prepare($query);

    $this->statement->execute($params);

    return $this->statement;
  }
}