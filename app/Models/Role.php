<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'rl_id';
    protected $blameablePrefix = 'rl_';

    const CREATED_AT = 'rl_created_at';
    const UPDATED_AT = 'rl_updated_at';
    const DELETED_AT = 'rl_deleted_at';

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'usr_role_id', 'rl_id');
    }

}
