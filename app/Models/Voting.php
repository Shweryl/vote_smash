<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $fillable = [
        'mvc_id',
        'user_id',
        'comment'
    ];

    public function mvc(){
        return $this->belongsTo(Mvc::class);
    }
}
