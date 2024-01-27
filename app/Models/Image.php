<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory, HasUuids;

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROGRESS = 'progressing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';


    public $fillable = [
        'created_at',
        'keyword',
        'path',
        'progress',
        'prompt',
        'status',
        'updated_at',
        'user_id'
    ];

    public function getPathAttribute($value): string
    {
        return config('app.url').$value;
    }

    /**
     * Image belongs to User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
