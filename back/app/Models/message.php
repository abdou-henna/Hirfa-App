<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class message extends Model
{
    use HasFactory;
    public $table = "messages";
    protected $fillable = [
        'body',
        'time',
        'id_user',
        'id_craftsmen'
    ];
    public function User(){
        return $this->belongsTo('App\Models\User','id_user','id');
    }
    public function craftsmen(){
        return $this->belongsTo('App\Models\craftsmen','id_craftsmen','id');
    }
}
