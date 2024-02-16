<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'book_id',
        'title',
        'author',
        'isbn',
        'genre',
        'publication_year',
        'publisher',
        'edition',
        'language',
        'format', 
        'number_of_pages'
    ];

    public function bookCategory() {
        return $this->hasMany('App\Models\BookToCategory', 'book_id', 'id');
    }
}
