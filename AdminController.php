<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        // Empty constructor - we'll do auth checks in each method
    }

    public function dashboard()
    {
        // Check for admin or staff authorization
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get counts for the dashboard
        $totalCars = Car::count();
        $availableCars = Car::where('available', true)->count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $approvedBookings = Booking::where('status', 'approved')->count();
        
        // Get booking statistics
        $bookingsByStatus = Booking::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
        
        // Get recent bookings
        $recentBookings = Booking::with(['user', 'cars'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get branch statistics
        $branchStats = Branch::withCount('cars')->get();
        
        // If user is staff, filter data based on their branch
        if (auth()->user()->isStaff() && auth()->user()->branch_id) {
            $branchId = auth()->user()->branch_id;
            
            // Filter cars by branch
            $totalCars = Car::where('branch_id', $branchId)->count();
            $availableCars = Car::where('branch_id', $branchId)
                ->where('available', true)
                ->count();
            
            // Filter bookings by branch (through cars)
            $bookingIds = DB::table('booking_car')
                ->join('cars', 'booking_car.car_id', '=', 'cars.id')
                ->where('cars.branch_id', $branchId)
                ->pluck('booking_id')
                ->unique();
            
            $totalBookings = count($bookingIds);
            
            $pendingBookings = Booking::whereIn('id', $bookingIds)
                ->where('status', 'pending')
                ->count();
            
            $recentBookings = Booking::with(['user', 'cars'])
                ->whereIn('id', $bookingIds)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }
        
        return view('admin.dashboard', compact(
            'totalCars',
            'availableCars',
            'totalBookings',
            'pendingBookings',
            'approvedBookings',
            'bookingsByStatus',
            'recentBookings',
            'branchStats'
        ));
    }

    public function cars(Request $request)
    {
        // Check for admin or staff authorization
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get the query parameters for filtering
        $branch_id = $request->input('branch_id');
        $brand = $request->input('brand');
        $type = $request->input('type');
        $transmission = $request->input('transmission');
        
        // Start with all cars query with branch relationship
        $carsQuery = Car::with('branch');
        
        // Apply branch filter if staff user is assigned to a specific branch
        if (auth()->user()->isStaff() && auth()->user()->branch_id) {
            $carsQuery->where('branch_id', auth()->user()->branch_id);
        } else {
            // Apply branch filter from request if provided
            if ($branch_id) {
                $carsQuery->where('branch_id', $branch_id);
            }
        }
        
        // Apply other filters
        if ($brand) {
            $carsQuery->where('brand', $brand);
        }
        
        if ($type) {
            $carsQuery->where('type', $type);
        }
        
        if ($transmission) {
            $carsQuery->where('transmission', $transmission);
        }
        
        // Get paginated results
        $cars = $carsQuery->latest()->paginate(10);
        
        // Get unique values for filter dropdowns
        $brands = Car::select('brand')->distinct()->pluck('brand');
        $types = Car::select('type')->distinct()->pluck('type');
        $transmissions = Car::select('transmission')->distinct()->pluck('transmission');
        
        // Get branches for dropdown
        $branches = Branch::all();
        
        return view('admin.cars.index', compact('cars', 'branches', 'brands', 'types', 'transmissions'));
    }
    
    public function createCar()
    {
        // Check for admin or staff authorization
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get all branches for the dropdown
        $branches = Branch::all();
        
        // If staff user is assigned to a branch, they can only add cars to their branch
        $userBranchId = auth()->user()->branch_id;
        
        return view('admin.cars.create', compact('branches', 'userBranchId'));
    }
    
    public function storeCar(Request $request)
    {
        // Check for admin or staff authorization
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action.');
        }
        
        // Validate input
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|max:255|unique:cars',
            'daily_rate' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Check if staff user is trying to add car to different branch
        if (auth()->user()->isStaff() && auth()->user()->branch_id && auth()->user()->branch_id != $request->branch_id) {
            return back()->with('error', 'You can only add cars to your assigned branch.');
        }
        
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
            $validated['image'] = $imagePath;
        }
        
        // Create the car
        $car = Car::create($validated);
        
        return redirect()->route('admin.cars')->with('success', 'Car added successfully!');
    }
    
    public function editCar(Car $car)
{
    // Check for admin or staff authorization
    if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized action.');
    }
    
    // Check if staff user is trying to edit car from different branch
    if (auth()->user()->isStaff() && auth()->user()->branch_id && auth()->user()->branch_id != $car->branch_id) {
        return redirect()->route('admin.cars')->with('error', 'You can only edit cars from your assigned branch.');
    }
    
    // Get all branches for the dropdown
    $branches = Branch::all();
    
    // If staff user is assigned to a branch, they can only reassign to their branch
    $userBranchId = auth()->user()->branch_id;
    
    return view('admin.cars.edit', compact('car', 'branches', 'userBranchId'));
}
    
    public function updateCar(Request $request, Car $car)
{
    // Check for admin or staff authorization
    if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized action.');
    }
    
    // The car is already injected, no need to find it again
    // Remove this line: $car = Car::findOrFail($carId);
    
    // Check if staff user is trying to update car from different branch
    if (auth()->user()->isStaff() && auth()->user()->branch_id && auth()->user()->branch_id != $car->branch_id) {
        return redirect()->route('admin.cars')->with('error', 'You can only update cars from your assigned branch.');
    }
    
    // Validate input
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'transmission' => 'required|string|max:255',
        'color' => 'nullable|string|max:255',
        'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
        'plate_number' => 'required|string|max:255|unique:cars,plate_number,' . $car->id,
        'daily_rate' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'branch_id' => 'required|exists:branches,id',
        'available' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    
    // Check if staff user is trying to move car to different branch
    if (auth()->user()->isStaff() && auth()->user()->branch_id && auth()->user()->branch_id != $request->branch_id) {
        return back()->with('error', 'You cannot move cars to a different branch.');
    }
    
    // Handle image upload if provided
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        
        $imagePath = $request->file('image')->store('cars', 'public');
        $validated['image'] = $imagePath;
    }
    
    // Update the car
    $car->update($validated);
    
    return redirect()->route('admin.cars')->with('success', 'Car updated successfully!');
}
    
    public function deleteCar(Car $car)
{
    // Check for admin or staff authorization
    if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized action.');
    }
    
    // The car is already injected, no need to find it again
    // Remove this line: $car = Car::findOrFail($carId);
    
    // Check if staff user is trying to delete car from different branch
    if (auth()->user()->isStaff() && auth()->user()->branch_id && auth()->user()->branch_id != $car->branch_id) {
        return redirect()->route('admin.cars')->with('error', 'You can only delete cars from your assigned branch.');
    }
    
    // Check if car has any bookings
    if ($car->bookings()->exists()) {
        return redirect()->route('admin.cars')->with('error', 'Cannot delete car with existing bookings.');
    }
    
    // Delete image if exists
    if ($car->image) {
        Storage::disk('public')->delete($car->image);
    }
    
    // Delete the car
    $car->delete();
    
    return redirect()->route('admin.cars')->with('success', 'Car deleted successfully!');
}
    
    public function bookings(Request $request)
    {
        // Check for admin or staff authorization
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get the query parameters for filtering
        $status = $request->input('status');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $branch_id = $request->input('branch_id');
        
        // Start with all bookings query with eager loading
        $bookingsQuery = Booking::with(['user', 'cars.branch']);
        
        // Apply status filter if provided
        if ($status) {
            $bookingsQuery->where('status', $status);
        }
        
        // Apply date range filter if provided
        if ($start_date) {
            $bookingsQuery->where('start_date', '>=', $start_date);
        }
        
        if ($end_date) {
            $bookingsQuery->where('end_date', '<=', $end_date);
        }
        
        // If staff user is assigned to a branch, show only bookings for cars in their branch
        if (auth()->user()->isStaff() && auth()->user()->branch_id) {
            $branchId = auth()->user()->branch_id;
            
            $bookingsQuery->whereHas('cars', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            });
        } 
        // Otherwise, apply branch filter if provided
        elseif ($branch_id) {
            $bookingsQuery->whereHas('cars', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            });
        }
        
        // Get paginated results
        $bookings = $bookingsQuery->latest()->paginate(10);
        
        // Get branches for filter dropdown
        $branches = Branch::all();
        
        return view('admin.bookings.index', compact('bookings', 'branches', 'status', 'start_date', 'end_date', 'branch_id'));
    }
    
    public function showBooking($booking)
{
    // Check for admin or staff authorization
    if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized action.');
    }
    
    // Find the booking with all related data
    $booking = Booking::with(['user', 'cars.branch'])->findOrFail($booking);
    
    // Check if staff user is trying to view booking from different branch
    if (auth()->user()->isStaff() && auth()->user()->branch_id) {
        $branchId = auth()->user()->branch_id;
        
        // Check if any of the cars in this booking belong to the staff's branch
        $hasAccessToBooking = $booking->cars->contains(function ($car) use ($branchId) {
            return $car->branch_id == $branchId;
        });
        
        if (!$hasAccessToBooking) {
            return redirect()->route('admin.bookings')
                ->with('error', 'You can only view bookings for cars from your assigned branch.');
        }
    }
    
    return view('admin.bookings.show', compact('booking'));
}
    
    public function updateBookingStatus(Request $request, $booking)
{
    // Check for admin or staff authorization
    if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized action.');
    }
    
    // Find the booking
    $booking = Booking::with('cars')->findOrFail($booking);
    
    // Check if staff user is trying to update booking from different branch
    if (auth()->user()->isStaff() && auth()->user()->branch_id) {
        $branchId = auth()->user()->branch_id;
        
        // Check if any of the cars in this booking belong to the staff's branch
        $hasAccessToBooking = $booking->cars->contains(function ($car) use ($branchId) {
            return $car->branch_id == $branchId;
        });
        
        if (!$hasAccessToBooking) {
            return redirect()->route('admin.bookings')
                ->with('error', 'You can only update bookings for cars from your assigned branch.');
        }
    }
    
    // Validate input
    $validated = $request->validate([
        'status' => 'required|in:approved,rejected,completed,cancelled',
        'notes' => 'nullable|string',
    ]);
    
    // Check if status transition is valid
    $currentStatus = $booking->status;
    $newStatus = $validated['status'];
    
    $validTransitions = [
        'pending' => ['approved', 'rejected'],
        'approved' => ['completed', 'cancelled'],
        // Once rejected, completed, or cancelled, no further transitions allowed
    ];
    
    if (!isset($validTransitions[$currentStatus]) || !in_array($newStatus, $validTransitions[$currentStatus])) {
        return back()->with('error', "Cannot change booking status from '$currentStatus' to '$newStatus'.");
    }
    
    // Update the booking status
    $booking->status = $newStatus;
    
    // Add notes if provided
    if (!empty($validated['notes'])) {
        $booking->notes = $validated['notes'];
    }
    
    // Save the changes
    $booking->save();
    
    // Update car availability if booking is cancelled
    if ($newStatus === 'cancelled' && $currentStatus === 'approved') {
        // No need to change car availability as they become available for new bookings
    }
    
    return redirect()->route('admin.bookings.show', $booking->id)
        ->with('success', "Booking has been {$newStatus} successfully.");
}
    
    public function staff()
    {
        // Ensure only admin can access this
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        // Get staff users (staff and admin roles only)
        $staff = User::whereIn('role', ['staff', 'admin'])
            ->with('branch')
            ->latest()
            ->paginate(10);
        
        return view('admin.staff.index', compact('staff'));
    }
    
    public function createStaff()
    {
        // Ensure only admin can access this
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        // Get all branches for the dropdown
        $branches = Branch::all();
        
        return view('admin.staff.create', compact('branches'));
    }
    
    public function storeStaff(Request $request)
    {
        // Ensure only admin can access this
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:staff,admin',
            'branch_id' => 'nullable|exists:branches,id',
        ]);
        
        // If role is admin, branch_id should be null
        if ($validated['role'] === 'admin') {
            $validated['branch_id'] = null;
        }
        
        // Hash the password
        $validated['password'] = Hash::make($validated['password']);
        
        // Create the user
        $user = User::create($validated);
        
        return redirect()->route('admin.staff')
            ->with('success', 'Staff account created successfully!');
    }
    
    public function editStaff($userId)
    {
        // Ensure only admin can access this
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        // Find the user
        $user = User::findOrFail($userId);
        
        // Ensure we're editing a staff or admin account
        if (!in_array($user->role, ['staff', 'admin'])) {
            return redirect()->route('admin.staff')
                ->with('error', 'You can only edit staff or admin accounts.');
        }
        
        // Get all branches for the dropdown
        $branches = Branch::all();
        
        return view('admin.staff.edit', compact('user', 'branches'));
    }
    
    public function updateStaff(Request $request, $userId)
    {
        // Ensure only admin can access this
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        // Find the user
        $user = User::findOrFail($userId);
        
        // Ensure we're editing a staff or admin account
        if (!in_array($user->role, ['staff', 'admin'])) {
            return redirect()->route('admin.staff')
                ->with('error', 'You can only edit staff or admin accounts.');
        }
        
        // Validate input
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:staff,admin',
            'branch_id' => 'nullable|exists:branches,id',
        ];
        
        // Add password validation only if password is being changed
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }
        
        $validated = $request->validate($rules);
        
        // If role is admin, branch_id should be null
        if ($validated['role'] === 'admin') {
            $validated['branch_id'] = null;
        }
        
        // Handle password if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Remove password from validated data if not being updated
            unset($validated['password']);
        }
        
        // Update the user
        $user->update($validated);
        
        return redirect()->route('admin.staff')
            ->with('success', 'Staff account updated successfully!');
    }
    
    public function deleteStaff($userId)
    {
        // Ensure only admin can access this
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        // Find the user
        $user = User::findOrFail($userId);
        
        // Ensure we're deleting a staff or admin account
        if (!in_array($user->role, ['staff', 'admin'])) {
            return redirect()->route('admin.staff')
                ->with('error', 'You can only delete staff or admin accounts.');
        }
        
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.staff')
                ->with('error', 'You cannot delete your own account.');
        }
        
        // Delete the user
        $user->delete();
        
        return redirect()->route('admin.staff')
            ->with('success', 'Staff account deleted successfully!');
    }
}