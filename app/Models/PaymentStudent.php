<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStudent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id',
        'amount',
        'description',
        'date'
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
