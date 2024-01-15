<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    public function practice(){
        return $this->belongsTo(Practice::class);
    }
    public function districtStaff(){
        return $this->belongsTo(User::class);
    }
}
