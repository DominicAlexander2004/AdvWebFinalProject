<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Easy Car Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --light-bg: #ecf0f1;
            --dark-text: #2c3e50;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }

        .brand-side {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
            min-height: 600px;
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            font-size: 3.5rem;
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

        .features-list {
            list-style: none;
            padding: 0;
            position: relative;
            z-index: 2;
        }

        .features-list li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 0.9rem;
        }

        .features-list li:last-child {
            border-bottom: none;
        }

        .features-list i {
            margin-right: 10px;
            width: 20px;
        }

        .form-side {
            padding: 40px;
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
            margin-bottom: 30px;
        }

        .form-floating {
            margin-bottom: 15px;
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

        .form-floating > .form-control.is-valid {
            border-color: var(--success-color);
        }

        .form-floating > .form-control.is-invalid {
            border-color: var(--accent-color);
        }

        .form-floating > label {
            color: #7f8c8d;
            padding: 15px 20px;
        }

        .btn-register {
            background: linear-gradient(45deg, var(--success-color), #2ecc71);
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
            color: white;
        }

        .btn-register:disabled {
            opacity: 0.6;
            transform: none;
            box-shadow: none;
        }

        .password-strength {
            margin-top: 5px;
            font-size: 0.8rem;
        }

        .strength-weak { color: var(--accent-color); }
        .strength-medium { color: #f39c12; }
        .strength-strong { color: var(--success-color); }

        .form-check-input:checked {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #7f8c8d;
        }

        .login-link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .progress {
            height: 4px;
            border-radius: 2px;
            margin-top: 5px;
        }

        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            color: #c0392b;
        }

        @media (max-width: 768px) {
            .brand-side {
                padding: 30px 20px;
                min-height: auto;
            }
            
            .form-side {
                padding: 30px 20px;
            }
            
            .brand-title {
                font-size: 2rem;
            }
            
            .form-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card row g-0">
            <!-- Brand Side -->
            <div class="col-lg-5 brand-side">
                <div class="brand-logo">
                    <i class="fas fa-car"></i>
                </div>
                <h1 class="brand-title">Join ECE Today</h1>
                <p class="brand-subtitle">Create your account and start your journey with Malaysia's trusted car rental service</p>
                
                <ul class="features-list">
                    <li><i class="fas fa-check-circle"></i>Easy online booking system</li>
                    <li><i class="fas fa-map-marker-alt"></i>3 convenient locations</li>
                    <li><i class="fas fa-car"></i>Wide range of quality vehicles</li>
                    <li><i class="fas fa-clock"></i>24/7 customer support</li>
                    <li><i class="fas fa-shield-alt"></i>Secure and trusted service</li>
                    <li><i class="fas fa-money-bill-wave"></i>Competitive pricing</li>
                </ul>
            </div>
            
            <!-- Form Side -->
            <div class="col-lg-7 form-side">
                <h2 class="form-title">Create Account</h2>
                <p class="form-subtitle">Fill in your details to get started</p>
                
                <!-- Laravel Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="Full Name" required autofocus>
                        <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="name@example.com" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Password" required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                        <div class="password-strength" id="passwordStrength"></div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" id="strengthBar" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Confirm Password" required>
                        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                    </div>
                    
                    <button type="submit" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                </form>
                
                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthText = document.getElementById('passwordStrength');
            const strengthBar = document.getElementById('strengthBar');
            
            let strength = 0;
            let feedback = '';
            
            if (password.length >= 8) strength += 25;
            if (/[a-z]/.test(password)) strength += 25;
            if (/[A-Z]/.test(password)) strength += 25;
            if (/[\d\W]/.test(password)) strength += 25;
            
            strengthBar.style.width = strength + '%';
            
            if (strength < 50) {
                strengthBar.className = 'progress-bar bg-danger';
                feedback = 'Weak password';
                strengthText.className = 'password-strength strength-weak';
            } else if (strength < 75) {
                strengthBar.className = 'progress-bar bg-warning';
                feedback = 'Medium strength';
                strengthText.className = 'password-strength strength-medium';
            } else {
                strengthBar.className = 'progress-bar bg-success';
                feedback = 'Strong password';
                strengthText.className = 'password-strength strength-strong';
            }
            
            strengthText.textContent = feedback;
        });
    </script>
</body>
</html>