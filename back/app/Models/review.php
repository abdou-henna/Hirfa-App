<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class review extends Model
{
    use HasFactory;
    public $table = "reviews";
    protected $fillable = [
        'rating',
        'comment',
        'date',
        'id_craftsmen',
        'id_user'
    ];
    public function craftsmen(){
        return $this->belongsTo('App\Models\craftsmen','id_craftsmen','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\user','id_user','id');
    }
}
