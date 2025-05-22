<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'location', 'address', 'phone_number'];
    
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}