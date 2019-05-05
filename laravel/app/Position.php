<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    protected $fillable = ['book_id', 'order_id', 'quantity', 'price'];

    public function order() :  BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function book() : BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
