<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $table = 'book_categories';

    protected $fillable = [
        'name',
        'description'
    ];

    public function bookCategory() {
        $this->hasMany(App\Models\BookToCategory::class);
    }
}