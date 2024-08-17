<?php

namespace Xs4arabia\Bookapp\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name'];
    
    public function books()
    {
        return $this->belongsToMany(Book::class, 'locations_books');
    }
}
