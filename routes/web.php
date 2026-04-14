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
// Password Reset Routes
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Illuminate\Support\Facades\Password::sendResetLink(
        $request->only('email')
    );

    return $status === Illuminate\Support\Facades\Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Illuminate\Http\Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Illuminate\Support\Facades\Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, string $password) {
            $user->forceFill([
                'password' => Illuminate\Support\Facades\Hash::make($password)
            ])->setRememberToken(Illuminate\Support\Str::random(60));

            $user->save();
        }
    );

    return $status === Illuminate\Support\Facades\Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
