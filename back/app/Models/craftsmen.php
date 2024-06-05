<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class craftsmen extends Model
{
    use HasFactory;
    public $table = "craftsmen";
    protected $fillable = [
        'firstName',
        'lastName',
        'password',
        'email',
        'phone',
        'craftsman_certificate',
        'price',
        'rating',
        'gender',
        'number_clients',
        'image',
        'place',
        'birth_date',
        'activate',
        'id_crafts'
    ];
    public function crafts(){
        return $this->belongsTo('App\Models\craft','id_crafts','id');
    }
    public function image_craftsmens(){
        return $this->hasMany('App\Models\image_craftsmen','id_craftsmen','id');
    }
    public function Project(){
        return $this->hasMany('App\Models\Project','id_craftsmen','id');
    }
    public function message(){
        return $this->hasMany('App\Models\message','id_craftsmen','id');
    }
    public function notification(){
        return $this->hasMany('App\Models\notification','id_craftsmen','id');
    }
    public function review(){
        return $this->hasMany('App\Models\review','id_craftsmen','id');
    }
}

