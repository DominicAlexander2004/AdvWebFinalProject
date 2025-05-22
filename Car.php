<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'brand', 'model', 'type', 'transmission', 'color', 
        'year', 'plate_number', 'daily_rate', 'description', 
        'image', 'available', 'branch_id'
    ];
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
    
    // Enhanced availability check for a date range
    public function isAvailable($startDate, $endDate)
    {
        // First check if car is marked as available
        if (!$this->available) {
            return false;
        }

        // Then check for booking conflicts
        return !$this->bookings()
            ->where(function($query) use ($startDate, $endDate) {
                // Check for any date overlap with pending or approved bookings
                $query->where(function($q) use ($startDate, $endDate) {
                    // Overlap occurs when:
                    // booking_start <= requested_end AND booking_end >= requested_start
                    $q->where('start_date', '<=', $endDate)
                      ->where('end_date', '>=', $startDate);
                });
            })
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
    }
    
    // Helper method to get conflicting bookings for a date range
    public function getConflictingBookings($startDate, $endDate)
    {
        return $this->bookings()
            ->where(function($query) use ($startDate, $endDate) {
                $query->where(function($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $endDate)
                      ->where('end_date', '>=', $startDate);
                });
            })
            ->whereIn('status', ['pending', 'approved'])
            ->with('user')
            ->get();
    }
}