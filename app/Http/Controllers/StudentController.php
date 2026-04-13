<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentAuthController extends Controller
{
    /**
     * عرض صفحة تسجيل دخول التلميذ
     */
    public function showLoginForm()
    {
        return view('student.login');
    }

    /**
     * معالجة تسجيل دخول التلميذ
     */
    public function login(Request $request)
    {
        // 1. التحقق من البيانات
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // 2. البحث عن التلميذ بـ رقم مسار أو بريد إلكتروني
        $student = Student::where('massar_code', $request->email)
                         ->orWhereHas('user', function($query) use ($request) {
                             $query->where('email', $request->email);
                         })
                         ->first();

        // 3. إذا وجد التلميذ وحاولنا تسجيل الدخول
        if ($student && $student->user) {
            if (Auth::attempt([
                'email' => $student->user->email,
                'password' => $request->password
            ], $request->boolean('remember'))) {

                $request->session()->regenerate();

                // 🔴 توجيه التلميذ للوحة التحكم الخاصة به
                return redirect()->intended('/student/dashboard');
            }
        }

        // 4. إذا فشل الدخول
        return back()->withErrors([
            'email' => 'رقم مسار أو كلمة المرور غير صحيحة',
        ])->onlyInput('email');
    }

    /**
     * لوحة تحكم التلميذ
     */
    public function dashboard()
    {
        $student = auth()->user()->student;

        // جلب آخر 10 سجلات غياب
        $attendances = $student->attendances()->latest()->take(10)->get();

        // إحصائيات بسيطة
        $totalDays = $student->attendances()->count();
        $presentDays = $student->attendances()->where('status', 'present')->count();
        $absentDays = $student->attendances()->where('status', 'absent')->count();
        $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 0;

        return view('student.dashboard', compact(
            'student', 'attendances', 'attendanceRate', 'presentDays', 'absentDays'
        ));
    }

    /**
     * تسجيل خروج التلميذ
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/student/login');
    }
}
