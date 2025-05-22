

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --accent-color: #e74c3c;
        --success-color: #27ae60;
        --warning-color: #f39c12;
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

    .search-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        border: none;
        margin-bottom: 2rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .search-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-2px);
    }

    .search-card-header {
        background: linear-gradient(45deg, var(--secondary-color), #5dade2);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .search-card-header h5 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.15);
    }

    .btn-search {
        background: linear-gradient(45deg, var(--secondary-color), #5dade2);
        border: none;
        border-radius: 12px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
    }

    .btn-reset {
        background: linear-gradient(45deg, #95a5a6, #bdc3c7);
        border: none;
        border-radius: 12px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-reset:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(149, 165, 166, 0.3);
    }

    .car-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .car-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-5px);
    }

    .car-image {
        height: 220px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .car-card:hover .car-image {
        transform: scale(1.05);
    }

    .car-placeholder {
        height: 220px;
        background: linear-gradient(45deg, #ecf0f1, #bdc3c7);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 3rem;
        transition: all 0.3s ease;
    }

    .car-card:hover .car-placeholder {
        background: linear-gradient(45deg, #3498db, #2980b9);
        color: white;
    }

    .car-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .car-detail {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .car-detail i {
        color: var(--secondary-color);
        width: 20px;
    }

    .car-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--success-color);
    }

    .car-checkbox {
        transform: scale(1.3);
        accent-color: var(--secondary-color);
    }

    .car-checkbox:checked + label {
        color: var(--secondary-color);
        font-weight: 600;
    }

    .booking-summary-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        border: none;
        position: sticky;
        top: 2rem;
    }

    .booking-summary-header {
        background: linear-gradient(45deg, var(--success-color), #2ecc71);
        color: white;
        padding: 1.5rem;
        border-radius: 20px 20px 0 0;
    }

    .btn-book {
        background: linear-gradient(45deg, var(--success-color), #2ecc71);
        border: none;
        border-radius: 12px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-book:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
    }

    .btn-book:disabled {
        background: #95a5a6;
        opacity: 0.6;
    }

    .alert {
        border-radius: 15px;
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 500;
    }

    .alert-info {
        background: linear-gradient(45deg, rgba(52, 152, 219, 0.1), rgba(93, 173, 226, 0.1));
        color: var(--secondary-color);
        border-left: 4px solid var(--secondary-color);
    }

    .alert-danger {
        background: linear-gradient(45deg, rgba(231, 76, 60, 0.1), rgba(192, 57, 43, 0.1));
        color: #c0392b;
        border-left: 4px solid var(--accent-color);
    }

    .alert-success {
        background: linear-gradient(45deg, rgba(39, 174, 96, 0.1), rgba(46, 204, 113, 0.1));
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        border-radius: 20px 20px 0 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination .page-link {
        border-radius: 10px;
        margin: 0 5px;
        border: none;
        padding: 0.75rem 1rem;
        color: var(--primary-color);
        background: white;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: var(--secondary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--card-hover-shadow);
    }

    .pagination .page-item.active .page-link {
        background: var(--secondary-color);
        color: white;
        box-shadow: var(--card-hover-shadow);
    }

    .selected-car-item {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.5rem;
        border-left: 4px solid var(--secondary-color);
        transition: all 0.3s ease;
    }

    .selected-car-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .rental-period-display {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        text-align: center;
        font-weight: 600;
        color: var(--primary-color);
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
        color: var(--secondary-color);
    }

    .floating-action {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
    }

    .btn-floating {
        background: linear-gradient(45deg, var(--secondary-color), #5dade2);
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        transition: all 0.3s ease;
        color: white;
        font-size: 1.5rem;
    }

    .btn-floating:hover {
        transform: scale(1.1);
        box-shadow: 0 12px 35px rgba(52, 152, 219, 0.4);
        color: white;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
        .page-subtitle {
            font-size: 1rem;
        }
        
        .car-card {
            margin-bottom: 1.5rem;
        }
        
        .booking-summary-card {
            position: relative;
            top: 0;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-car me-3"></i>Available Cars
                </h1>
                <p class="page-subtitle">Find your perfect ride from our quality fleet</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex gap-3 justify-content-md-end justify-content-center">
                    <div class="stats-card">
                        <i class="fas fa-car stats-icon"></i>
                        <div class="h4 mb-0"><?php echo e($cars->total()); ?></div>
                        <small>Available Cars</small>
                    </div>
                    <div class="stats-card">
                        <i class="fas fa-map-marker-alt stats-icon"></i>
                        <div class="h4 mb-0"><?php echo e($branches->count()); ?></div>
                        <small>Branches</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Search Card -->
    <div class="search-card">
        <div class="search-card-header">
            <h5><i class="fas fa-search me-2"></i>Find Your Perfect Car</h5>
        </div>
        <div class="card-body p-4">
            <form method="GET" action="<?php echo e(route('cars.index')); ?>" id="searchForm">
                <div class="row g-3">
                    <!-- Date Range -->
                    <div class="col-lg-6">
                        <div class="row g-2">
                            <div class="col-6">
                                <label for="start_date" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt me-1"></i>Start Date
                                </label>
                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                    value="<?php echo e(request('start_date')); ?>" min="<?php echo e($minStartDate); ?>" required>
                                <small class="text-muted">Minimum 2 days advance</small>
                            </div>
                            <div class="col-6">
                                <label for="end_date" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-check me-1"></i>End Date
                                </label>
                                <input type="date" class="form-control" id="end_date" name="end_date" 
                                    value="<?php echo e(request('end_date')); ?>" min="<?php echo e($minStartDate); ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Branch Filter -->
                    <div class="col-lg-6">
                        <label for="branch_id" class="form-label fw-semibold">
                            <i class="fas fa-building me-1"></i>Branch Location
                        </label>
                        <select class="form-select" id="branch_id" name="branch_id">
                            <option value="">All Branches</option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e(request('branch_id') == $branch->id ? 'selected' : ''); ?>>
                                    <?php echo e($branch->name); ?> - <?php echo e($branch->location); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Car Filters -->
                    <div class="col-md-4">
                        <label for="brand" class="form-label fw-semibold">
                            <i class="fas fa-car me-1"></i>Brand
                        </label>
                        <select class="form-select" id="brand" name="brand">
                            <option value="">All Brands</option>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand); ?>" <?php echo e(request('brand') == $brand ? 'selected' : ''); ?>>
                                    <?php echo e($brand); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="type" class="form-label fw-semibold">
                            <i class="fas fa-tags me-1"></i>Car Type
                        </label>
                        <select class="form-select" id="type" name="type">
                            <option value="">All Types</option>
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type); ?>" <?php echo e(request('type') == $type ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($type)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="transmission" class="form-label fw-semibold">
                            <i class="fas fa-cog me-1"></i>Transmission
                        </label>
                        <select class="form-select" id="transmission" name="transmission">
                            <option value="">All Transmissions</option>
                            <?php $__currentLoopData = $transmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transmission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($transmission); ?>" <?php echo e(request('transmission') == $transmission ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($transmission)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="submit" class="btn btn-search text-white">
                                <i class="fas fa-search me-2"></i>Search Cars
                            </button>
                            <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-reset text-white">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Alerts -->
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i><?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($cars->isEmpty()): ?>
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-car fa-3x mb-3"></i>
            <h4>No cars available</h4>
            <p>No cars match your selected criteria. Try adjusting your filters or dates.</p>
        </div>
    <?php else: ?>
        <div class="row">
            <!-- Cars Grid -->
            <div class="col-lg-8">
                <form action="<?php echo e(route('bookings.store')); ?>" method="POST" id="bookingForm">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="start_date" value="<?php echo e(request('start_date')); ?>" id="bookingStartDate">
                    <input type="hidden" name="end_date" value="<?php echo e(request('end_date')); ?>" id="bookingEndDate">

                    <div class="row">
                        <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 col-xl-4 mb-4">
                                <div class="card car-card">
                                    <?php if($car->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $car->image)); ?>" class="car-image" alt="<?php echo e($car->brand); ?> <?php echo e($car->model); ?>">
                                    <?php else: ?>
                                        <div class="car-placeholder">
                                            <i class="fas fa-car"></i>
                                        </div>
                                    <?php endif; ?>

                                    <div class="card-body p-3">
                                        <h5 class="car-title"><?php echo e($car->brand); ?> <?php echo e($car->model); ?></h5>
                                        
                                        <div class="car-detail">
                                            <span><i class="fas fa-tag"></i> Type:</span>
                                            <span class="fw-semibold"><?php echo e(ucfirst($car->type)); ?></span>
                                        </div>
                                        <div class="car-detail">
                                            <span><i class="fas fa-cog"></i> Transmission:</span>
                                            <span class="fw-semibold"><?php echo e(ucfirst($car->transmission)); ?></span>
                                        </div>
                                        <div class="car-detail">
                                            <span><i class="fas fa-building"></i> Branch:</span>
                                            <span class="fw-semibold"><?php echo e($car->branch->location); ?></span>
                                        </div>
                                        <div class="car-detail mb-3">
                                            <span><i class="fas fa-money-bill"></i> Daily Rate:</span>
                                            <span class="car-price">RM<?php echo e(number_format($car->daily_rate, 2)); ?></span>
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input car-checkbox" type="checkbox" 
                                                name="car_ids[]" value="<?php echo e($car->id); ?>" id="car-<?php echo e($car->id); ?>">
                                            <label class="form-check-label fw-semibold" for="car-<?php echo e($car->id); ?>">
                                                Select this car
                                            </label>
                                        </div>
                                    </div>

                                    <div class="card-footer bg-transparent border-0 p-3 pt-0">
                                        <button type="button" class="btn btn-outline-primary w-100" 
                                            data-bs-toggle="modal" data-bs-target="#carModal-<?php echo e($car->id); ?>">
                                            <i class="fas fa-info-circle me-2"></i>View Details
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Car Details Modal -->
                            <div class="modal fade" id="carModal-<?php echo e($car->id); ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">
                                                <i class="fas fa-car me-2"></i><?php echo e($car->brand); ?> <?php echo e($car->model); ?>

                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if($car->image): ?>
                                                <img src="<?php echo e(asset('storage/' . $car->image)); ?>" class="img-fluid rounded mb-3" alt="<?php echo e($car->brand); ?> <?php echo e($car->model); ?>">
                                            <?php endif; ?>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-borderless">
                                                        <tr><th>Brand:</th><td><?php echo e($car->brand); ?></td></tr>
                                                        <tr><th>Model:</th><td><?php echo e($car->model); ?></td></tr>
                                                        <tr><th>Year:</th><td><?php echo e($car->year); ?></td></tr>
                                                        <tr><th>Type:</th><td><?php echo e(ucfirst($car->type)); ?></td></tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-borderless">
                                                        <tr><th>Transmission:</th><td><?php echo e(ucfirst($car->transmission)); ?></td></tr>
                                                        <tr><th>Color:</th><td><?php echo e(ucfirst($car->color)); ?></td></tr>
                                                        <tr><th>Daily Rate:</th><td class="text-success fw-bold">RM<?php echo e(number_format($car->daily_rate, 2)); ?></td></tr>
                                                        <tr><th>Branch:</th><td><?php echo e($car->branch->name); ?> (<?php echo e($car->branch->location); ?>)</td></tr>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            <?php if($car->description): ?>
                                                <h6 class="fw-bold">Description:</h6>
                                                <p class="text-muted"><?php echo e($car->description); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary select-car-btn" 
                                                data-car-id="<?php echo e($car->id); ?>" data-bs-dismiss="modal">
                                                <i class="fas fa-plus me-2"></i>Select This Car
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </form>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($cars->links()); ?>

                </div>
            </div>

            <!-- Booking Summary Sidebar -->
            <div class="col-lg-4">
                <div class="booking-summary-card">
                    <div class="booking-summary-header">
                        <h5 class="mb-0">
                            <i class="fas fa-shopping-cart me-2"></i>Booking Summary
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Maximum 2 cars per booking
                        </div>

                        <?php if(request('start_date') && request('end_date')): ?>
                            <div class="rental-period-display">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <strong>Rental Period:</strong><br>
                                <?php echo e(\Carbon\Carbon::parse(request('start_date'))->format('d M Y')); ?> - 
                                <?php echo e(\Carbon\Carbon::parse(request('end_date'))->format('d M Y')); ?>

                            </div>
                        <?php endif; ?>

                        <div id="selectedCarsContainer">
                            <p class="text-muted text-center py-3">
                                <i class="fas fa-car fa-2x mb-2"></i><br>
                                No cars selected yet
                            </p>
                        </div>

                        <button type="submit" form="bookingForm" class="btn btn-book text-white" id="bookNowBtn" disabled>
                            <i class="fas fa-check-circle me-2"></i>Book Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Floating Action Button -->
<div class="floating-action">
    <button type="button" class="btn btn-floating" data-bs-toggle="tooltip" title="Scroll to top" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Date handling
    const today = new Date();
    const minDate = new Date(today);
    minDate.setDate(today.getDate() + 2);
    const minDateStr = minDate.toISOString().split('T')[0];

    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const bookingStartDate = document.getElementById('bookingStartDate');
    const bookingEndDate = document.getElementById('bookingEndDate');

    if (startDateInput && endDateInput) {
        startDateInput.min = minDateStr;
        endDateInput.min = minDateStr;

        startDateInput.addEventListener('change', function() {
            if (new Date(this.value) < minDate) {
                this.value = minDateStr;
                alert('Booking must be made at least 2 days in advance.');
            }
            endDateInput.min = this.value;
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = this.value;
            }
            if (bookingStartDate) bookingStartDate.value = this.value;
        });

        endDateInput.addEventListener('change', function() {
            if (new Date(this.value) < minDate) {
                this.value = minDateStr;
                alert('End date must be at least 2 days from today.');
            } else if (this.value < startDateInput.value) {
                this.value = startDateInput.value;
                alert('End date cannot be before start date.');
            }
            if (bookingEndDate) bookingEndDate.value = this.value;
        });
    }

    // Car selection handling
    const checkboxes = document.querySelectorAll('input[name="car_ids[]"]');
    const selectedCarsContainer = document.getElementById('selectedCarsContainer');
    const bookNowBtn = document.getElementById('bookNowBtn');

    function updateBookingSummary() {
        const selectedCars = [];
        
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                const card = checkbox.closest('.car-card');
                const title = card.querySelector('.car-title').textContent.trim();
                const price = card.querySelector('.car-price').textContent.trim();
                
                selectedCars.push({
                    id: checkbox.value,
                    name: title,
                    price: price
                });
            }
        });

        if (selectedCars.length > 0) {
            let html = '<div class="mb-3">';
            selectedCars.forEach(function(car) {
                html += `
                    <div class="selected-car-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">${car.name}</div>
                                <small class="text-success">${car.price} per day</small>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeCar(${car.id})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            
            selectedCarsContainer.innerHTML = html;
            bookNowBtn.disabled = false;
        } else {
            selectedCarsContainer.innerHTML = `
                <p class="text-muted text-center py-3">
                    <i class="fas fa-car fa-2x mb-2"></i><br>
                    No cars selected yet
                </p>
            `;
            bookNowBtn.disabled = true;
        }

        // Handle 2 car limit
        if (selectedCars.length >= 2) {
            checkboxes.forEach(function(cb) {
                if (!cb.checked) {
                    cb.disabled = true;
                    cb.closest('.car-card').style.opacity = '0.6';
                }
            });
        } else {
            checkboxes.forEach(function(cb) {
                cb.disabled = false;
                cb.closest('.car-card').style.opacity = '1';
            });
        }
    }

    // Global function to remove a car
    window.removeCar = function(carId) {
        const checkbox = document.getElementById('car-' + carId);
        if (checkbox) {
            checkbox.checked = false;
            updateBookingSummary();
        }
    };

    // Add event listeners
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateBookingSummary);
    });

    // Modal select buttons
    document.querySelectorAll('.select-car-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const carId = this.getAttribute('data-car-id');
            const checkbox = document.getElementById('car-' + carId);
            
            if (checkbox) {
                const checkedCount = document.querySelectorAll('input[name="car_ids[]"]:checked').length;
                if (checkedCount < 2 || checkbox.checked) {
                    checkbox.checked = !checkbox.checked;
                    updateBookingSummary();
                } else {
                    alert('You can only select a maximum of 2 cars.');
                }
            }
        });
    });

    // Form submission
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            if (!startDateInput.value || !endDateInput.value) {
                e.preventDefault();
                alert('Please select both start and end dates.');
                return false;
            }

            const selectedCount = document.querySelectorAll('input[name="car_ids[]"]:checked').length;
            if (selectedCount === 0) {
                e.preventDefault();
                alert('Please select at least one car.');
                return false;
            }

            if (bookingStartDate) bookingStartDate.value = startDateInput.value;
            if (bookingEndDate) bookingEndDate.value = endDateInput.value;

            bookNowBtn.disabled = true;
            bookNowBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        });
    }

    // Initialize
    updateBookingSummary();
});

// Scroll to top function
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Show/hide floating button based on scroll
window.addEventListener('scroll', function() {
    const floatingBtn = document.querySelector('.floating-action');
    if (window.scrollY > 300) {
        floatingBtn.style.display = 'block';
    } else {
        floatingBtn.style.display = 'none';
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ece-rental\resources\views/cars/index.blade.php ENDPATH**/ ?>