<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;

// ==========================================
// 🔴 الصفحة الرئيسية = تسجيل دخول المدير
// ==========================================

// 1. الصفحة الرئيسية كتعرض فورم الدخول
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// 2. معالجة تسجيل دخول المدير
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        // 🔴 هنا كيردو لـ لوحة تحكم المدير
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
    ])->onlyInput('email');
})->name('login.process');

// 3. لوحة تحكم المدير (محمية)
Route::middleware(['auth'])->group(function () {

    // ✅ صفحة المدير الرئيسية
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // صفحة التلاميذ
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');

    // خروج المدير
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

// ==========================================
// 🔵 مسارات التلميذ (منفصلة)
// // ==========================================

// Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
// Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.post');
// Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');
// // مسارات التلميذ
Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentAuthController::class, 'dashboard'])->name('student.dashboard');
});
