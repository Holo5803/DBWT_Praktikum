<?php

class LoginException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {
    // Make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    public function getCustomMessage()
    {
        return "[Login Error]: " . $this->message;
    }
}
