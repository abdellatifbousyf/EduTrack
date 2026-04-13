<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\User;

class StudentAuthController extends Controller
{
    // عرض صفحة الدخول
    public function showLoginForm()
    {
        return view('student.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // 🔴 طريقة البحث البسيطة:
        // 1. إما نلقاو التلميذ برقم مسار
        $student = Student::where('massar_code', $request->email)->first();

        // 2. إما نلقاو المستخدم بالبريد الإلكتروني ونشوفو واش عندو طالب مربوط بيه
        if (!$student) {
            $user = User::where('email', $request->email)->first();
            if ($user && $user->student_id) {
                $student = $user->student;
            }
        }

        // إلا لقينا التلميذ وحاولنا تسجيل الدخول
        if ($student && $student->user) {
            if (Auth::attempt([
                'email' => $student->user->email,
                'password' => $request->password
            ], $request->boolean('remember'))) {

                $request->session()->regenerate();
                return redirect()->intended('/student/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'رقم مسار أو كلمة المرور غير صحيحة',
        ])->onlyInput('email');
    }

    // لوحة تحكم التلميذ
    public function dashboard()
    {
        $student = auth()->user()->student;

        // إلا ماكانش عندو سجلات غياب، نرجعو قائمة فاضية
        $attendances = $student ? $student->attendances()->latest()->take(10)->get() : collect([]);

        $totalDays = $attendances->count();
        $presentDays = $attendances->where('status', 'present')->count();
        $absentDays = $attendances->where('status', 'absent')->count();
        $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 0;

        return view('student.dashboard', compact(
            'student', 'attendances', 'attendanceRate', 'presentDays', 'absentDays'
        ));
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/student/login');
    }
}
