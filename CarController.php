<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Branch;
use Carbon\Carbon;

class CarController extends Controller
{
    public function index(Request $request)
    {
        // Get all unique brands, types, and transmissions for filter dropdowns
        $brands = Car::select('brand')->distinct()->pluck('brand');
        $types = Car::select('type')->distinct()->pluck('type');
        $transmissions = Car::select('transmission')->distinct()->pluck('transmission');
        
        // Base query with eager loading
        $carsQuery = Car::with('branch');
        
        // Apply filters if provided
        if ($request->filled('branch_id')) {
            $carsQuery->where('branch_id', $request->branch_id);
        }
        
        if ($request->filled('brand')) {
            $carsQuery->where('brand', $request->brand);
        }
        
        if ($request->filled('type')) {
            $carsQuery->where('type', $request->type);
        }
        
        if ($request->filled('transmission')) {
            $carsQuery->where('transmission', $request->transmission);
        }
        
        // Check availability for date range if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            
            // Get cars that aren't booked in this date range
            // Fixed the overlap logic - a booking overlaps if:
            // 1. It starts before or on our end date AND
            // 2. It ends after or on our start date
            $carsQuery->whereDoesntHave('bookings', function($query) use ($startDate, $endDate) {
                $query->where(function($q) use ($startDate, $endDate) {
                    // Check for any overlap with pending or approved bookings
                    $q->where('start_date', '<=', $endDate)
                      ->where('end_date', '>=', $startDate);
                })
                ->whereIn('status', ['pending', 'approved']);
            });
        }
        
        // Only show available cars
        $carsQuery->where('available', true);
        
        // Get the filtered cars
        $cars = $carsQuery->paginate(12);
        
        // Get all branches for the branch filter
        $branches = Branch::all();
        
        // Set minimum start date (2 days from now as per requirements)
        $minStartDate = Carbon::now()->addDays(2)->format('Y-m-d');
        
        return view('cars.index', compact(
            'cars', 
            'branches', 
            'brands', 
            'types', 
            'transmissions', 
            'minStartDate'
        ));
    }
}