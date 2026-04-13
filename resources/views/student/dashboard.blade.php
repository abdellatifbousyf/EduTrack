<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - {{ $student->first_name }} {{ $student->last_name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --accent: #00D9A3;
            --light: #F8F9FA;
            --dark: #2D3748;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: white;
            padding: 30px 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .user-profile {
            text-align: center;
            padding-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            margin-bottom: 30px;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 32px;
            font-weight: 700;
        }

        .user-name {
            font-weight: 700;
            font-size: 16px;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .user-class {
            color: #666;
            font-size: 14px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
        }

        .nav-item {
            margin: 8px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #666;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .nav-link i {
            margin-left: 10px;
            width: 20px;
        }

        .logout-btn {
            position: absolute;
            bottom: 30px;
            left: 20px;
            right: 20px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .header {
            background: white;
            border-radius: 15px;
            padding: 20px 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .header h2 {
            margin: 0;
            color: var(--dark);
            font-size: 24px;
        }

        /* Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-info h3 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-info p {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 14px;
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

        .stat-card.orange .stat-icon { background: #fff3e0; color: #ff9800; }
        .stat-card.pink .stat-icon { background: #fce4ec; color: #e91e63; }
        .stat-card.green .stat-icon { background: #e8f5e9; color: #4caf50; }

        /* Welcome Section */
        .welcome-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .welcome-banner {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .welcome-text h4 {
            margin: 0 0 10px 0;
            font-size: 20px;
        }

        .welcome-text p {
            margin: 0;
            opacity: 0.9;
        }

        .welcome-icon {
            font-size: 48px;
            opacity: 0.8;
        }

        /* School Image Section */
        .school-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: center;
        }

        .school-image {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .school-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .info-text {
            padding: 20px;
        }

        .info-text h5 {
            color: var(--dark);
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info-text p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                right: -280px;
                height: 100vh;
                z-index: 1000;
                transition: right 0.3s;
            }
            .sidebar.active {
                right: 0;
            }
            .main-content {
                padding: 20px;
            }
            .school-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr($student->first_name, 0, 1) }}
                </div>
                <div class="user-name">{{ $student->first_name }} {{ $student->last_name }}</div>
                <div class="user-class">{{ $student->class->name ?? 'بدون قسم' }}</div>
            </div>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="/student/dashboard" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span>الرئيسية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-check"></i>
                        <span>حضوري</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <span>نتائجي</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span>موادي الدراسية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>الإعدادات</span>
                    </a>
                </li>
            </ul>

            <div class="logout-btn">
                <form method="POST" action="{{ url('/student/logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-sign-out-alt ms-2"></i> تسجيل الخروج
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <h2>لوحة التحكم</h2>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end">
                        <strong style="display: block; font-size: 14px;">{{ $student->first_name }} {{ $student->last_name }}</strong>
                        <small style="color: #666; font-size: 12px;">تلميذ</small>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card orange">
                    <div class="stat-info">
                        <h3>{{ $attendanceRate }}%</h3>
                        <p>نسبة الحضور</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                </div>

                <div class="stat-card green">
                    <div class="stat-info">
                        <h3>{{ $presentDays }}</h3>
                        <p>أيام الحضور</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>

                <div class="stat-card pink">
                    <div class="stat-info">
                        <h3>{{ $absentDays }}</h3>
                        <p>أيام الغياب</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="welcome-banner">
                    <div class="welcome-text">
                        <h4>مرحباً بك يا {{ $student->first_name }}! 👋</h4>
                        <p>هنا يمكنك متابعة حضورك ونتائجك الدراسية</p>
                    </div>
                    <div class="welcome-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>

                <!-- School Info -->
                <div class="school-section">
                    <div class="info-text">
                        <h5>ثانوية مولاي رشيد التأهيلية</h5>
                        <p>
                            تلتزم ثانوية مولاي رشيد التأهيلية بتقديم تعليم متميز يجمع بين أصالة القيم المغربية وتفكيرها العلمي العالي.
                        </p>
                        <p>
                            نسعى لتشجيع جيل من القادة القادرين على صنع الفرق والمساهمة في بناء المستقبل.
                        </p>
                        <button class="btn btn-primary">
                            <i class="fas fa-info-circle ms-2"></i>
                            المزيد من المعلومات
                        </button>
                    </div>
                    <div class="school-image">
                        <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=600&h=400&fit=crop" alt="المؤسسة">
                    </div>
                </div>
            </div>

            <!-- Recent Attendance -->
            @if($attendances->count() > 0)
            <div class="welcome-section">
                <h5 style="margin-bottom: 20px; color: var(--dark);">
                    <i class="fas fa-history ms-2"></i>
                    آخر سجلات الغياب
                </h5>
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
                                        <span class="badge bg-success">حاضر</span>
                                    @elseif($attendance->status == 'absent')
                                        <span class="badge bg-danger">غائب</span>
                                    @else
                                        <span class="badge bg-warning">متأخر</span>
                                    @endif
                                </td>
                                <td>{{ $attendance->notes ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
