<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\User;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('student.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $input = trim($request->email);
        $student = null;

        // 🔹 المحاولة 1: البحث برقم مسار (بدون @student.ma)
        if (strpos($input, '@') === false) {
            $student = Student::where('massar_code', $input)->first();
        }

        // 🔹 المحاولة 2: البحث بالبريد الإلكتروني
        if (!$student && strpos($input, '@') !== false) {
            // أ) إما نلقاو المستخدم بالبريد ونشوفو واش عندو student مربوط بيه
            $user = User::where('email', $input)->first();
            if ($user && $user->student_id) {
                $student = Student::find($user->student_id);
            }

            // ب) أو نلقاو التلميذ اللي عندو user مربوط بيه وديك الـ user عندو هاد البريد
            if (!$student) {
                $student = Student::whereHas('user', function($q) use ($input) {
                    $q->where('email', $input);
                })->first();
            }
        }

        // إلا ملقيناش التلميذ
        if (!$student || !$student->user) {
            return back()->withErrors([
                'email' => 'رقم مسار أو كلمة المرور غير صحيحة',
            ])->onlyInput('email');
        }

        // جرب تسجيل الدخول
        $credentials = [
            'email' => $student->user->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/student/dashboard');
        }

        // محاولة أخيرة: تسجيل الدخول مباشر بـ User ID
        if (Hash::check($request->password, $student->user->password)) {
            Auth::login($student->user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended('/student/dashboard');
        }

        return back()->withErrors([
            'email' => 'رقم مسار أو كلمة المرور غير صحيحة',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        $student = auth()->user()->student;
        $attendances = $student ? $student->attendances()->latest()->take(10)->get() : collect([]);

        $totalDays = $attendances->count();
        $presentDays = $attendances->where('status', 'present')->count();
        $absentDays = $attendances->where('status', 'absent')->count();
        $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 0;

        return view('student.dashboard', compact(
            'student', 'attendances', 'attendanceRate', 'presentDays', 'absentDays'

        ));
        $student = auth()->user()->student;

    // جلب سجلات الغياب
    $attendances = $student ? $student->attendances()->latest()->take(10)->get() : collect([]);

    // الإحصائيات
    $totalDays = $attendances->count();
    $presentDays = $attendances->where('status', 'present')->count();
    $absentDays = $attendances->where('status', 'absent')->count();
    $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 0;

    // 🔴 جلب الحراسات والعقوبات
    $detentions = $student ?
        \App\Models\Detention::where('student_id', $student->id)
            ->where('status', 'pending')  // اللي مزال ما تخلصوش
            ->latest()
            ->get()
        : collect([]);

    // مجموع ساعات الحراسة
    $detentionHours = $detentions->sum('duration');

    return view('student.dashboard', compact(
        'student',
        'attendances',
        'attendanceRate',
        'presentDays',
        'absentDays',
        'detentions',      // 🔴 جديد
        'detentionHours'   // 🔴 جديد
    ));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/student/login');
    }
}
