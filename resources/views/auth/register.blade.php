<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد - ثانوية مولاي رشيد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .register-card { background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); padding: 40px; max-width: 450px; width: 100%; }
        .form-control { padding: 12px; border-radius: 10px; border: 2px solid #e0e0e0; }
        .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .btn-register { background: linear-gradient(135deg, #667eea, #764ba2); border: none; padding: 12px; border-radius: 10px; color: white; font-weight: 700; width: 100%; }
        .btn-register:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4); }
        .back-link { color: #667eea; text-decoration: none; margin-top: 20px; display: inline-block; }
    </style>
</head>
<body>
    <div class="register-card">
        <h3 class="text-center mb-4">📝 إنشاء حساب جديد</h3>

        <form method="POST" action="{{ route('register.process') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">الاسم الكامل</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">كلمة المرور</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">تأكيد كلمة المرور</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus ms-2"></i> إنشاء الحساب
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="back-link">
                <i class="fas fa-arrow-right ms-2"></i>
                العودة إلى تسجيل الدخول
            </a>
        </div>
    </div>
</body>
</html>
