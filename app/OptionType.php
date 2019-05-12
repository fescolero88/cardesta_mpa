<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionType extends Model
{
    protected $fillable = [
        'option_cat_id',
        'name',
        'slug'
    ];

    protected $table = 'options_types';

    public function category()
    {
        return $this->hasOne(OptionTypeCategory::class,'id');
    }

}
