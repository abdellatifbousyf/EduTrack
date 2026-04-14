<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - ثانوية مولاي رشيد التأهيلية</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root { --primary-dark: #0B1F3F; --primary-blue: #1A365D; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Cairo', sans-serif; background: #f8f9fa; overflow-x: hidden; }

        .top-nav { background: #fff; padding: 12px 0; box-shadow: 0 2px 8px rgba(0,0,0,0.06); position: relative; z-index: 100; }
        .brand { font-weight: 700; color: var(--primary-dark); text-decoration: none; font-size: 1.1rem; }
        .nav-links a { color: #444; text-decoration: none; margin-left: 18px; font-size: 0.9rem; }
        .btn-apply { background: var(--primary-dark); color: #fff; padding: 7px 22px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 0.85rem; }

        .login-wrapper { display: flex; min-height: 100vh; }
        .image-panel { flex: 1.3; position: relative; overflow: hidden; min-height: 100vh; background: var(--primary-dark); }
        .school-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; }
        .image-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(11,31,63,0.92) 0%, rgba(11,31,63,0.35) 100%); z-index: 2; }
        .image-content { position: relative; z-index: 3; height: 100%; padding: 60px; display: flex; flex-direction: column; justify-content: flex-end; color: #fff; }
        .hero-title { font-size: 2.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 15px; }
        .hero-desc { font-size: 1.05rem; opacity: 0.9; margin-bottom: 35px; max-width: 85%; line-height: 1.7; }

        .stats-row { display: flex; gap: 15px; margin-bottom: 30px; }
        .stat-card { background: rgba(255,255,255,0.12); backdrop-filter: blur(6px); border: 1px solid rgba(255,255,255,0.2); padding: 14px 22px; border-radius: 12px; text-align: center; }
        .stat-num { display: block; font-size: 1.7rem; font-weight: 800; }
        .stat-lbl { font-size: 0.85rem; opacity: 0.9; }

        .footer-links { margin-top: auto; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.2); font-size: 0.8rem; opacity: 0.85; }
        .footer-links a { color: #fff; text-decoration: none; margin-left: 12px; }

        .form-panel { flex: 1; background: #fff; display: flex; align-items: center; justify-content: center; padding: 40px; }
        .login-card { width: 100%; max-width: 400px; }
        .form-header h3 { color: var(--primary-dark); font-weight: 700; margin-bottom: 5px; }
        .form-header p { color: #6c757d; font-size: 0.95rem; margin-bottom: 25px; }
        .form-control { border: 1.5px solid #e9ecef; border-radius: 10px; padding: 12px; background: #f8f9fa; font-size: 0.95rem; }
        .form-control:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 4px rgba(26,54,93,0.1); background: #fff; }
        .btn-login { width: 100%; background: var(--primary-dark); color: #fff; border: none; padding: 13px; border-radius: 10px; font-weight: 700; font-size: 1rem; margin-top: 10px; transition: 0.3s; }
        .btn-login:hover { background: var(--primary-blue); transform: translateY(-2px); }
        .form-options { display: flex; justify-content: space-between; align-items: center; margin: 18px 0; font-size: 0.9rem; }
        .forgot-link { color: var(--primary-blue); text-decoration: none; font-weight: 600; }
        .register-text { text-align: center; margin-top: 25px; font-size: 0.9rem; color: #666; }
        .register-text a { color: var(--primary-dark); font-weight: 700; text-decoration: none; }

        @media (max-width: 992px) { .image-panel { display: none; } .form-panel { width: 100%; padding: 30px 20px; } .nav-links { display: none; } }
    </style>
</head>
<body>
    <nav class="top-nav">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="#" class="brand"><i class="fas fa-school me-2"></i> مؤسسة مولاي رشيد التأهيلية</a>
            <div class="nav-links d-none d-md-block">
                <a href="#">الرئيسية</a><a href="#">من نحن</a><a href="#">البرامج</a><a href="#">تواصل معنا</a>
            </div>
            <a href="#" class="btn-apply">طلب تقديم</a>
        </div>
    </nav>

    <div class="login-wrapper">
        <!-- 🔹 الجانب الأيسر: الصورة + النصوص -->
        <div class="image-panel">
            <img src="{{ asset('images/school.jpg') }}" alt="صورة الثانوية" class="school-img">
            <div class="image-overlay"></div>
            <div class="image-content">
                <h1 class="hero-title">تراث عميق،<br>مستقبل مبدع.</h1>
                <p class="hero-desc">تلتزم ثانوية مولاي رشيد التأهيلية بتقديم تعليم متميز يجمع بين أصالة القيم المغربية وتفكيرها العلمي العالي لتشجيع جيل من القادة القادرين على صنع الفرق.</p>
                <div class="stats-row">
                    <div class="stat-card"><span class="stat-num">89.8%</span><span class="stat-lbl">نسبة النجاح</span></div>
                    <div class="stat-card"><span class="stat-num">+45</span><span class="stat-lbl">سنة خبرة</span></div>
                    <div class="stat-card"><span class="stat-num">+50</span><span class="stat-lbl">شريك مؤسسي</span></div>
                </div>
                <div class="footer-links">
                    <a href="#">Accessibility</a><a href="#">Terms of Service</a><a href="#">Privacy Policy</a>
                    <span class="ms-3">© 2026 Moulay Rachid Institution</span>
                </div>
            </div>
        </div>

        <!-- 🔹 الجانب الأيمن: فورم الدخول -->
        <div class="form-panel">
            <div class="login-card">
                <div class="form-header">
                    <h3>تسجيل الدخول</h3>
                    <p>مرحباً بك مجدداً في مؤسستك التربوية</p>
                </div>

                @if(session('error')) <div class="alert alert-danger py-2">{{ session('error') }}</div> @endif
                @if(session('success')) <div class="alert alert-success py-2">{{ session('success') }}</div> @endif

                <!-- ✅ الفورم كيوجه لـ /login (المسار الصحيح) -->
                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="admin@school.ma" required autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember">
                            <label class="form-check-label">تذكرني</label>
                        </div>
                        <a href="{{ route('password.change') }}" class="forgot-link">نسيت كلمة المرور؟</a>
                    </div>

                    <button type="submit" class="btn-login">تسجيل الدخول</button>
                </form>

                <!-- ✅ رابط إنشاء حساب جديد -->
                <div class="register-text">
                    <small>ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب جديد</a></small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
