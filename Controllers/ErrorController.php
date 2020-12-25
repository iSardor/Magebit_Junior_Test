<?php

require_once( './Core/ControllerInterface.php' );
require_once( './Core/View.php' );

class ErrorController implements ControllerInterface {
    public function getView() {
        return new View( 'errors/not-found.phtml' );
    }
}