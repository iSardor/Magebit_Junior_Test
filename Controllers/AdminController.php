<?php
require_once('./Core/ControllerInterface.php');
require_once('./Core/AdminView.php');
require_once('./Models/Repositories/SubscriberRepository.php');

class AdminController implements ControllerInterface {
  private $subscriberRepository;
  private $sortableFields = ['email', 'date'];
  private $sortableDirections = ['asc', 'desc'];

  public function __construct(){
    $this->subscriberRepository = new SubscriberRepository();
  }
  
  public function getView() {
    $sortField = array_key_exists('sortby', $_GET) ? $_GET['sortby'] : '';
    $sortDirection = array_key_exists('dir', $_GET) ? $_GET['dir'] : '';
    $filterDomain = array_key_exists('filter', $_GET) ? $_GET['filter'] : '';
    
    if (!in_array($sortField, $this->sortableFields)) {
      $sortField = 'date';
    }
    
    if (!in_array($sortDirection, $this->sortableDirections)) {
      $sortDirection = 'desc';
    }
    
    /** @var $subcscribers Array<Subscriber> */
    $subscribers = $this->subscriberRepository->getAllSubscribers($sortField, $sortDirection, $filterDomain);
    $allEmailDomains = $this->subscriberRepository->getAllEmailDomains();
    
    $view = new AdminView('admin.phtml', [ 
      'subscribers' => $subscribers,
      'sortField' => $sortField,
      'sortDirection' => $sortDirection,
      'emailDomains' => $allEmailDomains
    ]);
    
    $view->styleFiles = [ 'admin-styles.css' ];
    $view->scriptFiles = [ 'admin.js' ];
    
    return $view;
  }
}
