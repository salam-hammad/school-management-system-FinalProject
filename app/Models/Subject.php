<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'grade_id', 'classroom_id', 'teacher_id'];


    // جلب اسم المراحل الدراسية

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    // جلب اسم الصفوف الدراسية
    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }

    // علاقة المادة بالمعلم المسؤول عنها
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // علاقة المادة مع الطلاب عبر `registrations`
    public function students()
    {
        return $this->belongsToMany(Student::class, 'registrations', 'subject_id', 'student_id')
            ->withPivot('teacher_id');
    }

    // علاقة الطالب بالمواد الدراسية
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'registrations', 'student_id', 'subject_id')
            ->withPivot('teacher_id');
    }

    // علاقة المادة مع الحصص الأونلاين
public function onlineClasses()
{
    return $this->hasMany(online_classe::class, 'subject_id');
}

}