<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hisona Store | Sign In</title>
    <link rel="icon" href="<?= base_url('assets/img/store.jpg') ?>">
    
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Source Sans Pro', sans-serif;
            height: 100vh;
            display: flex;
            background: #ffffff;
        }
        
        /* LEFT SIDE - LOGIN FORM */
        .login-side {
            width: 45%;
            max-width: 520px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #ffffff;
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        
        .brand-section {
            margin-bottom: 40px;
        }
        
        .brand-logo {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
        }
        
        .brand-name {
            font-size: 28px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }
        
        .brand-subtitle {
            font-size: 15px;
            color: #64748b;
            font-weight: 400;
        }
        
        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            color: #991b1b;
            font-size: 14px;
            padding: 14px 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
        }
        
        .alert i {
            margin-right: 12px;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 8px;
        }
        
        .input-wrapper {
            display: flex;
            align-items: center;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            transition: all 0.2s ease;
        }
        
        .input-wrapper:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .input-icon {
            padding: 0 16px;
            color: #94a3b8;
            font-size: 16px;
        }
        
        .input-field {
            width: 100%;
            padding: 15px 16px 15px 0;
            border: none;
            background: transparent;
            font-size: 15px;
            color: #1e293b;
            outline: none;
        }
        
        .input-field::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 14px;
            color: #475569;
        }
        
        .remember-me input {
            margin-right: 10px;
            accent-color: #3b82f6;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .forgot-link {
            font-size: 14px;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .forgot-link:hover {
            color: #2563eb;
            text-decoration: underline;
        }
        
        .btn-signin {
            width: 100%;
            padding: 15px 20px;
            background: #1e293b;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        
        .btn-signin:hover {
            background: #0f172a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 41, 59, 0.2);
        }
        
        .btn-signin:active {
            transform: translateY(0);
            box-shadow: none;
        }
        
        .footer-note {
            text-align: center;
            font-size: 13px;
            color: #94a3b8;
        }
        
        .footer-note a {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
        }
        
        .footer-note a:hover {
            color: #1e293b;
        }
        
        /* RIGHT SIDE - IMAGE/BACKGROUND */
        .image-side {
            flex: 1;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            position: relative;
            overflow: hidden;
        }
        
        .image-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.85;
        }
        
        .overlay-content {
            position: absolute;
            bottom: 60px;
            left: 60px;
            right: 60px;
            color: white;
            z-index: 10;
        }
        
        .overlay-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .overlay-text {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
            max-width: 500px;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
        }
        
        .store-badge {
            position: absolute;
            top: 40px;
            right: 40px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            border-radius: 40px;
            color: white;
            font-weight: 500;
            font-size: 14px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 10;
        }
        
        .store-badge i {
            margin-right: 8px;
            color: #fbbf24;
        }
        
        /* Decorative elements */
        .dot-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            opacity: 0.1;
            background-image: radial-gradient(circle, #ffffff 2px, transparent 2px);
            background-size: 30px 30px;
            z-index: 5;
        }
        
        /* Mobile responsive */
        @media (max-width: 900px) {
            .image-side {
                display: none;
            }
            
            .login-side {
                width: 100%;
                max-width: 100%;
                padding: 24px;
            }
        }
        
        @media (max-width: 480px) {
            .login-side {
                padding: 20px;
            }
            
            .brand-name {
                font-size: 24px;
            }
            
            .overlay-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>


<div class="login-side">
    <div class="login-container">
        
        
        <div class="brand-section">
            <img src="<?= base_url('assets/img/store.jpg') ?>" alt="Hisona Store" class="brand-logo">
            <h1 class="brand-name">Welcome back!!</h1>
            <p class="brand-subtitle">Sign in to your Hisona Store account</p>
        </div>

      
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert" style="background: #f0fdf4; border-color: #bbf7d0; color: #166534;">
                <i class="fas fa-check-circle"></i>
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>


        <form action="<?= base_url('/auth') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label class="form-label">Username</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="username" class="input-field" placeholder="Enter your username" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="input-field" placeholder="Enter your password" required>
                </div>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="#" class="forgot-link">Forgot password?</a>
            </div>

            <button type="submit" class="btn-signin">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
        </form>

 
        <div class="footer-note">
            &copy; <?= date('Y') ?> Hisona Store. <a href="#">Privacy Policy</a>
        </div>

    </div>
</div>


<div class="image-side">
  
    <img style="opacity: 30%;" src="<?= base_url('assets/img/backround.jpg') ?>" alt="Store Background" onerror="this.style.display='none'">
    
   
    <div class="dot-pattern"></div>
    
  
    <div class="store-badge">
        <i class="fas fa-store"></i> HISONA STORE
    </div>
    
  
    <div class="overlay-content">
        <h2 class="overlay-title">Your One-Stop Shop</h2>
        <p class="overlay-text">
            Groceries, school supplies, and printing services — all in one convenient place. 
            Serving the community since 2016.
        </p>
    </div>
</div>


<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>