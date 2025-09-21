<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatOption extends Model
{
    /** @use HasFactory<\Database\Factories\ChatOptionFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'cht_opt_id';
    protected $blameablePrefix = 'cht_opt_';

    const CREATED_AT = 'cht_opt_created_at';
    const UPDATED_AT = 'cht_opt_updated_at';
    const DELETED_AT = 'cht_opt_deleted_at';

    public function ChatNotification(): HasMany {
        return $this->hasMany(ChatNotification::class, 'cht_notif_option_id', 'cht_opt_id');
    }

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cht_opt_created_by', 'usr_id');
    }
    public function updated_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cht_opt_updated_by', 'usr_id');
    }
    public function deleted_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cht_opt_deleted_by', 'usr_id');
    }
}
