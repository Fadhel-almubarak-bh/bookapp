<?php

namespace Xs4arabia\Bookapp\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name'];
   
    public function books()
    {
        return $this->belongsToMany(Book::class, 'authors_books');
    }
}
