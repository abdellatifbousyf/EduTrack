<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تغيير كلمة المرور - ثانوية مولاي رشيد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background: #f8f9fa; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .change-card { background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.1); padding: 40px; max-width: 500px; width: 100%; }
        .form-control { padding: 12px; border-radius: 10px; border: 2px solid #e0e0e0; }
        .form-control:focus { border-color: #0B1F3F; box-shadow: 0 0 0 3px rgba(11,31,63,0.1); }
        .btn-change { background: #0B1F3F; border: none; padding: 12px; border-radius: 10px; color: white; font-weight: 700; width: 100%; }
        .btn-change:hover { background: #1A365D; }
    </style>
</head>
<body>
    <div class="change-card">
        <h3 class="text-center mb-4">🔐 تغيير كلمة المرور</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('password.update.current') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">كلمة المرور الحالية</label>
                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">كلمة المرور الجديدة</label>
                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
                @error('new_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                <input type="password" class="form-control" name="new_password_confirmation" required>
            </div>

            <button type="submit" class="btn-change">
                <i class="fas fa-check ms-2"></i> تغيير كلمة المرور
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ url('/dashboard') }}" class="text-decoration-none">← العودة للوحة التحكم</a>
        </div>
    </div>
</body>
</html>
