<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookDeweyDecimalClassfication extends Pivot
{
    protected $guarded = ['id'];
    protected $primaryKey = 'bk_ddc_id';
    protected $blameablePrefix = 'bk_ddc_';

    const CREATED_AT = 'bk_ddc_created_at';
    const UPDATED_AT = 'bk_ddc_updated_at';
    const DELETED_AT = 'bk_ddc_deleted_at';
}
