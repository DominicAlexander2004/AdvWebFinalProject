<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'start_date', 'end_date', 'status', 
        'notes', 'total_amount'
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    public function cars()
    {
        return $this->belongsToMany(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Calculate total days of booking
    public function getTotalDaysAttribute()
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }
    
    // Calculate total amount based on car daily rates
    public function calculateTotalAmount()
    {
        $totalDays = $this->getTotalDaysAttribute();
        $totalAmount = 0;
        
        foreach ($this->cars as $car) {
            $totalAmount += $car->daily_rate * $totalDays;
        }
        
        return $totalAmount;
    }
}