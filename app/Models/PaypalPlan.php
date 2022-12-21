<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'description',
        'Currency',
        'interval_count',
        'billing_cycles_period',
        'interval_count',
        'plan_price',
        'plan_id',
        'plan_response',
    ];
}
