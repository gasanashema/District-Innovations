<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeframe extends Model
{
    use HasFactory;
   

    public function questionYears()
    {
        return $this->hasMany(QuestionYear::class);
    }
    public function categoryYears()
    {
        return $this->hasMany(CategoryYear::class);
    }
}
