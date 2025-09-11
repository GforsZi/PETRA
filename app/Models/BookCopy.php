<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookCopy extends Model
{
    /** @use HasFactory<\Database\Factories\BookCopyFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'bk_cp_id';
    protected $blameablePrefix = 'bk_cp_';

    const CREATED_AT = 'bk_cp_created_at';
    const UPDATED_AT = 'bk_cp_updated_at';
    const DELETED_AT = 'bk_cp_deleted_at';

    public function Book(): BelongsTo {
        return $this->belongsTo(Book::class, 'bk_cp_book_id', 'bk_id');
    }
}
