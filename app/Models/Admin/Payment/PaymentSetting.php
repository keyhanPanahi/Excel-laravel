<?php

namespace App\Models\Admin\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
