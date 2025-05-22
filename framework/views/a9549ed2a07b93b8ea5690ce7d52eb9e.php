<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Easy Car Enterprise - Online Car Rental</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            overflow-x: hidden;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1485291571150-772bcfc10da5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center;
            background-size: cover;
            height: 80vh;
            display: flex;
            align-items: center;
            color: white;
        }
        
        .feature-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        
        .car-type-card {
            overflow: hidden;
            border: none;
            border-radius: 10px;
            height: 100%;
        }
        
        .car-type-card img {
            transition: transform 0.3s ease;
        }
        
        .car-type-card:hover img {
            transform: scale(1.05);
        }
        
        .testimonial-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
            margin: 1rem 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .branch-card {
            height: 100%;
        }
        
        .footer {
            background-color: #343a40;
            color: white;
            padding: 3rem 0;
        }
        
        .footer a {
            color: #adb5bd;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo e(url('/')); ?>">Easy Car Enterprise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(Route::has('login')): ?>
                        <?php if(auth()->guard()->check()): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/dashboard')); ?>" class="nav-link">Dashboard</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('login')); ?>" class="nav-link">Log in</a>
                            </li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('register')); ?>" class="nav-link">Register</a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-4">Easy Car Rental For Your Journey</h1>
                    <p class="lead mb-4">Experience hassle-free car rentals with our wide selection of vehicles at competitive prices</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-primary btn-lg px-4 me-md-2">Go to Dashboard</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-lg px-4 me-md-2">Register Now</a>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-light btn-lg px-4">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Why Choose Easy Car Enterprise?</h2>
                <p class="text-muted">We offer the best car rental experience in Malaysia</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card p-4 text-center">
                        <div class="card-body">
                            <i class="fas fa-car feature-icon"></i>
                            <h5 class="card-title fw-bold">Wide Selection of Cars</h5>
                            <p class="card-text">Choose from our extensive fleet of vehicles to suit your needs and budget</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card p-4 text-center">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt feature-icon"></i>
                            <h5 class="card-title fw-bold">Multiple Branch Locations</h5>
                            <p class="card-text">Pick up your car from our convenient locations in Bangi, Shah Alam, and Gombak</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card p-4 text-center">
                        <div class="card-body">
                            <i class="fas fa-laptop feature-icon"></i>
                            <h5 class="card-title fw-bold">Easy Online Booking</h5>
                            <p class="card-text">Browse, select, and book your car online with our user-friendly system</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Car Types Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Our Car Types</h2>
                <p class="text-muted">We have a variety of cars to meet your needs</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card car-type-card">
                        <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Sedan">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Sedans</h5>
                            <p class="card-text">Comfortable and fuel-efficient cars for everyday use</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card car-type-card">
                        <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="SUV">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">SUVs</h5>
                            <p class="card-text">Spacious vehicles perfect for family trips and adventures</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card car-type-card">
                        <img src="https://images.unsplash.com/photo-1607853554439-0069ec0f29b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="MPV">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">MPVs</h5>
                            <p class="card-text">Multi-purpose vehicles with ample space for passengers and luggage</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branches Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Our Branches</h2>
                <p class="text-muted">Find us at these convenient locations</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card branch-card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Bandar Baru Bangi (Headquarters)</h5>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i> 123, Jalan Bangi Utama, Seksyen 8, 43650 Bandar Baru Bangi, Selangor
                            </p>
                            <p class="card-text">
                                <i class="fas fa-phone me-2 text-primary"></i> +60 3-1234 5678
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card branch-card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Shah Alam Branch</h5>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i> 45, Jalan Bunga Raya, Seksyen 14, 40000 Shah Alam, Selangor
                            </p>
                            <p class="card-text">
                                <i class="fas fa-phone me-2 text-primary"></i> +60 3-5678 1234
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card branch-card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Gombak Branch</h5>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i> 78, Jalan Gombak Indah, 53100 Gombak, Kuala Lumpur
                            </p>
                            <p class="card-text">
                                <i class="fas fa-phone me-2 text-primary"></i> +60 3-9876 5432
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold">Ready to Book Your Car?</h2>
                    <p class="lead mb-0">Register now and enjoy hassle-free car rentals with Easy Car Enterprise</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-light btn-lg">Go to Dashboard</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-light btn-lg">Register Now</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Easy Car Enterprise</h5>
                    <p>Your trusted partner for car rentals in Malaysia. We provide high-quality vehicles at competitive prices.</p>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="mb-2"><a href="<?php echo e(route('login')); ?>">Login</a></li>
                            <li class="mb-2"><a href="<?php echo e(route('register')); ?>">Register</a></li>
                        <?php else: ?>
                            <li class="mb-2"><a href="<?php echo e(url('/dashboard')); ?>">Dashboard</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Bandar Baru Bangi, Selangor</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +60 3-1234 5678</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@easycarenterprise.com</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-decoration-none"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fab fa-linkedin-in fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <?php echo e(date('Y')); ?> Easy Car Enterprise. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\ece-rental\resources\views/welcome.blade.php ENDPATH**/ ?>