<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Bidan Care</title>
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            /* Warna Baru dari gambar */
            --primary-color: #2f3a7e;
            /* Biru navy tua */
            --secondary-color: #fceaec;
            /* Pink pucat */
            --accent-color: #e4bcc4;
            /* Pink pastel */
            --light-blue: #bddad9;
            /* Biru muda pastel */
            --peach-color: #e79e8e;
            /* Peach */
            --dark-pink: #cf7a78;
            /* Merah muda agak gelap */
            --coral-color: #d7867b;
            /* Coral */
            --text-dark: #2C3E50;
            --text-light: #6C757D;
            --bg-gradient: linear-gradient(135deg, var(--light-blue) 0%, var(--secondary-color) 100%);
            --card-shadow: 0 10px 30px rgba(47, 60, 126, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.6;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            margin: 20px;
            min-height: 600px;
        }

        .login-left {
            padding: 50px 40px;
            background: linear-gradient(145deg, #ffffff 0%, var(--secondary-color) 100%);
            position: relative;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--dark-pink), var(--peach-color));
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), #3c498a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(47, 60, 126, 0.2);
        }

        .logo-icon i {
            font-size: 40px;
            color: white;
        }

        .app-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .app-subtitle {
            color: var(--text-light);
            font-size: 16px;
            margin-bottom: 40px;
        }

        .form-floating {
            margin-bottom: 25px;
        }

        .form-floating>.form-control {
            height: 60px;
            border: 2px solid #E5E5E5;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-floating>.form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(47, 60, 126, 0.15);
        }

        .form-floating>label {
            color: var(--text-light);
            font-weight: 500;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), #3c498a);
            border: none;
            height: 55px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(47, 60, 126, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(47, 60, 126, 0.4);
        }

        .btn-register {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-register:hover {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
        }

        .login-right {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            position: relative;
            overflow: hidden;
        }

        .illustration {
            text-align: center;
            color: white;
            z-index: 2;
            position: relative;
        }

        .illustration-icon {
            font-size: 120px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .illustration h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .illustration p {
            font-size: 18px;
            opacity: 0.9;
            line-height: 1.8;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            font-size: 60px;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            right: 15%;
            font-size: 40px;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 20%;
            font-size: 50px;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-left: 4px solid var(--coral-color);
        }

        .alert-danger {
            background: var(--secondary-color);
            color: var(--dark-pink);
        }

        .feature-points {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #E5E5E5;
        }

        .feature-point {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: var(--text-light);
        }

        .feature-point i {
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .login-container {
                margin: 10px;
            }

            .login-left {
                padding: 30px 25px;
            }

            .app-title {
                font-size: 26px;
            }

            .logo-icon {
                width: 60px;
                height: 60px;
            }

            .logo-icon i {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="row h-100 g-0">
            <!-- Left Side - Login Form -->
            <div class="col-lg-5 col-12">
                <div class="login-left h-100 d-flex flex-column justify-content-center">
                    <div class="logo-section">
                        <div class="logo-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <h1 class="app-title">Bidan Care</h1>
                        <p class="app-subtitle">Menghubungkan Bidan dan Pasien untuk Layanan Kebidanan Terbaik</p>
                    </div>

                    @error('login')
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        {{ $message }}
                    </div>
                    @enderror

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-floating">
                            <input type="email"
                                class="form-control @error('login') is-invalid @enderror"
                                id="email"
                                name="login"
                                placeholder="name@example.com"
                                value="{{ old('login') }}"
                                required>
                            <label for="email">
                                <i class="bi bi-envelope me-2"></i>Email
                            </label>
                        </div>

                        <div class="form-floating">
                            <input type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Password"
                                required>
                            <label for="password">
                                <i class="bi bi-lock me-2"></i>Kata Sandi
                            </label>
                        </div>

                        <button type="submit" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk ke Akun
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-3">Belum memiliki akun?</p>
                        <a href="{{ route('register') }}" class="btn-register">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </a>
                    </div>

                    <div class="feature-points">
                        <div class="feature-point">
                            <i class="bi bi-shield-check"></i>
                            <span>Platform terpercaya dan aman</span>
                        </div>
                        <div class="feature-point">
                            <i class="bi bi-clock"></i>
                            <span>Layanan 24/7</span>
                        </div>
                        <div class="feature-point">
                            <i class="bi bi-people"></i>
                            <span>Bidan profesional dan berpengalaman</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Illustration -->
            <div class="col-lg-7 d-none d-lg-block">
                <div class="login-right h-100">
                    <div class="floating-elements">
                        <div class="floating-element">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <div class="floating-element">
                            <i class="bi bi-shield-plus"></i>
                        </div>
                        <div class="floating-element">
                            <i class="bi bi-bandaid"></i>
                        </div>
                    </div>

                    <div class="illustration">
                        <div class="illustration-icon">
                            <i class="bi bi-person-hearts"></i>
                        </div>
                        <h3>Selamat Datang di Bidan Care</h3>
                        <p>
                            Platform digital yang menghubungkan ibu hamil dan keluarga
                            dengan bidan profesional untuk mendapatkan layanan kebidanan
                            berkualitas tinggi kapan saja dan di mana saja.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>