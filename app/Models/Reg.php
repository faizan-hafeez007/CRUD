<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reg extends Model
{
    use HasFactory;

    protected $fillable = ['regName'];

    public function lenders()
    {
        return $this->hasMany(Lender::class, 'regName', 'regName');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'regName', 'regName');
    }
}
