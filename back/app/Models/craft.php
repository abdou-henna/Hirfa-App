<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class craft extends Model
{
    use HasFactory;
    public $table = "crafts";
    protected $fillable = [
        'type',
    ];
    public function craftsmen(){
        return $this->hasMany('App\Models\craftsmen','id_crafts','id');
    }
    public function Project(){
        return $this->hasMany('App\Models\Project','id_crafts','id');
    }
}
