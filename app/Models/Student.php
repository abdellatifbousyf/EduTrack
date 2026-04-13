<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    // الحقول المسموح تعبئتها
    protected $fillable = [
        'massar_code',
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'phone',
        'class_id',
        'user_id',  // 👈 مهم جداً
        'is_active',
    ];

    // 🔴 العلاقة مع User (واحد لواحد)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // العلاقة مع القسم
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    // العلاقة مع الغياب
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
