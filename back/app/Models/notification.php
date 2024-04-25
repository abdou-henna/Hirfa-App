<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class notification extends Model
{
    use HasFactory;
    public $table = "notifications";
    protected $fillable = [
        'id_craftsmen',
        'body',
    ];
    public function craftsmen(){
        return $this->belongsTo('App\Models\craftsmen','id_craftsmen','id');
    }
}
