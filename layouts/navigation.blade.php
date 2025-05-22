<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="fw-bold text-primary">Easy Car Enterprise</span>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @auth
                    <li class="nav-item">
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                            <!-- Admin/Staff users get admin dashboard -->
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        @else
                            <!-- Regular customers get regular dashboard -->
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cars.*') ? 'active' : '' }}" href="{{ route('cars.index') }}">
                            <i class="fas fa-car me-1"></i> Browse Cars
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">
                            <i class="fas fa-calendar-alt me-1"></i> My Bookings
                        </a>
                    </li>
                    
                    <!-- Admin-specific navigation items -->
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-shield me-1"></i> Admin Panel
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('admin.cars*') ? 'active' : '' }}" href="{{ route('admin.cars') }}">
                                        <i class="fas fa-car me-2"></i> Manage Cars
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('admin.bookings*') ? 'active' : '' }}" href="{{ route('admin.bookings') }}">
                                        <i class="fas fa-calendar-check me-2"></i> Manage Bookings
                                    </a>
                                </li>
                                @if(auth()->user()->role === 'admin')
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('admin.staff*') ? 'active' : '' }}" href="{{ route('admin.staff') }}">
                                        <i class="fas fa-users me-2"></i> Manage Staff
                                    </a>
                                </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('cars.index') }}">
                                        <i class="fas fa-eye me-2"></i> View as Customer
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <!-- User Info with Role Badge -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle me-2"></i>
                                <div>
                                    <div>{{ Auth::user()->name }}</div>
                                    <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <div class="dropdown-header">
                                <div class="fw-bold">{{ Auth::user()->name }}</div>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                                @if(Auth::user()->role !== 'customer')
                                    <span class="badge bg-primary mt-1">{{ ucfirst(Auth::user()->role) }}</span>
                                    @if(Auth::user()->branch)
                                        <br><small class="text-muted">{{ Auth::user()->branch->location }}</small>
                                    @endif
                                @endif
                            </div>
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-edit me-2"></i> {{ __('Profile') }}
                            </a>
                            
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard
                                </a>
                            @endif
                            
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
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
</style>