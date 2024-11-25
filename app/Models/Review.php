<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

use App\Models\Reply;
use App\Models\User;
use App\Observers\ReviewObserver;

#[ObservedBy([ReviewObserver::class])]
class Review extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'user_id'];

    protected $hidden = ['updated_at', 'user_id'];

    public function reply(): HasOne
    {
        return $this->HasOne(Reply::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
