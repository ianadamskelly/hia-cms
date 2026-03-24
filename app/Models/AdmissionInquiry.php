<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionInquiry extends Model
{
    protected $fillable = [
        'parent_name',
        'student_name',
        'email',
        'phone',
        'programme_interest',
        'campus_interest',
        'message',
        'status',
        'notes',
    ];
}
