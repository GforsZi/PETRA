<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatNotification extends Model
{
    /** @use HasFactory<\Database\Factories\ChatNotificationFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'cht_notif_id';
    protected $blameablePrefix = 'cht_notif_';

    const CREATED_AT = 'cht_notif_created_at';
    const UPDATED_AT = 'cht_notif_updated_at';
    const DELETED_AT = 'cht_notif_deleted_at';

    public function ChatOption(): BelongsTo {
        return $this->belongsTo(ChatOption::class, 'cht_notif_option_id', 'cht_opt_id');
    }
}
