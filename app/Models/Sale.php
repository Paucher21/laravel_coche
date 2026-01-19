<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'amount', 'sale_date', 'seller_id', 'client_id', 'car_id'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}