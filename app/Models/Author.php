<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'athr_id';
    protected $blameablePrefix = 'athr_';

    const CREATED_AT = 'athr_created_at';
    const UPDATED_AT = 'athr_updated_at';
    const DELETED_AT = 'athr_deleted_at';

        public function books(): BelongsToMany
    {
        return $this->belongsToMany(
            Book::class,
            'book_author',
            'bk_athr_author_id',
            'bk_athr_book_id'
        );
    }
}
