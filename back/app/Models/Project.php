<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    public $table = "projects";
    protected $fillable = [
        'title',
        'content',
        'date',
        'state',
        'id_crafts',
        'id_craftsmen',
        'id_user'
    ];
    public function craftsmen(){
        return $this->belongsTo('App\Models\craftsmen','id_craftsmen','id');
    }
    public function crafts(){
        return $this->belongsTo('App\Models\craft','id_crafts','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\user','id_user','id');
    }
    public function image_project(){
        return $this->hasMany('App\Models\image_project','id_project','id');
    }
}
