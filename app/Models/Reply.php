<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

use App\Models\Review;
use App\Observers\ReplyObserver;

#[ObservedBy([ReplyObserver::class])]
class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'review_id', 'user_id'];

    protected $hidden = ['review_id', 'user_id', 'updated_at'];

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
