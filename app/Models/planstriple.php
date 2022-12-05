<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planstriple extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'name',
        'billing_payment',
        'interval_count',
        'price',
        'currency',
    ];
}
