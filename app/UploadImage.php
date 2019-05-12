<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    protected $table = "feactured_cars";
    protected $fillable = ['title','image','description'];
}
