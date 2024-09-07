<?php

namespace App\Exceptions\Article;

use Exception;

class ArticleNotFoundException extends Exception
{
    protected $message = 'Article not found';

    public function __construct($message = null)
    {
        parent::__construct($message ?: $this->message);
    }
}
