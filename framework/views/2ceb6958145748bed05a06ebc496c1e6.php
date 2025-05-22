

<?php $__env->startSection('title', 'Booking Details'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.bookings')); ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Back to List
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <!-- Booking Details Card -->
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Booking #<?php echo e($booking->id); ?></h5>
                <span class="badge bg-<?php echo e($booking->status === 'approved' ? 'success' : 
                    ($booking->status === 'pending' ? 'warning' : 
                    ($booking->status === 'rejected' ? 'danger' : 
                    ($booking->status === 'completed' ? 'info' : 'secondary')))); ?>">
                    <?php echo e(ucfirst($booking->status)); ?>

                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Rental Period</h6>
                        <p>
                            <i class="fas fa-calendar-alt me-1"></i> 
                            <?php echo e($booking->start_date->format('d M Y')); ?> - <?php echo e($booking->end_date->format('d M Y')); ?>

                            <br>
                            <span class="text-muted">(<?php echo e($booking->getTotalDaysAttribute()); ?> days)</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Total Amount</h6>
                        <p class="fs-5 text-primary">RM <?php echo e(number_format($booking->total_amount, 2)); ?></p>
                    </div>
                </div>
                
                <h6 class="fw-bold">Cars</h6>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Car</th>
                                <th>Branch</th>
                                <th>Daily Rate</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $booking->cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if($car->image): ?>
                                                <img src="<?php echo e(asset('storage/' . $car->image)); ?>" alt="<?php echo e($car->brand); ?> <?php echo e($car->model); ?>" 
                                                    class="me-3" style="width: 60px; height: auto;">
                                            <?php endif; ?>
                                            <div>
                                                <strong><?php echo e($car->brand); ?> <?php echo e($car->model); ?></strong><br>
                                                <small class="text-muted"><?php echo e($car->year); ?> • <?php echo e(ucfirst($car->type)); ?> • <?php echo e(ucfirst($car->transmission)); ?></small><br>
                                                <small class="text-muted">Plate: <?php echo e($car->plate_number); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo e($car->branch->name); ?> (<?php echo e($car->branch->location); ?>)</td>
                                    <td>RM <?php echo e(number_format($car->daily_rate, 2)); ?></td>
                                    <td>RM <?php echo e(number_format($car->daily_rate * $booking->getTotalDaysAttribute(), 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total Amount:</th>
                                <th>RM <?php echo e(number_format($booking->total_amount, 2)); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <h6 class="fw-bold">Notes</h6>
                <div class="mb-4">
                    <?php if($booking->notes): ?>
                        <p><?php echo e($booking->notes); ?></p>
                    <?php else: ?>
                        <p class="text-muted">No notes added to this booking.</p>
                    <?php endif; ?>
                </div>
                
                <h6 class="fw-bold">Timeline</h6>
                <ul class="list-group mb-0">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-plus-circle text-success me-2"></i>
                            <span>Booking Created</span>
                        </div>
                        <span class="text-muted"><?php echo e($booking->created_at->format('d M Y, h:i A')); ?></span>
                    </li>
                    <?php if($booking->status !== 'pending'): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-<?php echo e($booking->status === 'approved' ? 'check-circle text-success' : 
                                        ($booking->status === 'rejected' ? 'times-circle text-danger' : 
                                        ($booking->status === 'completed' ? 'flag-checkered text-info' : 'ban text-secondary'))); ?> me-2"></i>
                                <span>Booking <?php echo e(ucfirst($booking->status)); ?></span>
                            </div>
                            <span class="text-muted"><?php echo e($booking->updated_at->format('d M Y, h:i A')); ?></span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Customer Info Card -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <span class="fas fa-user-circle fs-1 me-3 text-primary"></span>
                    <div>
                        <h5 class="mb-0"><?php echo e($booking->user->name); ?></h5>
                        <p class="mb-0 text-muted"><?php echo e($booking->user->email); ?></p>
                    </div>
                </div>
                <p class="mb-0"><strong>Account Created:</strong> <?php echo e($booking->user->created_at->format('d M Y')); ?></p>
                <p><strong>Total Bookings:</strong> <?php echo e($booking->user->bookings->count()); ?></p>
            </div>
        </div>
        
        <!-- Status Action Card -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Booking Actions</h5>
            </div>
            <div class="card-body">
                <?php if($booking->status === 'pending'): ?>
                    <form action="<?php echo e(route('admin.bookings.update-status', $booking)); ?>" method="POST" class="mb-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check-circle me-1"></i> Approve Booking
                        </button>
                    </form>
                    
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <i class="fas fa-times-circle me-1"></i> Reject Booking
                    </button>
                <?php elseif($booking->status === 'approved'): ?>
                    <form action="<?php echo e(route('admin.bookings.update-status', $booking)); ?>" method="POST" class="mb-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn btn-info w-100">
                            <i class="fas fa-flag-checkered me-1"></i> Mark as Completed
                        </button>
                    </form>
                    
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#cancelModal">
                        <i class="fas fa-ban me-1"></i> Cancel Booking
                    </button>
                <?php else: ?>
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle me-1"></i> 
                        This booking is <?php echo e(strtolower($booking->status)); ?> and cannot be modified further.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Reject Booking Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('admin.bookings.update-status', $booking)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <input type="hidden" name="status" value="rejected">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="notes" class="form-label">Rejection Reason</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" required></textarea>
                        <div class="form-text">
                            Please provide a reason for rejecting this booking. This will be visible to the customer.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel Booking Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('admin.bookings.update-status', $booking)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <input type="hidden" name="status" value="cancelled">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="notes" class="form-label">Cancellation Reason</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" required></textarea>
                        <div class="form-text">
                            Please provide a reason for cancelling this booking. This will be visible to the customer.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-danger">Cancel Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ece-rental\resources\views/admin/bookings/show.blade.php ENDPATH**/ ?>