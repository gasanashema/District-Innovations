<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkingCriteria extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Questioncategory::class,'questioncategory_id');
    }
}
