<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lname',
        'fname',
        'title',
        'phone',
        'email',
        'password',
        'type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'type' => UserTypeCast::class, // Use the custom cast for the 'type' attribute
    ];

    public function practices(){
        return $this->HasMany(Practice::class);
    }
    public function answers(){
        return $this->HasMany(Answer::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    
}

class UserTypeCast implements \Illuminate\Contracts\Database\Eloquent\CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return ["user", "admin", "evaluator"][$value] ?? null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        // You can define the logic for setting the attribute here if needed
        return $value;
    }
}
