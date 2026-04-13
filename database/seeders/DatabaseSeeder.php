<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;
use App\Models\AcademicYear;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. إنشاء سنة دراسية
        $academicYear = AcademicYear::firstOrCreate(
            ['name' => '2024-2025'],
            [
                'start_date' => '2024-09-01',
                'end_date' => '2025-06-30',
                'is_active' => true
            ]
        );

        // 2. إنشاء الأقسام
        $classes = [
            ['name' => 'TCSF-1', 'level' => '1bac', 'filier' => 'علوم'],
            ['name' => 'TCSF-2', 'level' => '1bac', 'filier' => 'علوم'],
            ['name' => 'TCSF-3', 'level' => '1bac', 'filier' => 'علوم'],
            ['name' => 'TCSF-4', 'level' => '1bac', 'filier' => 'علوم'],
            ['name' => '2BAC-SH-1', 'level' => '2bac', 'filier' => 'علوم'],
            ['name' => '2BAC-SH-2', 'level' => '2bac', 'filier' => 'علوم'],
        ];

        foreach ($classes as $classData) {
            ClassRoom::firstOrCreate(
                ['name' => $classData['name']],
                [
                    'level' => $classData['level'],
                    'filier' => $classData['filier'],
                    'academic_year_id' => $academicYear->id
                ]
            );
        }

        // 3. تشغيل Seeders الأخرى
        $this->call([
            StudentsSeeder::class,
        ]);
    }
}
