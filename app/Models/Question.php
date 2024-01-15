<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'details',
        'instructions',
        'questioncategory_id',
        'status',

    ];

    public function category(){
        return $this->belongsTo(Questioncategory::class,'questioncategory_id');
    }

    public function questionYears()
    {
        return $this->hasMany(QuestionYear::class);
    }
}
