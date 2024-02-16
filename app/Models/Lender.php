<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    use HasFactory;
    protected $fillable = ['ownerName', 'carModel', 'reg_id', 'vehicleCount'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    public function reg()
    {
        return $this->belongsTo(Reg::class, 'reg_id');
    }
}
