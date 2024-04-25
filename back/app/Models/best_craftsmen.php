<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class best_craftsmen extends Model
{
    use HasFactory;
    public $table = "best_craftsmens";
    protected $fillable = [
        'id_craftsmen',
    ];
}
