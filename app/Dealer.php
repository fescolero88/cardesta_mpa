<?php

namespace App;

use Malhal\Geographical\Geographical;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Dealer extends Model
{
    use SoftDeletes,Geographical;

    protected $fillable = [
        'dealer_id',
        'name',
        'phone',
        'email',
        'address',
        'state',
        'city',
        'fax',
        'website',
        'product_import',
    ];
    protected $table = 'dealer';
    protected $dates = ['deleted_at'];

    public function featuredproduct(){
        return $this->hasMany(Product::class,'dealer_id','dealer_id')->limit(8);
    }

    public function dealerproduct(){
        return $this->hasMany(Product::class,'dealer_id','dealer_id');
    }

}
