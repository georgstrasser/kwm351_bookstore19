<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    // define all properties that should be writable
    protected $fillable = ['isbn', 'title', 'subtitle', 'published', 'rating',
        'description', 'user_id'];

    public function scopeFavourite($query){
        return $query->where('rating','>=',8);
    }

    /**
     * book has many images
     */
    public function images() : HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * book is assigned to user (n:1)
     */
    public function user() :  BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * book  belongs to many authors (m:n)
     */
    public function authors() :  BelongsToMany
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }
}
