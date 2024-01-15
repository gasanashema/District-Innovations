<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'population',
        'start_date',
        'end_date',
        'district_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
    public function questions(){
        return $this->belongsTo(Question::class);
    }
    public function files(){
        return $this->hasMany(Files::class);
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
    public function marks()
    {
        return $this->hasMany(Marking::class);
    }
}
