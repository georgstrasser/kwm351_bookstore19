<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    protected $fillable = [
        'firstName', 'lastName'
    ];

    /**
     * author  belongs to many books (m:n)
     * relationship table will be created automatically
     */
    public function books() : BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}

