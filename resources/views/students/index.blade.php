<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لائحة التلاميذ</title>
    <!-- Bootstrap باش نزيو الجدول -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .header { background: #0d6efd; color: white; padding: 20px; text-align: center; border-radius: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="header">
            <h1> ثانوية مولاي رشيد التأهيلية</h1>
            <h3>لائحة التلاميذ</h3>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>رقم مسار</th>
                            <th>الاسم الكامل</th>
                            <th>القسم</th>
                            <th>الجنس</th>
                            <th>تاريخ الازدياد</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->massar_code }}</td>
                                <td>{{ $student->last_name }} {{ $student->first_name }}</td>
                                <!-- عرض اسم القسم -->
                                <td>{{ $student->class ? $student->class->name : 'بدون قسم' }}</td>
                                <td>{{ $student->gender === 'male' ? 'ذكر' : 'أنثى' }}</td>
                                <td>{{ $student->birth_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-3">
            <p>عدد التلاميذ: {{ $students->count() }}</p>
        </div>
    </div>
</body>
</html>
