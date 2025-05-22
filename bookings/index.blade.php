@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --accent-color: #e74c3c;
        --success-color: #27ae60;
        --warning-color: #f39c12;
        --info-color: #17a2b8;
        --light-bg: #f8f9fa;
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        --card-hover-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></svg>') repeat;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-50px) translateY(-50px); }
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .page-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .booking-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }

    .booking-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-3px);
    }

    .booking-header {
        background: linear-gradient(45deg, var(--secondary-color), #5dade2);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .booking-id {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0;
    }

    .booking-date {
        opacity: 0.9;
        font-size: 0.9rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: linear-gradient(45deg, var(--warning-color), #f8c471);
        color: white;
    }

    .status-approved {
        background: linear-gradient(45deg, var(--success-color), #58d68d);
        color: white;
    }

    .status-rejected {
        background: linear-gradient(45deg, var(--accent-color), #ec7063);
        color: white;
    }

    .status-completed {
        background: linear-gradient(45deg, var(--info-color), #5dade2);
        color: white;
    }

    .status-cancelled {
        background: linear-gradient(45deg, #95a5a6, #bdc3c7);
        color: white;
    }

    .car-item {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.5rem;
        border-left: 4px solid var(--secondary-color);
        transition: all 0.3s ease;
    }

    .car-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .car-name {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0;
    }

    .rental-period {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .rental-dates {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .rental-duration {
        color: var(--secondary-color);
        font-weight: 600;
    }

    .total-amount {
        background: linear-gradient(45deg, var(--success-color), #58d68d);
        color: white;
        border-radius: 15px;
        padding: 1rem;
        text-align: center;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--secondary-color);
        margin-bottom: 2rem;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .empty-subtitle {
        color: #7f8c8d;
        margin-bottom: 2rem;
    }

    .btn-browse {
        background: linear-gradient(45deg, var(--secondary-color), #5dade2);
        border: none;
        border-radius: 12px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-browse:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        color: white;
    }

    .alert {
        border-radius: 15px;
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 500;
        margin-bottom: 2rem;
    }

    .alert-success {
        background: linear-gradient(45deg, rgba(39, 174, 96, 0.1), rgba(46, 204, 113, 0.1));
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        border: none;
    }

    .stats-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-3px);
    }

    .stats-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .stats-icon.pending { color: var(--warning-color); }
    .stats-icon.approved { color: var(--success-color); }
    .stats-icon.total { color: var(--secondary-color); }
    .stats-icon.completed { color: var(--info-color); }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        color: #7f8c8d;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .booking-notes {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 10px;
        padding: 1rem;
        margin-top: 1rem;
        color: #856404;
    }

    .booking-timeline {
        position: relative;
        padding-left: 2rem;
        margin-top: 1rem;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -2rem;
        top: 0.5rem;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--secondary-color);
    }

    .timeline-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: -1.75rem;
        top: 1rem;
        width: 2px;
        height: calc(100% - 0.5rem);
        background: #e9ecef;
    }

    .timeline-content {
        font-size: 0.9rem;
        color: #7f8c8d;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
        .page-subtitle {
            font-size: 1rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .booking-card {
            margin-bottom: 1.5rem;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-calendar-check me-3"></i>My Booking History
                </h1>
                <p class="page-subtitle">Track and manage all your car rental bookings</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('cars.index') }}" class="btn btn-browse">
                    <i class="fas fa-plus-circle me-2"></i>New Booking
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if ($bookings->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-calendar-times"></i>
            </div>
            <h3 class="empty-title">No bookings yet</h3>
            <p class="empty-subtitle">You haven't made any car rental bookings. Start exploring our available cars!</p>
            <a href="{{ route('cars.index') }}" class="btn-browse">
                <i class="fas fa-car me-2"></i>Browse Cars
            </a>
        </div>
    @else
        <!-- Booking Statistics -->
        <div class="stats-grid">
            <div class="stats-card">
                <i class="fas fa-calendar-alt stats-icon total"></i>
                <div class="stats-number">{{ $bookings->count() }}</div>
                <div class="stats-label">Total Bookings</div>
            </div>
            <div class="stats-card">
                <i class="fas fa-clock stats-icon pending"></i>
                <div class="stats-number">{{ $bookings->where('status', 'pending')->count() }}</div>
                <div class="stats-label">Pending</div>
            </div>
            <div class="stats-card">
                <i class="fas fa-check-circle stats-icon approved"></i>
                <div class="stats-number">{{ $bookings->where('status', 'approved')->count() }}</div>
                <div class="stats-label">Approved</div>
            </div>
            <div class="stats-card">
                <i class="fas fa-flag-checkered stats-icon completed"></i>
                <div class="stats-number">{{ $bookings->where('status', 'completed')->count() }}</div>
                <div class="stats-label">Completed</div>
            </div>
        </div>

        <!-- Bookings List -->
        @foreach ($bookings as $booking)
            <div class="booking-card">
                <div class="booking-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="booking-id">Booking #{{ $booking->id }}</h5>
                            <div class="booking-date">
                                <i class="fas fa-calendar me-1"></i>
                                Booked on {{ $booking->created_at->format('d M Y, h:i A') }}
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-2 mt-md-0">
                            <span class="status-badge status-{{ $booking->status }}">
                                @if($booking->status === 'pending')
                                    <i class="fas fa-clock me-1"></i>Pending
                                @elseif($booking->status === 'approved')
                                    <i class="fas fa-check-circle me-1"></i>Approved
                                @elseif($booking->status === 'rejected')
                                    <i class="fas fa-times-circle me-1"></i>Rejected
                                @elseif($booking->status === 'completed')
                                    <i class="fas fa-flag-checkered me-1"></i>Completed
                                @else
                                    <i class="fas fa-ban me-1"></i>Cancelled
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <!-- Rental Period -->
                        <div class="col-lg-4">
                            <div class="rental-period">
                                <i class="fas fa-calendar-alt fa-2x text-primary mb-3"></i>
                                <div class="rental-dates">
                                    {{ $booking->start_date->format('d M Y') }}
                                    <i class="fas fa-arrow-right mx-2"></i>
                                    {{ $booking->end_date->format('d M Y') }}
                                </div>
                                <div class="rental-duration">
                                    {{ $booking->getTotalDaysAttribute() }} day{{ $booking->getTotalDaysAttribute() > 1 ? 's' : '' }}
                                </div>
                            </div>
                        </div>

                        <!-- Cars List -->
                        <div class="col-lg-5">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-car me-2"></i>Selected Cars
                            </h6>
                            @foreach ($booking->cars as $car)
                                <div class="car-item">
                                    <div class="car-name">{{ $car->brand }} {{ $car->model }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-building me-1"></i>{{ $car->branch->location }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-cog me-1"></i>{{ ucfirst($car->transmission) }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-money-bill me-1"></i>RM{{ number_format($car->daily_rate, 2) }}/day
                                    </small>
                                </div>
                            @endforeach
                        </div>

                        <!-- Total Amount -->
                        <div class="col-lg-3">
                            <div class="total-amount">
                                <i class="fas fa-receipt mb-2"></i>
                                <div>Total Amount</div>
                                <div style="font-size: 1.5rem;">
                                    RM{{ number_format($booking->total_amount ?: $booking->calculateTotalAmount(), 2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($booking->status === 'pending')
                        <div class="booking-timeline">
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <strong>Booking Submitted</strong> - {{ $booking->created_at->format('d M Y, h:i A') }}
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <strong>Awaiting Staff Approval</strong> - Our team is reviewing your booking
                                </div>
                            </div>
                        </div>
                    @elseif($booking->status === 'approved')
                        <div class="booking-timeline">
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <strong>Booking Approved</strong> - Your booking has been confirmed
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <strong>Ready for Pickup</strong> - Visit the branch on your rental start date
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($booking->status === 'rejected' && $booking->notes)
                        <div class="booking-notes">
                            <strong><i class="fas fa-info-circle me-2"></i>Rejection Reason:</strong>
                            <p class="mb-0 mt-2">{{ $booking->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Action Button -->
        <div class="text-center mt-4">
            <a href="{{ route('cars.index') }}" class="btn-browse">
                <i class="fas fa-plus-circle me-2"></i>Make Another Booking
            </a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to booking cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Initially hide booking cards
    document.querySelectorAll('.booking-card').forEach(function(card, index) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });

    // Animate stats cards
    document.querySelectorAll('.stats-card').forEach(function(card, index) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        
        setTimeout(function() {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

@endsection