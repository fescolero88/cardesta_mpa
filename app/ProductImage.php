<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "products_image";
    protected $fillable = ['product_id','image','active'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
