<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - {{ $student->first_name }} {{ $student->last_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: #f8f9fa;
        }
        .sidebar {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
            padding: 30px 20px;
        }
        .sidebar .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 40px;
            color: #667eea;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 10px;
            margin: 5px 0;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .main-content {
            padding: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }
        .stat-icon.orange { background: #fff3e0; color: #ff9800; }
        .stat-icon.pink { background: #fce4ec; color: #e91e63; }
        .stat-icon.green { background: #e8f5e9; color: #4caf50; }
        .stat-number {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .stat-label {
            color: #6c757d;
            font-size: 14px;
        }
        .welcome-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .attendance-table {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .badge-present { background: #4caf50; color: white; padding: 5px 15px; border-radius: 20px; }
        .badge-absent { background: #f44336; color: white; padding: 5px 15px; border-radius: 20px; }
        .badge-late { background: #ff9800; color: white; padding: 5px 15px; border-radius: 20px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="profile-img">
                    <i class="fas fa-user"></i>
                </div>
                <h5 class="text-center mb-1">{{ $student->first_name }} {{ $student->last_name }}</h5>
                <p class="text-center text-white-50 mb-4">{{ $student->class->name ?? 'بدون قسم' }}</p>

                <nav class="nav flex-column">
                    <a class="nav-link active" href="#"><i class="fas fa-home ms-2"></i> الرئيسية</a>
                    <a class="nav-link" href="#"><i class="fas fa-calendar-check ms-2"></i> حضوري</a>
                    <a class="nav-link" href="#"><i class="fas fa-chart-bar ms-2"></i> نتائجي</a>
                    <a class="nav-link" href="{{ route('student.logout') }}"><i class="fas fa-sign-out-alt ms-2"></i> خروج</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Welcome Banner -->
                <div class="welcome-banner">
                    <h2>مرحباً {{ $student->first_name }}! 👋</h2>
                    <p>هنا يمكنك متابعة حضورك ونتائجك الدراسية</p>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="stat-card">
                            <div>
                                <div class="stat-number">{{ $attendanceRate }}%</div>
                                <div class="stat-label">نسبة الحضور</div>
                            </div>
                            <div class="stat-icon orange">
                                <i class="fas fa-percentage"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="stat-card">
                            <div>
                                <div class="stat-number">{{ $presentDays }}</div>
                                <div class="stat-label">أيام الحضور</div>
                            </div>
                            <div class="stat-icon green">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="stat-card">
                            <div>
                                <div class="stat-number">{{ $absentDays }}</div>
                                <div class="stat-label">أيام الغياب</div>
                            </div>
                            <div class="stat-icon pink">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance History -->
                <div class="attendance-table">
                    <h4 class="mb-4"><i class="fas fa-history ms-2"></i>سجل الغياب الأخير</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                    <th>ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->date->format('Y-m-d') }}</td>
                                    <td>
                                        @if($attendance->status == 'present')
                                            <span class="badge-present">حاضر</span>
                                        @elseif($attendance->status == 'absent')
                                            <span class="badge-absent">غائب</span>
                                        @else
                                            <span class="badge-late">متأخر</span>
                                        @endif
                                    </td>
                                    <td>{{ $attendance->notes ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
