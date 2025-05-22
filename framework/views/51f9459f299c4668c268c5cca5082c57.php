

<?php $__env->startSection('title', 'Car Management'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.cars.create')); ?>" class="btn btn-primary">
    <i class="fas fa-plus"></i> Add New Car
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Filter Cars</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.cars')); ?>" method="GET" class="row g-3">
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
            
            <!-- Brand Filter -->
            <div class="col-md-3">
                <label for="brand" class="form-label">Brand</label>
                <select class="form-select" id="brand" name="brand">
                    <option value="">All Brands</option>
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($b); ?>" <?php echo e(request('brand') == $b ? 'selected' : ''); ?>>
                            <?php echo e($b); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <!-- Type Filter -->
            <div class="col-md-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="">All Types</option>
                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t); ?>" <?php echo e(request('type') == $t ? 'selected' : ''); ?>>
                            <?php echo e(ucfirst($t)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <!-- Transmission Filter -->
            <div class="col-md-3">
                <label for="transmission" class="form-label">Transmission</label>
                <select class="form-select" id="transmission" name="transmission">
                    <option value="">All Transmissions</option>
                    <?php $__currentLoopData = $transmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t); ?>" <?php echo e(request('transmission') == $t ? 'selected' : ''); ?>>
                            <?php echo e(ucfirst($t)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Apply Filters
                </button>
                <a href="<?php echo e(route('admin.cars')); ?>" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Car Inventory</h5>
        <span class="badge bg-primary"><?php echo e($cars->total()); ?> Cars</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Car Details</th>
                        <th>Branch</th>
                        <th>Daily Rate</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($car->id); ?></td>
                            <td>
                                <?php if($car->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $car->image)); ?>" alt="<?php echo e($car->brand); ?> <?php echo e($car->model); ?>" 
                                        class="img-thumbnail" style="max-width: 80px;">
                                <?php else: ?>
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                        style="width: 80px; height: 60px;">
                                        <i class="fas fa-car"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?php echo e($car->brand); ?> <?php echo e($car->model); ?></strong><br>
                                <small class="text-muted"><?php echo e($car->year); ?> • <?php echo e(ucfirst($car->type)); ?> • <?php echo e(ucfirst($car->transmission)); ?></small><br>
                                <small class="text-muted">Plate: <?php echo e($car->plate_number); ?></small>
                            </td>
                            <td><?php echo e($car->branch->name); ?> (<?php echo e($car->branch->location); ?>)</td>
                            <td>RM <?php echo e(number_format($car->daily_rate, 2)); ?></td>
                            <td>
                                <?php if($car->available): ?>
                                    <span class="badge bg-success">Available</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Unavailable</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('admin.cars.edit', $car->id)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="modal" data-bs-target="#deleteCarModal-<?php echo e($car->id); ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteCarModal-<?php echo e($car->id); ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete the car: <strong><?php echo e($car->brand); ?> <?php echo e($car->model); ?></strong>?</p>
                                                <p class="text-danger"><small>This action cannot be undone and will remove all related data.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="<?php echo e(route('admin.cars.delete', $car->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">No cars found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        <?php echo e($cars->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ece-rental\resources\views/admin/cars/index.blade.php ENDPATH**/ ?>