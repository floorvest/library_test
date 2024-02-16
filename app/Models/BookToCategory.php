<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookToCategory extends Model
{
    use HasFactory;

    protected $table = 'book_to_categories';

    protected $fillable = [
        'book_id',
        'book_category_id'
    ];

    public function book() {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }

    public function category() {
        return $this->hasOne(BookCategory::class, 'id', 'book_category_id');
    }
}
