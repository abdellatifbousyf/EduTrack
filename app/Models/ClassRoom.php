<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    // يربط بالجدول الصحيح
    protected $table = 'classes';

    protected $fillable = ['name', 'level', 'filier', 'academic_year_id'];
}
