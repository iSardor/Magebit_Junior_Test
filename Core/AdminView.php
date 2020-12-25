<?php
require_once(__DIR__ . '/View.php');

class AdminView extends View {
  public function getSortingDirection($fieldName) {
    $currentSortField = $this->getData('sortField');
    
    if ($currentSortField !== $fieldName) {
      return 'asc';
    }
    
    $currentSortDirection = $this->getData('sortDirection');
    return $currentSortDirection === 'asc' ? 'desc' : 'asc';
  }
}