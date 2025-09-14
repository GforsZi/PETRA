<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    /** @use HasFactory<\Database\Factories\DeviceFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'dvc_id';
    protected $blameablePrefix = 'dvc_';

    const CREATED_AT = 'dvc_created_at';
    const UPDATED_AT = 'dvc_updated_at';
    const DELETED_AT = 'dvc_deleted_at';

    public function notification(): HasMany {
        return $this->hasMany(ChatNotification::class, 'cht_notif_device_id', 'dvc_id');
    }
}
