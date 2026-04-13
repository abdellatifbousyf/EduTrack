<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - ثانوية مولاي رشيد</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0B1F3F;
            --secondary: #1A365D;
            --accent: #00D9A3;
            --light: #F8F9FA;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: #F0F4F8;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 20px 15px;
            z-index: 1000;
        }

        .sidebar-brand {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 25px;
        }

        .sidebar-brand i {
            font-size: 40px;
            color: var(--accent);
            margin-bottom: 10px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
        }

        .nav-item {
            margin: 5px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .nav-link i {
            margin-left: 10px;
            width: 20px;
        }

        .nav-link.active {
            background: var(--accent);
            color: var(--primary);
        }

        /* Main Content */
        .main-content {
            margin-right: 260px;
            padding: 25px;
        }

        /* Header */
        .header {
            background: white;
            border-radius: 12px;
            padding: 15px 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Stats Cards - عرض مناسب */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-info h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            margin: 0;
        }

        .stat-info p {
            color: #6C757D;
            font-size: 13px;
            margin: 5px 0 0 0;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-card.blue .stat-icon { background: rgba(26,54,93,0.1); color: var(--secondary); }
        .stat-card.green .stat-icon { background: rgba(0,217,163,0.1); color: var(--accent); }
        .stat-card.yellow .stat-icon { background: rgba(255,217,61,0.1); color: #D4A017; }

        /* Charts */
        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h4 {
            color: var(--primary);
            font-weight: 700;
            font-size: 16px;
            margin: 0;
        }

        /* Table */
        .table-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .table {
            margin: 0;
        }

        .table thead th {
            background: #F8F9FA;
            border: none;
            padding: 12px;
            font-weight: 700;
            color: var(--primary);
            font-size: 13px;
        }

        .table tbody td {
            padding: 12px;
            vertical-align: middle;
            border-color: #E9ECEF;
            font-size: 14px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success { background: rgba(0,217,163,0.15); color: var(--accent); }
        .badge-warning { background: rgba(255,217,61,0.15); color: #D4A017; }
        .badge-danger { background: rgba(255,107,107,0.15); color: #FF6B6B; }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-right: 0; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-school"></i>
            <h5 style="margin: 10px 0 5px 0; font-size: 16px;">ثانوية مولاي رشيد</h5>
            <p style="margin: 0; font-size: 12px; opacity: 0.8;">نظام إدارة الغياب</p>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/dashboard" class="nav-link active">
                    <i class="fas fa-th-large"></i>
                    <span>لوحة التحكم</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/students" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>إدارة التلاميذ</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-check"></i>
                    <span>تسجيل الغياب</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>التقارير</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>الإعدادات</span>
                </a>
            </li>
        </ul>

        <div style="position: absolute; bottom: 20px; right: 15px; left: 15px;">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn btn-danger w-100" style="border-radius: 8px;">
                    <i class="fas fa-sign-out-alt ms-2"></i> خروج
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <h4 style="margin: 0; color: var(--primary);">لوحة التحكم</h4>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <strong style="display: block; font-size: 14px;">المدير العام</strong>
                    <small style="color: #6C757D; font-size: 12px;">مؤسسة مولاي رشيد</small>
                </div>
                <div style="width: 40px; height: 40px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 700;">م</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-row">
            <div class="stat-card blue">
                <div class="stat-info">
                    <h3>34</h3>
                    <p>إجمالي التلاميذ</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>

            <div class="stat-card green">
                <div class="stat-info">
                    <h3>94.2%</h3>
                    <p>نسبة الحضور اليوم</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>

            <div class="stat-card yellow">
                <div class="stat-info">
                    <h3>12</h3>
                    <p>الغيابات اليوم</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-times"></i>
                </div>
            </div>

            <div class="stat-card blue">
                <div class="stat-info">
                    <h3>28</h3>
                    <p>الغيابات هذا الشهر</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="chart-card">
            <div class="chart-header">
                <h4>تحليل الغياب الأسبوعي</h4>
                <select class="form-select" style="width: auto;">
                    <option>هذا الأسبوع</option>
                    <option>الأسبوع الماضي</option>
                </select>
            </div>
            <canvas id="attendanceChart" height="80"></canvas>
        </div>

        <!-- Recent Activity Table -->
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 style="margin: 0; color: var(--primary); font-size: 16px;">آخر الغيابات المسجلة</h4>
                <button class="btn btn-primary btn-sm" style="background: var(--secondary); border: none; border-radius: 8px;">
                    <i class="fas fa-plus ms-1"></i> تسجيل غياب
                </button>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>التلميذ</th>
                            <th>القسم</th>
                            <th>التاريخ</th>
                            <th>الحالة</th>
                            <th>ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 35px; height: 35px; background: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px;">م.ط</div>
                                    <div>
                                        <strong style="display: block; font-size: 13px;">مريم الطاهري</strong>
                                        <small style="color: #6C757D; font-size: 11px;">D166067003</small>
                                    </div>
                                </div>
                            </td>
                            <td>TCSF-1</td>
                            <td>2024-04-12</td>
                            <td><span class="badge badge-danger">غائب</span></td>
                            <td>مرض</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 35px; height: 35px; background: #FFD93D; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 700; font-size: 12px;">ر.أ</div>
                                    <div>
                                        <strong style="display: block; font-size: 13px;">رضوان اوطالب</strong>
                                        <small style="color: #6C757D; font-size: 11px;">E160045521</small>
                                    </div>
                                </div>
                            </td>
                            <td>TCSF-1</td>
                            <td>2024-04-12</td>
                            <td><span class="badge badge-warning">متأخر</span></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 35px; height: 35px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 700; font-size: 12px;">خ.خ</div>
                                    <div>
                                        <strong style="display: block; font-size: 13px;">خديجة خلاوي</strong>
                                        <small style="color: #6C757D; font-size: 11px;">E161022755</small>
                                    </div>
                                </div>
                            </td>
                            <td>TCSF-1</td>
                            <td>2024-04-11</td>
                            <td><span class="badge badge-success">حاضر</span></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Attendance Chart
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['السبت', 'الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء'],
                datasets: [{
                    label: 'الحضور',
                    data: [32, 30, 31, 28, 22],
                    backgroundColor: '#00D9A3',
                    borderRadius: 6
                }, {
                    label: 'الغياب',
                    data: [2, 4, 3, 6, 12],
                    backgroundColor: '#FF6B6B',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                        rtl: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</body>
</html>
