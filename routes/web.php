<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    // 🔴 Routes ديال تغيير كلمة المرور للمدير (وهو مسجل)
    // عرض صفحة التغيير
    Route::get('/change-password', function () {
        return view('auth.change-password');
    })->name('password.change');

    // معالجة التغيير
    Route::put('/change-password', function (Request $request) {
        // 1. تحقق من كلمة السر القديمة
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        // 2. تحقق من أن الجديدة متطابقة
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        // 3. بدّل كلمة السر
        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        // 4. 🔴 سجّل الخروج وودي لـ صفحة login
        Auth::logout();

        return redirect()->route('login')->with('success', '✅ تم تغيير كلمة المرور بنجاح! سجل دخولك بالكلمة الجديدة');
    })->name('password.update.current');
});

// ==========================================
// 🔵 مسارات التلميذ (منفصلة)
// ==========================================

Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.post');
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentAuthController::class, 'dashboard'])->name('student.dashboard');
});

// ==========================================
// 🟡 Password Reset Routes (للزوار فقط)
// ==========================================

Route::middleware('guest')->group(function () {

    // عرض صفحة "نسيت كلمة المرور"
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    // إرسال رابط الاستعادة
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    // عرض صفحة إعادة التعيين
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    // معالجة إعادة التعيين
    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');
});
// 🔴 Routes ديال التسجيل (للمدير/الأستاذ)
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Illuminate\Support\Facades\Hash::make($request->password),
        'role' => 'teacher', // أو 'admin' حسب الحاجة
    ]);

    \Illuminate\Support\Facades\Auth::login($user);

    return redirect()->route('dashboard')->with('success', '✅ تم إنشاء الحساب بنجاح!');
})->middleware('guest')->name('register.process');

