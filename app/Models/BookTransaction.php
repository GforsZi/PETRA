<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookTransaction extends Pivot
{
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'bk_trx_id';
    protected $blameablePrefix = 'bk_trx_';

    const CREATED_AT = 'bk_trx_created_at';
    const UPDATED_AT = 'bk_trx_updated_at';
    const DELETED_AT = 'bk_trx_deleted_at';
}
