<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OptionType;
use App\OptionSubType;
use App\Product;
use App\OptionTypeCategory;

class ProductOption extends Model
{
    protected $fillable = [
        'product_id',
        'product_options_cat_id',
        'product_options_type_id',
        'value'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
        //return $this->belongsTo(Product::class,'product_id');
    }

    public function option()
    {
        return $this->hasOne(OptionType::class,'id','product_options_type_id');
    }

    public function category()
    {
        return $this->hasOne(OptionTypeCategory::class,'id','product_options_cat_id');
    }

    public function subOptions()
    {
        return $this->belongsTo(OptionSubType::class,'product_options_type_id','option_type_id');
    }
}
