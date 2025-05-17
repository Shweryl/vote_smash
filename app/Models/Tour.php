<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'question',
        'tour_date',
        'tour_time',
        'cover_image',
        'video_link',
        'live_event_link',
        'user_id'
    ];

    protected $with = ['mvcs','user'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function mvcs()
    {
        return $this->hasManyThrough(Mvc::class, MatchInfo::class);
    }
}
