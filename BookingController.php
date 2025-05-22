<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Step 1: Validate request
        $request->validate([
            'start_date' => ['required', 'date', 'after:today', 'after_or_equal:' . now()->addDays(2)->toDateString()],
            'end_date'   => ['required', 'date', 'after:start_date'],
            'car_ids'    => ['required', 'array', 'max:2'],
        ]);

        $start = $request->start_date;
        $end = $request->end_date;

        // Step 2: Enhanced overlap checking
        $conflictingCars = [];
        
        foreach ($request->car_ids as $carId) {
            $car = Car::findOrFail($carId);

            // Check if car is available
            if (!$car->available) {
                return back()->withErrors(['car_ids' => 'One or more selected cars are not available.'])->withInput();
            }

            // More comprehensive overlap check
            $hasConflict = $car->bookings()
                ->where(function ($query) use ($start, $end) {
                    // A booking conflicts if:
                    // 1. New booking starts during existing booking
                    // 2. New booking ends during existing booking  
                    // 3. New booking completely encompasses existing booking
                    // 4. Existing booking completely encompasses new booking
                    $query->where(function($q) use ($start, $end) {
                        // Case 1: New start date falls within existing booking
                        $q->where('start_date', '<=', $start)
                          ->where('end_date', '>=', $start);
                    })
                    ->orWhere(function($q) use ($start, $end) {
                        // Case 2: New end date falls within existing booking
                        $q->where('start_date', '<=', $end)
                          ->where('end_date', '>=', $end);
                    })
                    ->orWhere(function($q) use ($start, $end) {
                        // Case 3: New booking encompasses existing booking
                        $q->where('start_date', '>=', $start)
                          ->where('end_date', '<=', $end);
                    })
                    ->orWhere(function($q) use ($start, $end) {
                        // Case 4: Existing booking encompasses new booking
                        $q->where('start_date', '<=', $start)
                          ->where('end_date', '>=', $end);
                    });
                })
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            if ($hasConflict) {
                $conflictingCars[] = $car->brand . ' ' . $car->model;
            }
        }

        // If there are conflicts, return with specific error message
        if (!empty($conflictingCars)) {
            $carList = implode(', ', $conflictingCars);
            return back()->withErrors([
                'car_ids' => "The following cars are already booked during this period: {$carList}. Please select different dates or cars."
            ])->withInput();
        }

        // Step 3: Check user's existing bookings for the same period (max 2 cars rule)
        $userExistingBookings = auth()->user()->bookings()
            ->where(function ($query) use ($start, $end) {
                $query->where(function($q) use ($start, $end) {
                    $q->where('start_date', '<=', $end)
                      ->where('end_date', '>=', $start);
                });
            })
            ->whereIn('status', ['pending', 'approved'])
            ->with('cars')
            ->get();

        $totalCarsForPeriod = count($request->car_ids);
        foreach ($userExistingBookings as $existingBooking) {
            $totalCarsForPeriod += $existingBooking->cars->count();
        }

        if ($totalCarsForPeriod > 2) {
            return back()->withErrors([
                'car_ids' => 'You can only book a maximum of 2 cars for overlapping rental periods.'
            ])->withInput();
        }

        // Step 4: Create booking
        $booking = Booking::create([
            'user_id'    => auth()->id(),
            'start_date' => $start,
            'end_date'   => $end,
            'status'     => 'pending',
        ]);

        // Step 5: Attach cars to the booking
        $booking->cars()->attach($request->car_ids);
        
        // Step 6: Calculate and update total amount
        $booking->total_amount = $booking->calculateTotalAmount();
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking submitted successfully! Your booking is pending approval by our staff.');
    }

    public function index()
    {
        // Get logged-in user's bookings with cars eager loaded
        $bookings = auth()->user()->bookings()->with('cars')->orderBy('created_at', 'desc')->get();

        return view('bookings.index', compact('bookings'));
    }
}