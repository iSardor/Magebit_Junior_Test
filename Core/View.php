<?php
require_once(__DIR__ . '/ViewInterface.php');

class View implements ViewInterface {
  public $templateName;
  public $styleFiles = [];
  public $scriptFiles = [];
  
  protected $data;

  public function __construct($templateName, $data = []) {
    $this->templateName = $templateName;
    $this->data = $data;
  }

  public function getHtml() {
    include($this->getViewFile('/Layouts/standard.phtml'));
  }
  
  public function getViewFile($relativePath) {
    return('./Views' . $relativePath);
  }
  
  public function getData($dataName) {
    return $this->data[$dataName];
  }
}