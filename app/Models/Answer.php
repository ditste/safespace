<?php

namespace App\Models;
use App\Models\Question;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }
}
