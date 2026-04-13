<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول التلميذ - ثانوية مولاي رشيد</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0B1F3F;
            --secondary: #1A365D;
            --accent: #00D9A3;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
        }

        .login-form {
            padding: 50px;
            width: 50%;
        }

        .school-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .school-logo i {
            font-size: 60px;
            color: #667eea;
        }

        .welcome-text h2 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 26px;
        }

        .welcome-text p {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
        }

        .form-control {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-image {
            width: 50%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px;
            color: white;
        }

        .student-icon {
            font-size: 100px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .motto {
            text-align: center;
            margin-bottom: 30px;
        }

        .motto h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .motto p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.8;
        }

        .stats {
            display: flex;
            gap: 15px;
        }

        .stat-box {
            background: rgba(255,255,255,0.2);
            padding: 15px 25px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .stat-box h4 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-box p {
            font-size: 12px;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .login-image {
                display: none;
            }
            .login-form {
                width: 100%;
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- الجانب الأيمن: فورم تسجيل الدخول -->
        <div class="login-form">
            <div class="school-logo">
                <i class="fas fa-user-graduate"></i>
            </div>

            <div class="welcome-text">
                <h2>بوابة التلميذ</h2>
                <p>ثانوية مولاي رشيد التأهيلية<br>سجل دخولك لمتابعة دراستك</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ url('/student/login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> البريد الإلكتروني أو رقم مسار
                    </label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text"
                               class="form-control"
                               id="email"
                               name="email"
                               placeholder="D166067003 أو البريد الإلكتروني"
                               value="{{ old('email') }}"
                               required
                               autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> كلمة المرور
                    </label>
                    <div class="input-group">
                        <i class="fas fa-key"></i>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               placeholder="••••••••"
                               required>
                    </div>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>تذكرني</span>
                    </label>
                    <a href="#" class="forgot-password">نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                </button>
            </form>

            <div class="back-link">
                <p>أنت أستاذ أو مدير؟ <a href="{{ url('/login') }}">دخول الموظفين</a></p>
            </div>
        </div>

        <!-- الجانب الأيسر: الصورة والمعلومات -->
        <div class="login-image">
            <div class="student-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>

            <div class="motto">
                <h3>مسارك التعليمي بين يديك</h3>
                <p>تابع حضورك، نتائجك، وجدولك الدراسي<br>بكل سهولة ويسر</p>
            </div>

            <div class="stats">
                <div class="stat-box">
                    <h4>34</h4>
                    <p>تلميذ</p>
                </div>
                <div class="stat-box">
                    <h4>4</h4>
                    <p>أقسام</p>
                </div>
                <div class="stat-box">
                    <h4>98%</h4>
                    <p>نسبة النجاح</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
