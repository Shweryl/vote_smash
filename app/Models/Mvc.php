<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mvc extends Model
{
    protected $fillable = [
        'MVC',
        'confidence_rating',
        'match_info_id',
        'user_id',
    ];

    protected $with = ['user','votes'];

    public function matchInfo(){
        return $this->belongsTo(MatchInfo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function votes(){
        return $this->hasMany(Voting::class);
    }
}
