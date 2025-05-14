<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchInfo extends Model
{
    protected $fillable = [
        'tour_id',
        'user_id',
        'start_time',
    ];

    protected $with = ['match1Answers'];

    public function match1Answers(){
        return $this->hasMany(Match1Answers::class);
    }
}
