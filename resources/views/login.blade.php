<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - PPDB TK Mardi Tama</title>
    <link href="{{ asset('assets/img/logoTk.png') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
        }
        .login-bg {
            background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.75), rgba(30, 58, 138, 0.8)), url('{{ asset("assets/img/pendaftaran.jpg") }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            border-radius: 1.5rem;
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }
        .login-header-bg {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-bottom: 1px solid #bfdbfe;
        }
        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #64748b;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .close-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
            transform: rotate(90deg);
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            border-color: #3b82f6;
        }
    </style>
</head>
<body>
    <div class="login-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-6 col-lg-4">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3 rounded-3 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3 rounded-3 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card login-card">
                        <!-- Tombol Close Posisi Absolute (Atas Kanan) -->
                        <a href="{{ route('Dashboard') }}" class="close-btn" title="Kembali ke Beranda">
                            <i class="bi bi-x-lg"></i>
                        </a>

                        <!-- Header Logo -->
                        <div class="login-header-bg text-center p-4">
                            <img src="{{ asset('assets/img/logoTk.png') }}" style="max-height: 60px;" alt="Logo TK Mardi Tama">
                        </div>

                        <!-- Form Content -->
                        <div class="p-4 pt-3">
                            <div class="text-center mb-4">
                                <h5 class="fw-bold text-dark m-0">Login Administrator</h5>
                                <p class="text-muted small m-0">Masukkan kredensial akun admin Anda</p>
                            </div>

                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control border-start-0 bg-light py-2 text-dark font-semibold" id="username" name="username" placeholder="Masukkan username" required autofocus>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control border-start-0 bg-light py-2 text-dark font-semibold" id="password" name="password" placeholder="Masukkan password" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold shadow-sm flex items-center justify-center gap-2">
                                    <i class="bi bi-box-arrow-in-right"></i> Masuk Sekarang
                                </button>
                            </form>

                            <div class="mt-4 p-3 bg-light rounded-3 text-center border">
                                <small class="text-muted d-block mb-1 font-semibold" style="font-size: 11px;">Akun Admin Default:</small>
                                <code class="d-block text-dark fw-bold" style="font-size: 12px;">Username: Rizky Ariyan | Password: password</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
