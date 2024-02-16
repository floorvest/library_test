<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCentralInformation extends Model
{
    use HasFactory;

    protected $table = 'book_central_informations';

    protected $fillable = [
        'book_id',
        'borrow_date',
        'expected_return_date',
        'borrower_name',
        'borrower_id',
        'borrower_phone',
        'borrower_email',
        'return_date',
        'additional_info'
    ];
}
