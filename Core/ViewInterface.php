<?php

/**
 * Used to declare the interface for any view objects
 * The view object must return rendered html content
 */
interface ViewInterface {
  public function __construct($templateName);

  public function getHtml();
}
