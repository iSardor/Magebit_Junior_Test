<?php

abstract class AbstractRepository {
  protected $connection;
  
  public function __construct() {
    $this->connection = new mysqli('localhost', 'root', '', 'pineapple') or die("Connect failed: %s\n". $connection -> error);
  }
  
  protected function execute($sql, $types = '', $params = []) {
    $stmt = $this->connection->prepare($sql);
    
    if(count($params) > 0){
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();

    return $stmt;
  }
}