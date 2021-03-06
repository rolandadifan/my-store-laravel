<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'photo', 'slug'
    ];

    protected $hidden = [];
}
