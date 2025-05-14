<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match1Answers extends Model
{
    protected $fillable = [
        'match_info_id' ,
        'question_id',
        'user_answer',
    ];

    protected $with = ['question'];

    public function question(){
        return $this->belongsTo(Question::class);
    }

}
