<?php

namespace App\Exceptions\Enum;

use Exception;

class EnumException extends Exception
{
    protected $message = 'Invalid Enum';

    public function __construct($message = null)
    {
        parent::__construct($message ?: $this->message);
    }
}
