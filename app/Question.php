<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'test_id', 'question_number', 'question_type','subject','level','correct_answer','marks','negative',
    ];

    public function question() {
        return $this->belongsTo('App\Test');
    }
}
