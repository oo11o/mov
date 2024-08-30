<?php

namespace App\Exceptions\Enum;

use Exception;

class ArticleStatusEnumInvalidException extends EnumException
{
    protected $message = 'Invalid value for ArticleStatusEnum';
}
