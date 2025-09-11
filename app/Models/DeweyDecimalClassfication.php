<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeweyDecimalClassfication extends Model
{
    /** @use HasFactory<\Database\Factories\DeweyDecimalClassficationFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'ddc_id';
    protected $blameablePrefix = 'ddc_';

    const CREATED_AT = 'ddc_created_at';
    const UPDATED_AT = 'ddc_updated_at';
    const DELETED_AT = 'ddc_deleted_at';

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(
            Book::class,
            'book_dewey_decimal_classfication',
            'bk_ddc_classfication_id',
            'bk_ddc_book_id'
        );
    }
}
