<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMovie
 */
class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'year', 'description'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_movie');
    }
}
