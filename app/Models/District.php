<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'province_id'
    ];

    public function districts(){
        return $this->belongsTo('App\Province');
    }
    public function user(){
        return $this->HasMany(User::class);
    }

    public function practice(){
        return $this->hasMany(Practice::class);
    }
}
