<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class image_project extends Model
{
    use HasFactory;
    public $table = "image_projects";
    protected $fillable = [
        'url',
        'id_project',
    ];
    public function Project(){
        return $this->belongsTo('App\Models\Project','id_project','id');
    }
}
