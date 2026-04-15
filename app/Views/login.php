<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hisona Store | Sign In</title>
    <link rel="icon" href="<?= base_url('assets/img/store.jpg') ?>">
    
    <!-- Fonts & CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
    
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-page {
            background: transparent;
        }
        
        .login-box {
            width: 400px;
        }
        
        .login-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .login-card-body {
            padding: 35px 30px;
        }
        
        .brand-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .brand-logo img {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .brand-name {
            font-size: 24px;
            font-weight: 400;
            color: #2d3748;
            margin: 12px 0 5px;
            letter-spacing: 2px;
        }
        
        .brand-subtitle {
            font-size: 13px;
            color: #a0aec0;
            font-weight: 300;
            margin-bottom: 25px;
        }
        
        .input-group {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .input-group .form-control {
            border: 1px solid #e2e8f0;
            border-right: none;
            padding: 12px 16px;
            font-size: 14px;
            background: #fafbfc;
        }
        
        .input-group .form-control:focus {
            border-color: #cbd5e0;
            background: #ffffff;
            box-shadow: none;
        }
        
        .input-group-append .input-group-text {
            background: #fafbfc;
            border: 1px solid #e2e8f0;
            border-left: none;
            color: #a0aec0;
            padding: 0 16px;
        }
        
        .btn-signin {
            background: #4a5568;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            color: white;
            transition: all 0.2s ease;
            width: 100%;
        }
        
        .btn-signin:hover {
            background: #2d3748;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(74, 85, 104, 0.2);
        }
        
        .icheck-primary label {
            color: #718096;
            font-weight: 400;
            font-size: 14px;
        }
        
        .alert {
            border: none;
            border-radius: 10px;
            background: #fed7d7;
            color: #9b2c2c;
            font-size: 13px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
        
        .footer-note {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #a0aec0;
        }
        
        .footer-note a {
            color: #718096;
            text-decoration: none;
        }
        
        .footer-note a:hover {
            color: #4a5568;
        }
    </style>
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="card login-card">
        <div class="card-body login-card-body">
            
            <!-- Brand Logo & Title -->
            <div class="brand-logo">
                <img src="<?= base_url('assets/img/store.jpg') ?>" alt="Hisona Store Logo">
                <h1 class="brand-name">HISONA STORE</h1>
                <p class="brand-subtitle">Sign in to continue</p>
            </div>

            <!-- Error Message -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= base_url('/auth') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                    </div>
                    <div class="col-5 text-right">
                        <a href="#" class="text-muted small">Forgot?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-signin">
                    <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                </button>
            </form>

            <!-- Footer -->
            <div class="footer-note">
                &copy; <?= date('Y') ?> Hisona Store. All rights reserved.
            </div>

        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js') ?>"></script>

<script>
    // Simple focus effect
    $(document).ready(function() {
        $('.form-control').on('focus', function() {
            $(this).closest('.input-group').css('box-shadow', '0 0 0 3px rgba(74, 85, 104, 0.1)');
        }).on('blur', function() {
            $(this).closest('.input-group').css('box-shadow', 'none');
        });
    });
</script>

</body>
</html>