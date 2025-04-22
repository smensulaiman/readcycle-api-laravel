<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Swap extends Model
{
    protected $fillable = ['book_requested_id', 'book_offered_id', 'requester_id', 'status'];

    public function bookRequested(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_requested_id');
    }

    public function bookOffered(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_offered_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function offerer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
}
