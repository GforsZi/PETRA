<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    /** @use HasFactory<\Database\Factories\PublisherFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'pub_id';
    protected $blameablePrefix = 'pub_';

    const CREATED_AT = 'pub_created_at';
    const UPDATED_AT = 'pub_updated_at';
    const DELETED_AT = 'pub_deleted_at';

    public function books(): HasMany {
        return $this->hasMany(Book::class, 'bk_publisher_id', 'bk_id');
    }
}
