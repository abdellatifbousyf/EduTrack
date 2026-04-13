<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentAuthController extends Controller
{
    // 1. عرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('student.login');
    }

    // 2. معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // البحث عن التلميذ برقم مسار أو بريد
        $student = Student::where('massar_code', $request->email)
                         ->orWhereHas('user', function($q) use ($request) {
                             $q->where('email', $request->email);
                         })->first();

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

    // 3. لوحة تحكم التلميذ
    public function dashboard()
    {
        $student = auth()->user()->student;
        $attendances = $student->attendances()->latest()->take(10)->get();

        $totalDays = $student->attendances()->count();
        $presentDays = $student->attendances()->where('status', 'present')->count();
        $absentDays = $student->attendances()->where('status', 'absent')->count();
        $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 0;

        return view('student.dashboard', compact(
            'student', 'attendances', 'attendanceRate', 'presentDays', 'absentDays'
        ));
    }

    // 4. تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/student/login');
    }
}
