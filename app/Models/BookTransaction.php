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
    protected $primaryKey = 'bk_mjr_id';
    protected $blameablePrefix = 'bk_mjr_';

    const CREATED_AT = 'bk_mjr_created_at';
    const UPDATED_AT = 'bk_mjr_updated_at';
    const DELETED_AT = 'bk_mjr_deleted_at';
}
