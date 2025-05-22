<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Easy Car Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #ecf0f1;
            --dark-text: #2c3e50;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .brand-side {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 60px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .brand-side::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>') repeat;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-100px) translateY(-100px); }
        }

        .brand-logo {
            font-size: 3rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .brand-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }

        .car-icon {
            font-size: 4rem;
            opacity: 0.3;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .form-side {
            padding: 60px 40px;
        }

        .form-title {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .form-subtitle {
            color: #7f8c8d;
            text-align: center;
            margin-bottom: 40px;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating > .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            height: auto;
            transition: all 0.3s ease;
        }

        .form-floating > .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.15);
        }

        .form-floating > label {
            color: #7f8c8d;
            padding: 15px 20px;
        }

        .btn-login {
            background: linear-gradient(45deg, var(--secondary-color), #3498db);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
            color: white;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            background: white;
            padding: 0 20px;
            color: #7f8c8d;
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
        }

        .register-link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #7f8c8d;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            color: var(--secondary-color);
        }

        .remember-me {
            margin: 20px 0;
        }

        .form-check-input:checked {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .brand-side {
                padding: 40px 20px;
            }
            
            .form-side {
                padding: 40px 20px;
            }
            
            .brand-title {
                font-size: 2rem;
            }
            
            .form-title {
                font-size: 1.5rem;
            }
        }

        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card row g-0">
            <!-- Brand Side -->
            <div class="col-lg-6 brand-side">
                <div class="brand-logo">
                    <i class="fas fa-car"></i>
                </div>
                <h1 class="brand-title">Easy Car Enterprise</h1>
                <p class="brand-subtitle">Your trusted partner for convenient and reliable car rental services across Malaysia</p>
                <div class="mt-4">
                    <div class="d-flex justify-content-center gap-4 mb-3">
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                            <p class="mb-0 small">3 Branches</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-car fa-2x mb-2"></i>
                            <p class="mb-0 small">Quality Fleet</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-shield-alt fa-2x mb-2"></i>
                            <p class="mb-0 small">Trusted Service</p>
                        </div>
                    </div>
                </div>
                <i class="fas fa-car-side car-icon"></i>
            </div>
            
            <!-- Form Side -->
            <div class="col-lg-6 form-side">
                <h2 class="form-title">Welcome Back</h2>
                <p class="form-subtitle">Sign in to your account to continue</p>
                
                <!-- Laravel Session Status -->
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Laravel Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="name@example.com" required autofocus>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Password" required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center remember-me">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>
                        <div class="forgot-password">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                    </button>
                </form>
                
                <div class="divider">
                    <span>New to Easy Car Enterprise?</span>
                </div>
                
                <div class="register-link">
                    Don't have an account? <a href="{{ route('register') }}">Create Account</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>