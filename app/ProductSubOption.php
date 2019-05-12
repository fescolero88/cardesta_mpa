<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubOption extends Model
{
    protected $fillable = [
        'product_id',
        'product_options_cat_id',
        'product_options_type_id',
        'product_options_sub_type_id',
        'value'
    ];



}
