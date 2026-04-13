<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\AcademicYear; // 🔴 ضروري
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run()
    {
        // 1️⃣ أولاً: أنشئ السنة الدراسية إذا ماكانتش موجودة
        $academicYear = AcademicYear::firstOrCreate(
            ['name' => '2024-2025'], // البحث بـ name
            [
                'start_date' => '2024-09-01',
                'end_date' => '2025-06-30',
                'is_active' => true
            ]
        );

        // 2️⃣ ثانياً: أنشئ الأقسام وربطهم بالسنة اللي فوق
        $classes = [
            ['name' => 'TCSF-1', 'level' => '1bac', 'filier' => 'علوم'],
            ['name' => 'TCSF-2', 'level' => '1bac', 'filier' => 'علوم'],
            ['name' => 'TCSF-3', 'level' => '1bac', 'filier' => 'علوم'],
            ['name' => 'TCSF-4', 'level' => '1bac', 'filier' => 'علوم'],
        ];

        foreach ($classes as $classData) {
            ClassRoom::updateOrCreate(
                ['name' => $classData['name']],
                [
                    'level' => $classData['level'],
                    'filier' => $classData['filier'],
                    'academic_year_id' => $academicYear->id // 🔴 ربط بالسنة الصحيحة
                ]
            );
        }

        $this->command->info('✅ تم إضافة الأقسام بنجاح!');
    }
}
