<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <span class="fw-bold text-primary">Easy Car Enterprise</span>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item">
                        <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff'): ?>
                            <!-- Admin/Staff users get admin dashboard -->
                            <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        <?php else: ?>
                            <!-- Regular customers get regular dashboard -->
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('cars.*') ? 'active' : ''); ?>" href="<?php echo e(route('cars.index')); ?>">
                            <i class="fas fa-car me-1"></i> Browse Cars
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('bookings.*') ? 'active' : ''); ?>" href="<?php echo e(route('bookings.index')); ?>">
                            <i class="fas fa-calendar-alt me-1"></i> My Bookings
                        </a>
                    </li>
                    
                    <!-- Admin-specific navigation items -->
                    <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-shield me-1"></i> Admin Panel
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li>
                                    <a class="dropdown-item <?php echo e(request()->routeIs('admin.cars*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.cars')); ?>">
                                        <i class="fas fa-car me-2"></i> Manage Cars
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php echo e(request()->routeIs('admin.bookings*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.bookings')); ?>">
                                        <i class="fas fa-calendar-check me-2"></i> Manage Bookings
                                    </a>
                                </li>
                                <?php if(auth()->user()->role === 'admin'): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item <?php echo e(request()->routeIs('admin.staff*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.staff')); ?>">
                                        <i class="fas fa-users me-2"></i> Manage Staff
                                    </a>
                                </li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('cars.index')); ?>">
                                        <i class="fas fa-eye me-2"></i> View as Customer
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                    <?php if(Route::has('login')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(Route::has('register')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- User Info with Role Badge -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle me-2"></i>
                                <div>
                                    <div><?php echo e(Auth::user()->name); ?></div>
                                    <small class="text-muted"><?php echo e(ucfirst(Auth::user()->role)); ?></small>
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <div class="dropdown-header">
                                <div class="fw-bold"><?php echo e(Auth::user()->name); ?></div>
                                <small class="text-muted"><?php echo e(Auth::user()->email); ?></small>
                                <?php if(Auth::user()->role !== 'customer'): ?>
                                    <span class="badge bg-primary mt-1"><?php echo e(ucfirst(Auth::user()->role)); ?></span>
                                    <?php if(Auth::user()->branch): ?>
                                        <br><small class="text-muted"><?php echo e(Auth::user()->branch->location); ?></small>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">
                                <i class="fas fa-user-edit me-2"></i> <?php echo e(__('Profile')); ?>

                            </a>
                            
                            <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff'): ?>
                                <a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard
                                </a>
                            <?php endif; ?>
                            
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> <?php echo e(__('Logout')); ?>

                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Enhanced navigation styling */
.navbar-nav .nav-link.active {
    color: #3498db !important;
    font-weight: 600;
}

.dropdown-item.active {
    background-color: #e3f2fd;
    color: #1976d2;
}

.dropdown-header {
    padding: 0.75rem 1rem;
    background: #f8f9fa;
}

.badge {
    font-size: 0.7rem;
}

.nav-link:hover {
    color: #3498db !important;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.text-primary {
    color: #3498db !important;
}

@media (max-width: 768px) {
    .dropdown-header div {
        font-size: 0.9rem;
    }
}
</style><?php /**PATH C:\xampp\htdocs\ece-rental\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>