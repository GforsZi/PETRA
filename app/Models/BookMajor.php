<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookMajor extends Model
{
    /** @use HasFactory<\Database\Factories\BookMajorFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'bk_mjr_id';
    protected $blameablePrefix = 'bk_mjr_';

    const CREATED_AT = 'bk_mjr_created_at';
    const UPDATED_AT = 'bk_mjr_updated_at';
    const DELETED_AT = 'bk_mjr_deleted_at';

    public function books(): HasMany {
        return $this->hasMany(Book::class, 'bk_major_id', 'bk_mjr_id');
    }
}
