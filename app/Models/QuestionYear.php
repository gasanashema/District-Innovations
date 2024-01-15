<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class QuestionYear extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'year_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    // this function makes a relationship between timeframe and question_years table
    public function year()
    {
        return $this->belongsTo(Timeframe::class);
    }
}

