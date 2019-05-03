<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['order_date', 'total', 'vat', 'user_id'];

    public function user() :  BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function books() :  BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

    public function states() : HasMany
    {
        return $this->hasMany(State::class);
    }
}
