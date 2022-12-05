<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paypalpayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function PackageDetails()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
}
