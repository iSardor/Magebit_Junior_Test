<?php
require_once(__DIR__ . '/AbstractRepository.php');
require_once('./Models/Subscriber.php');

class SubscriberRepository extends AbstractRepository {
  /**
   * Gets a record from DB 
   */
  public function getByEmail($email) {
    $sql = 'Select * from email_record where email=?';
    $stmt = $this->execute($sql, 's', [$email]);
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $result ? convertSubscriber($result) : null;
  }
  
  /**
   * Inserts a subscriber into database
   */
  public function saveSubscriber($subscriber) {
    $sql = 'INSERT INTO email_record (`email`) VALUES (?)';
    $stmt = $this->execute($sql, 's', [$subscriber->getEmail()]);
    $result = $stmt->affected_rows;
    
    if ($result != 1) {
      throw new Exception('Affected rows are: ' . $result . ' should be 1');
    }
    
    $stmt->close();
    return $result;
  }
  
  public function getAllSubscribers($sortField = '', $sortDirection = '', $filterDomain = '') {
    $sql = 'SELECT * FROM email_record';
    
    if(!empty($filterDomain)) {
      $sql .= ' WHERE email like \'%' . $filterDomain . '\'' ;
    }
    
    if (!empty($sortField)) {
      $sql .= ' ORDER BY ' . $sortField . ' ';
      $sql .= !empty($sortDirection) ? $sortDirection : 'desc';
    }

    $stmt = $this->execute($sql);
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    
    $subscribers = [];
    foreach ($results as $result) {
      $subscriber = $this->convertSubscriber($result);
      array_push($subscribers, $subscriber);
    }
    
    return $subscribers;
  }
  
  /**
   * @param $id numeric string
   */
  public function deleteSubscriber($id) {
    $sql = 'DELETE FROM email_record WHERE id =?';
    $stmt = $this->execute($sql, 's', [ $id ]);
    $result = $stmt->affected_rows;
    
    if ($result > 1) {
      throw new Exception('Affected rows are: ' . $result . ' should be 1');
    }
    
    
    $stmt->close();
    return $result;
  }
  
  public function getAllEmailDomains() {
    $sql = 'SELECT DISTINCT SUBSTR(email, POSITION(\'@\' in email) + 1) as \'\' FROM email_record';
    $stmt = $this->execute($sql);
    $results = $stmt->get_result()->fetch_all();
    $shiftedResults = [];
    
    /* stmt returns values in weird format, have to shift the value */
    foreach($results as $result) {
      array_push($shiftedResults, $result[0]);
    }
    
    return $shiftedResults;
  }
  
  private function convertSubscriber($result){
    $subscriber = new Subscriber();
    $subscriber
      ->setId($result['id'])
      ->setEmail($result['email'])
      ->setDate($result['date']);

    return $subscriber;
  }
}