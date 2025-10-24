<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'bk_id';
    protected $blameablePrefix = 'bk_';

    const CREATED_AT = 'bk_created_at';
    const UPDATED_AT = 'bk_updated_at';
    const DELETED_AT = 'bk_deleted_at';

    public function major(): BelongsTo
    {
        return $this->belongsTo(BookMajor::class, 'bk_major_id', 'bk_mjr_id');
    }

    public function origin(): BelongsTo
    {
        return $this->belongsTo(BookOrigin::class, 'bk_origin_id', 'bk_orgn_id');
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'bk_publisher_id', 'pub_id');
    }

    public function bookCopies(): HasMany
    {
        return $this->hasMany(BookCopy::class, 'bk_cp_book_id', 'bk_id');
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_author', 'bk_athr_book_id', 'bk_athr_author_id');
    }

    public function deweyDecimalClassfications(): BelongsToMany
    {
        return $this->belongsToMany(DeweyDecimalClassfication::class, 'book_dewey_decimal_classfication', 'bk_ddc_book_id', 'bk_ddc_classfication_id');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'book_transaction', 'bk_trx_book_id', 'bk_trx_transaction_id');
    }

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bk_created_by', 'usr_id');
    }
    public function updated_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bk_updated_by', 'usr_id');
    }
    public function deleted_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bk_deleted_by', 'usr_id');
    }
}
