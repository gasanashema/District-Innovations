<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marking extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function practice(){
        return $this->belongsTo(Practice::class);
    }
    public function criteria(){
        return $this->belongsTo(MarkingCriteria::class);
    }
}
