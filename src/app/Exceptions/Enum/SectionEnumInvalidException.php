<?php

namespace App\Exceptions\Enum;

use Exception;

class SectionEnumInvalidException extends EnumException
{
    protected $message = 'Invalid value for SectionEnum';
}
