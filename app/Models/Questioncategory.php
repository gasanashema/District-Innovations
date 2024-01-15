<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questioncategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
    ];
    
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function criteria()
    {
        return $this->hasMany(MarkingCriteria::class);
    }
    public function categoryYears()
    {
        return $this->hasMany(CategoryYear::class);
    }
}
