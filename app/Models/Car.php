<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['reg_id', 'reg', 'value', 'lender'];

    public function reg()
    {
        return $this->belongsTo(Reg::class, 'reg_id');
    }
}
