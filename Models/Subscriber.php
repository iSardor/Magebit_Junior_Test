<?php

class Subscriber {
  /**
   * @param $id Int
   */
  private $id;
  
  /**
   * @param $email String
   */
  private $email;
  
  /**
   * @param $date string
   */
  private $date;
  
  public function getEmail() {
    return $this->email;
  }
  
  public function getId() {
    return $this->id;
  }
  
  public function getDate() {
    return $this->date;
  }
  
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }
  
  public function setId($id) {
    $this->id = $id;
    return $this;
  }
  
  public function setDate($date) {
    $this->date =$date;
    return $this;
  }
}