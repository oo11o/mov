<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Article
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $h1
 * @property string $intro
 * @property string $content
 * @property string $slug
 * @property string $status
 * @property int|null $section_id
 * @property Section $section
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Article extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
