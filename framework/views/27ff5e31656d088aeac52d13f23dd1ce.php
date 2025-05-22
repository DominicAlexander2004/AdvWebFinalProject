

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --success-color: #27ae60;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
        --info-color: #17a2b8;
        --light-bg: #f8f9fa;
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        --card-hover-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .admin-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .admin-header::before {
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

    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .welcome-subtitle {
        opacity: 0.9;
        position: relative;
        z-index: 2;
        font-size: 1.1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .stats-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-5px);
    }

    .stats-card.primary { --gradient: linear-gradient(45deg, var(--secondary-color), #5dade2); }
    .stats-card.success { --gradient: linear-gradient(45deg, var(--success-color), #58d68d); }
    .stats-card.warning { --gradient: linear-gradient(45deg, var(--warning-color), #f8c471); }
    .stats-card.info { --gradient: linear-gradient(45deg, var(--info-color), #5dade2); }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        margin-bottom: 1.5rem;
    }

    .stats-icon.primary { background: linear-gradient(45deg, var(--secondary-color), #5dade2); }
    .stats-icon.success { background: linear-gradient(45deg, var(--success-color), #58d68d); }
    .stats-icon.warning { background: linear-gradient(45deg, var(--warning-color), #f8c471); }
    .stats-icon.info { background: linear-gradient(45deg, var(--info-color), #5dade2); }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .stats-label {
        color: #7f8c8d;
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .stats-link {
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .stats-link:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }

    .dashboard-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-2px);
    }

    .card-header-custom {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
        border: none;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .recent-bookings-table {
        margin: 0;
    }

    .recent-bookings-table th {
        border: none;
        background: #f8f9fa;
        color: var(--primary-color);
        font-weight: 600;
        padding: 1rem;
        font-size: 0.9rem;
    }

    .recent-bookings-table td {
        border: none;
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
    }

    .recent-bookings-table tr:hover {
        background: #f8f9fa;
    }

    .booking-id {
        font-weight: 600;
        color: var(--primary-color);
    }

    .customer-name {
        font-weight: 500;
        color: var(--primary-color);
    }

    .car-list {
        font-size: 0.9rem;
        color: #7f8c8d;
    }

    .car-list div {
        margin-bottom: 0.25rem;
    }

    .date-range {
        font-size: 0.9rem;
        color: var(--primary-color);
        font-weight: 500;
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
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
        background: linear-gradient(45deg, var(--danger-color), #ec7063);
        color: white;
    }

    .status-completed {
        background: linear-gradient(45deg, var(--info-color), #5dade2);
        color: white;
    }

    .btn-view {
        background: linear-gradient(45deg, var(--secondary-color), #5dade2);
        border: none;
        border-radius: 8px;
        color: white;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        color: white;
    }

    .btn-view-all {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        border: none;
        border-radius: 12px;
        color: white;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-view-all:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(44, 62, 80, 0.3);
        color: white;
    }

    .quick-actions {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .quick-action-btn {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        text-decoration: none;
        color: var(--primary-color);
        transition: all 0.3s ease;
        display: block;
        height: 100%;
    }

    .quick-action-btn:hover {
        border-color: var(--secondary-color);
        color: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: var(--card-hover-shadow);
    }

    .quick-action-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .quick-action-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .quick-action-desc {
        font-size: 0.9rem;
        color: #7f8c8d;
        margin: 0;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #7f8c8d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #bdc3c7;
    }

    .role-badge {
        background: linear-gradient(45deg, var(--info-color), #5dade2);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .welcome-user {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .welcome-title {
            font-size: 1.5rem;
        }
        
        .stats-number {
            font-size: 2rem;
        }
        
        .quick-actions {
            padding: 1rem;
        }
    }
</style>

<div class="admin-header">
    <div class="container">
        <div class="welcome-user">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h1 class="welcome-title">
                    Welcome back, <?php echo e(auth()->user()->name); ?>!
                </h1>
                <p class="welcome-subtitle">
                    <span class="role-badge"><?php echo e(ucfirst(auth()->user()->role)); ?></span>
                    <?php if(auth()->user()->branch): ?>
                        <span class="ms-2"><?php echo e(auth()->user()->branch->name); ?> - <?php echo e(auth()->user()->branch->location); ?></span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stats-card primary">
            <div class="stats-icon primary">
                <i class="fas fa-car"></i>
            </div>
            <div class="stats-number"><?php echo e($totalCars); ?></div>
            <div class="stats-label">Total Cars</div>
            <a href="<?php echo e(route('admin.cars')); ?>" class="stats-link">
                View all cars <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="stats-card success">
            <div class="stats-icon success">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stats-number"><?php echo e($totalBookings); ?></div>
            <div class="stats-label">Total Bookings</div>
            <a href="<?php echo e(route('admin.bookings')); ?>" class="stats-link">
                View all bookings <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="stats-card warning">
            <div class="stats-icon warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-number"><?php echo e($pendingBookings); ?></div>
            <div class="stats-label">Pending Bookings</div>
            <a href="<?php echo e(route('admin.bookings', ['status' => 'pending'])); ?>" class="stats-link">
                Review pending <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="stats-card info">
            <div class="stats-icon info">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stats-number"><?php echo e($approvedBookings); ?></div>
            <div class="stats-label">Approved Bookings</div>
            <a href="<?php echo e(route('admin.bookings', ['status' => 'approved'])); ?>" class="stats-link">
                View approved <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h4 class="mb-4">
            <i class="fas fa-bolt me-2"></i>Quick Actions
        </h4>
        <div class="row g-3">
            <div class="col-md-3">
                <a href="<?php echo e(route('admin.cars.create')); ?>" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="quick-action-title">Add New Car</div>
                    <p class="quick-action-desc">Add a new vehicle to the fleet</p>
                </a>
            </div>
            <div class="col-md-3">
                <a href="<?php echo e(route('admin.bookings', ['status' => 'pending'])); ?>" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="quick-action-title">Review Bookings</div>
                    <p class="quick-action-desc">Approve or reject pending bookings</p>
                </a>
            </div>
            <div class="col-md-3">
                <a href="<?php echo e(route('admin.cars')); ?>" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <div class="quick-action-title">Manage Cars</div>
                    <p class="quick-action-desc">Edit or remove existing vehicles</p>
                </a>
            </div>
            <?php if(auth()->user()->role === 'admin'): ?>
            <div class="col-md-3">
                <a href="<?php echo e(route('admin.staff')); ?>" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="quick-action-title">Manage Staff</div>
                    <p class="quick-action-desc">Add or edit staff accounts</p>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="dashboard-card">
        <div class="card-header-custom">
            <i class="fas fa-calendar-alt me-2"></i>Recent Bookings
        </div>
        <div class="card-body p-0">
            <?php if($recentBookings->isEmpty()): ?>
                <div class="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <p class="mb-0">No recent bookings found</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table recent-bookings-table">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer</th>
                                <th>Cars</th>
                                <th>Dates</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <span class="booking-id">#<?php echo e($booking->id); ?></span>
                                    </td>
                                    <td>
                                        <div class="customer-name"><?php echo e($booking->user->name); ?></div>
                                        <small class="text-muted"><?php echo e($booking->user->email); ?></small>
                                    </td>
                                    <td>
                                        <div class="car-list">
                                            <?php $__currentLoopData = $booking->cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div><?php echo e($car->brand); ?> <?php echo e($car->model); ?></div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-range">
                                            <?php echo e($booking->start_date->format('d M')); ?> - 
                                            <?php echo e($booking->end_date->format('d M Y')); ?>

                                        </div>
                                        <small class="text-muted">
                                            <?php echo e($booking->start_date->diffInDays($booking->end_date) + 1); ?> days
                                        </small>
                                    </td>
                                    <td>
                                        <span class="status-badge status-<?php echo e($booking->status); ?>">
                                            <?php echo e(ucfirst($booking->status)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.bookings.show', $booking)); ?>" class="btn btn-view">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <?php if($recentBookings->isNotEmpty()): ?>
            <div class="card-footer bg-transparent border-0 text-center p-3">
                <a href="<?php echo e(route('admin.bookings')); ?>" class="btn-view-all">
                    <i class="fas fa-list me-2"></i>View All Bookings
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate stats cards on load
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Animate quick action buttons
    const quickActions = document.querySelectorAll('.quick-action-btn');
    quickActions.forEach((btn, index) => {
        btn.style.opacity = '0';
        btn.style.transform = 'translateY(20px)';
        btn.style.transition = `opacity 0.6s ease ${(index + 4) * 0.1}s, transform 0.6s ease ${(index + 4) * 0.1}s`;
        
        setTimeout(() => {
            btn.style.opacity = '1';
            btn.style.transform = 'translateY(0)';
        }, (index + 4) * 100);
    });

    // Add number counting animation
    const statsNumbers = document.querySelectorAll('.stats-number');
    statsNumbers.forEach((numberEl, index) => {
        const finalNumber = parseInt(numberEl.textContent);
        let currentNumber = 0;
        const increment = Math.ceil(finalNumber / 50);
        
        setTimeout(() => {
            const counter = setInterval(() => {
                currentNumber += increment;
                if (currentNumber >= finalNumber) {
                    currentNumber = finalNumber;
                    clearInterval(counter);
                }
                numberEl.textContent = currentNumber;
            }, 30);
        }, index * 200);
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ece-rental\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>