

<?php $__env->startSection('title', 'Booking Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Filter Bookings</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.bookings')); ?>" method="GET" class="row g-3">
            <!-- Status Filter -->
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">All Statuses</option>
                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>Approved</option>
                    <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                    <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                    <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
            </div>
            
            <!-- Branch Filter (for admin only) -->
            <?php if(!auth()->user()->isStaff() || !auth()->user()->branch_id): ?>
            <div class="col-md-3">
                <label for="branch_id" class="form-label">Branch</label>
                <select class="form-select" id="branch_id" name="branch_id">
                    <option value="">All Branches</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->id); ?>" <?php echo e(request('branch_id') == $branch->id ? 'selected' : ''); ?>>
                            <?php echo e($branch->name); ?> (<?php echo e($branch->location); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php endif; ?>
            
            <!-- Date Range Filter -->
            <div class="col-md-3">
                <label for="start_date" class="form-label">From Date</label>
                <input type="date" class="form-select" id="start_date" name="start_date" value="<?php echo e(request('start_date')); ?>">
            </div>
            
            <div class="col-md-3">
                <label for="end_date" class="form-label">To Date</label>
                <input type="date" class="form-select" id="end_date" name="end_date" value="<?php echo e(request('end_date')); ?>">
            </div>
            
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Apply Filters
                </button>
                <a href="<?php echo e(route('admin.bookings')); ?>" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">All Bookings</h5>
        <span class="badge bg-primary"><?php echo e($bookings->total()); ?> Bookings</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Car(s)</th>
                        <th>Rental Period</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($booking->id); ?></td>
                            <td>
                                <strong><?php echo e($booking->user->name); ?></strong><br>
                                <small class="text-muted"><?php echo e($booking->user->email); ?></small>
                            </td>
                            <td>
                                <?php $__currentLoopData = $booking->cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="badge bg-secondary mb-1"><?php echo e($car->brand); ?> <?php echo e($car->model); ?> (<?php echo e($car->branch->location); ?>)</div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                                <?php echo e($booking->start_date->format('d/m/Y')); ?> - <?php echo e($booking->end_date->format('d/m/Y')); ?><br>
                                <small class="text-muted"><?php echo e($booking->getTotalDaysAttribute()); ?> days</small>
                            </td>
                            <td>RM <?php echo e(number_format($booking->total_amount, 2)); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($booking->status === 'approved' ? 'success' : 
                                    ($booking->status === 'pending' ? 'warning' : 
                                    ($booking->status === 'rejected' ? 'danger' : 
                                    ($booking->status === 'completed' ? 'info' : 'secondary')))); ?>">
                                    <?php echo e(ucfirst($booking->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($booking->created_at->format('d/m/Y H:i')); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.bookings.show', $booking->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">No bookings found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        <?php echo e($bookings->withQueryString()->links()); ?>

    </div>
</div>

<div class="mt-4">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">Quick Status Links</h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                <a href="<?php echo e(route('admin.bookings', ['status' => 'pending'])); ?>" class="btn btn-warning">
                    <i class="fas fa-clock"></i> Pending Bookings
                </a>
                <a href="<?php echo e(route('admin.bookings', ['status' => 'approved'])); ?>" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Approved Bookings
                </a>
                <a href="<?php echo e(route('admin.bookings', ['status' => 'rejected'])); ?>" class="btn btn-danger">
                    <i class="fas fa-times-circle"></i> Rejected Bookings
                </a>
                <a href="<?php echo e(route('admin.bookings', ['status' => 'completed'])); ?>" class="btn btn-info">
                    <i class="fas fa-flag-checkered"></i> Completed Bookings
                </a>
                <a href="<?php echo e(route('admin.bookings', ['status' => 'cancelled'])); ?>" class="btn btn-secondary">
                    <i class="fas fa-ban"></i> Cancelled Bookings
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ece-rental\resources\views/admin/bookings/index.blade.php ENDPATH**/ ?>