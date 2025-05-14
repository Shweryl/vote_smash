<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_text',
        'tour_id',
        'options',
    ];

    public function getOptionsAttribute($value)
    {
        return json_decode($value, true);
    }
}
