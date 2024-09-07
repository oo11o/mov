<?php

namespace App\Exceptions\Article;

use Exception;

class SimilarArticleNotFoundException extends ArticleNotFoundException
{
    protected $message = 'Similar article not found';
}
