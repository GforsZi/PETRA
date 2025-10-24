<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookAuthor extends Pivot {
    protected $guarded = ['id'];
    protected $primaryKey = 'bk_athr_id';
    protected $blameablePrefix = 'bk_athr_';

    const CREATED_AT = 'bk_athr_created_at';
    const UPDATED_AT = 'bk_athr_updated_at';
    const DELETED_AT = 'bk_athr_deleted_at';
}
