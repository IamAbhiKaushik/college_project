<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'get_result','test_name', 'pdf', 'excel','livetime','duration','exam_code','coach_id','tag','solution,','type','difficulty','max_marks','avg','public_exam','topics'
    ];

    public function test()
    {
        return $this->belongsTo('App\User');
    }

    public function questions() {
        return $this->hasMany('App\Question');
    }
}
