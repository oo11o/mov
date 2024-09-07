<?php

namespace App\Exceptions\Article;

class SimilarArticleNotFoundException extends ArticleNotFoundException
{
    protected $message = 'Similar article not found';
}
