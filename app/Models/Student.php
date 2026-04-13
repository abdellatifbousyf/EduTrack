<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassRoom; //ضروري باش يعرفـ ClassRoom

class Student extends Model
{
    // الحقول المسموح يملأها
    protected $fillable = [
        'massar_code', 'first_name', 'last_name', 'birth_date',
        'gender', 'phone', 'class_id', 'is_active'
    ];

    // 🔴 هاد الدالة هي اللي كتعريف العلاقة مع القسم
    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
}
