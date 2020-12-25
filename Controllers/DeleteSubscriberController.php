<?php
require_once('./Core/ControllerInterface.php');
require_once('./Models/Repositories/SubscriberRepository.php');

class DeleteSubscriberController implements ControllerInterface {
  protected $subscriberRepository;
  private $resultMessage;
  
  public function __construct() {
    $this->subscriberRepository = new SubscriberRepository();
  }

  public function getView() {
    if(!array_key_exists('id', $_GET) || $_GET['id'] === '' || !is_numeric($_GET['id'])) {
      $this->resultMessage = 'The Id Parameter is not given.';
      $this->redirectToAdmin();
    }
    
    try {
      $id = $_GET['id'];
      $rows = $this->subscriberRepository->deleteSubscriber($id);

      if ($rows === 1) {
        $this->resultMessage = 'The Subscriber has been successfully delted!';
      }

      if ($rows === 0) {
        $this->resultMessage = 'The Requested Subscriber is not found!';
      }
    } catch (\Exception $e) {
      $this->resultMessage = 'Something Went Terribly Horribly Wrong!';
    }
    
    $this->redirectToAdmin();
  }
  
  private function redirectToAdmin() {
    header("Location: /admin?message=" . $this->resultMessage);
    exit();
  }
}