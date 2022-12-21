<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'package_id',
        'package_amount',
        'payment_id',
        'package_response',
    ];
}
