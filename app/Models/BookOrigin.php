<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookOrigin extends Model
{
    /** @use HasFactory<\Database\Factories\BookMajorFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'bk_orgn_id';
    protected $blameablePrefix = 'bk_orgn_';

    const CREATED_AT = 'bk_orgn_created_at';
    const UPDATED_AT = 'bk_orgn_updated_at';
    const DELETED_AT = 'bk_orgn_deleted_at';

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'bk_origin_id', 'bk_orgn_id');
    }

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bk_orgn_created_by', 'usr_id');
    }
    public function updated_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bk_orgn_updated_by', 'usr_id');
    }
    public function deleted_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bk_orgn_deleted_by', 'usr_id');
    }
}
