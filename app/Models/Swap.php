<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Swap extends Model
{
    protected $fillable = ['book_requested_id', 'book_offered_id', 'requester_id', 'status'];

    public function requestedBook(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_requested_id');
    }

    public function offeredBook(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_offered_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
}
