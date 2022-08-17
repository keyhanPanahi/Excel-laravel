<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedBook extends Model
{
    use HasFactory;

    protected $table = 'purchase_books';

    protected $fillable = [
        'book_id',
        'user_id',
    ];


}
