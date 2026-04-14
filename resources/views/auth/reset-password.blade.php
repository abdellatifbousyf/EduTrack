<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور - ثانوية مولاي رشيد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .reset-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            max-width: 450px;
            width: 100%;
            text-align: center;
        }
        .reset-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 32px;
        }
        .form-control {
            padding: 12px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-reset {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 12px;
            border-radius: 10px;
            color: white;
            font-weight: 700;
            width: 100%;
        }
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="reset-card">
        <div class="reset-icon">
            <i class="fas fa-lock"></i>
        </div>
        <h3>إعادة تعيين كلمة المرور</h3>
        <p class="text-muted mb-4">أدخل كلمة المرور الجديدة</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       placeholder="البريد الإلكتروني"
                       value="{{ old('email') }}"
                       required
                       autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       placeholder="كلمة المرور الجديدة"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password"
                       class="form-control"
                       name="password_confirmation"
                       placeholder="تأكيد كلمة المرور"
                       required>
            </div>

            <button type="submit" class="btn btn-reset">
                <i class="fas fa-check ms-2"></i>
                تغيير كلمة المرور
            </button>
        </form>
    </div>
</body>
</html>
