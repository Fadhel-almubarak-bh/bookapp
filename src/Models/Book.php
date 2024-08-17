<?php

namespace Xs4arabia\Bookapp\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name'];
    
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authors_books');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_books');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'locations_books');
    }
}
