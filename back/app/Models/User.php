<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = "users";
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'username',
        'phone',
        'gender',
        'birthDate',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function message(){
        return $this->hasMany('App\Models\message','id_user','id');
    }
    public function review(){
        return $this->hasMany('App\Models\review','id_user','id');
    }
    public function Project(){
        return $this->hasMany('App\Models\Project','id_user','id');
    }
}
