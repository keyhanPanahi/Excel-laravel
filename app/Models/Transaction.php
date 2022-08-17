<?php

namespace App\Models;

use App\Models\Membership\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    const STATUS_SUCCESS = 2;
    const STATUS_PENDING = 1;
    const STATUS_FAILED = 0;

    use HasFactory;

    protected $guarded = ['id'];


    public function book(){

        return $this->belongsTo(Book::class,'book_id');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function getInvoiceDetailsAttribute()
    {
        return unserialize($this->attributes['invoice_details']);
    }

    public function setInvoiceDetailsAttribute($value)
    {
        $this->attributes['invoice_details'] = serialize($value);
    }

    public function getTransactionResultAttribute()
    {
        return unserialize($this->attributes['transaction_result']);
    }

    public function setTransactionResultAttribute($value)
    {
        $this->attributes['transaction_result'] = serialize($value);
    }
}
