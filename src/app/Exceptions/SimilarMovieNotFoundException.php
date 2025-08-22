<?php

namespace App\Exceptions;

use Exception;

class SimilarMovieNotFoundException extends Exception
{
    protected $message = 'Similar movies not found';
}
