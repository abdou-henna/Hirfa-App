<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class image_craftsmen extends Model
{
    use HasFactory;
    public $table = "image_craftsmens";
    protected $fillable = [
        'url',
        'id_craftsmen',
    ];
    public function craftsmen(){
        return $this->belongsTo('App\Models\craftsmen','id_craftsmen','id');
    }
}
