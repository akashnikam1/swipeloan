<?php

namespace App\Exceptions;

use Exception;

class SignatureVerificationException extends Exception 
{
    public function __construct($message) 
    {
        parent::__construct($message);
    }
}