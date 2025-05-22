@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Welcome to Easy Car Enterprise</h5>
                </div>
                <div class="card-body">
                    <h2 class="mb-3">Hello, {{ auth()->user()->name }}</h2>
                    
                    <p class="lead">Welcome to your personal dashboard at Easy Car Enterprise. From here, you can browse available cars, manage your bookings, and view your account information.</p>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                        <a href="{{ route('cars.index') }}" class="btn btn-primary">
                            <i class="fas fa-car me-1"></i> Browse Cars
                        </a>
                        <a href="{{ route('bookings.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-calendar-alt me-1"></i> My Bookings
                        </a>
                    </div>
                </div>
            </div>
            
            @if(auth()->user()->bookings()->exists())
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Your Recent Bookings</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Cars</th>
                                        <th>Dates</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->bookings()->with('cars')->latest()->take(3)->get() as $booking)
                                        <tr>
                                            <td>#{{ $booking->id }}</td>
                                            <td>
                                                @foreach($booking->cars as $car)
                                                    <span class="badge bg-secondary">{{ $car->brand }} {{ $car->model }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $booking->start_date->format('d/m/Y') }} - {{ $booking->end_date->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge bg-{{ 
                                                    $booking->status === 'approved' ? 'success' : 
                                                    ($booking->status === 'pending' ? 'warning' : 
                                                    ($booking->status === 'rejected' ? 'danger' : 
                                                    ($booking->status === 'completed' ? 'info' : 'secondary'))) 
                                                }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('bookings.index') }}" class="btn btn-sm btn-outline-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('bookings.index') }}" class="btn btn-sm btn-link text-decoration-none">View All Bookings</a>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Account Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="fas fa-user-circle fs-1 me-3 text-primary"></span>
                        <div>
                            <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                            <p class="mb-0 text-muted">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Account Type:</strong>
                        <span class="badge bg-info ms-2">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Member Since:</strong>
                        <span class="ms-2">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                    
                    @if(auth()->user()->bookings()->exists())
                        <div class="mb-3">
                            <strong>Total Bookings:</strong>
                            <span class="ms-2">{{ auth()->user()->bookings()->count() }}</span>
                        </div>
                    @endif
                    
                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-edit me-1"></i> Manage Profile
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Need Help?</h5>
                </div>
                <div class="card-body">
                    <p>If you need any assistance with your bookings or have questions about our services, please don't hesitate to contact our customer support team.</p>
                    
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-phone-alt me-2 text-primary"></i> +60 3-1234 5678
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2 text-primary"></i> support@easycarenterprise.com
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i> Bandar Baru Bangi, Selangor
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection