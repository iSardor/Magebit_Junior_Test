<?php
require_once('./Core/ControllerInterface.php');
require_once('./Core/View.php');
require_once('./Models/Repositories/SubscriberRepository.php');

class SubscribeController implements ControllerInterface {
  private $email;
  private $subscriberRepository;

  public function __construct() {  
    $this->email = $_POST['email'];
    $this->subscriberRepository = new SubscriberRepository();
  }

  private function validateEmail() {
    return filter_var($this->email, FILTER_VALIDATE_EMAIL);
  }

  public function getView() {
    // Validate email
    $isEmailCorrect = $this->validateEmail();
    if (!$isEmailCorrect) {
        return new View('subscribe/error.phtml', [ 'reason' => 'Email is not valid!' ]);
    }

    $subscriber = $this->subscriberRepository->getByEMail($this->email);
    if ($subscriber) {
        return new View('subscribe/error.phtml', [ 'reason' => 'You have already subscribed!' ]);
    }

    $subscriberToSave = new Subscriber();
    $subscriberToSave->setEmail($this->email); //Other params are auto generated

    try {
        $affecedRows = $this->subscriberRepository->saveSubscriber($subscriberToSave);
    } catch (\Exception $e) {
        // Throw correct exception
        return new View('subscribe/error.phtml', [ 'reason' => 'Something went wrong on subscribption!' ]);
    }
    $view = new View('subscribe/success.phtml');
    $view->styleFiles = ['subscriber.css'];

    return $view;
  }
}
