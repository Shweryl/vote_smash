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

    protected $with = ['match1Answers','mvcs', 'user'];

    public function match1Answers(){
        return $this->hasMany(Match1Answers::class,'match_info_id');
    }

    public function mvcs(){
        return $this->hasMany(Mvc::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
