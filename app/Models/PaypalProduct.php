<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type',
        'category',
        'product_id',
        'product_response',
    ];
    public function plandetails()
    {
        return $this->hasOne(PaypalPlan::class,'product_id','product_id');
    }
}
