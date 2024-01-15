<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryYear extends Model
{
    use HasFactory;
    protected $fillable = ['questioncategory_id', 'timeframe_id'];

    public function category()
    {
        return $this->belongsTo(Questioncategory::class,'questioncategory_id');
    }
    // this function makes a relationship between timeframe and question_years table
    public function timeframe()
    {
        return $this->belongsTo(Timeframe::class);
    }
}
