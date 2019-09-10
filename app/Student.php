<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'coaching_id', 'student_tag','roll_no','notification',
    ];
}
