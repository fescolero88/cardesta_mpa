<?php

namespace App;

use App\ProductImage;
use App\ProductOption;
use Malhal\Geographical\Geographical;
use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Rememberable,Geographical;
    protected $fillable = ['latitude','longitude','image_import',"dealer_id","features_import","type","stock","vin","year","make","model","body","trim","modelnumber","doors","exteriorcolor","interiorcolor","enginecylinders","enginedisplacement","transmission","miles","sellingprice","msrp","bookvalue","invoice","certified","dateinstock","description","dealer_address","dealer_city","dealer_state","dealer_zip","dealer_phone","dealer_fax","special_field1","special_field2","special_field3","special_field4","style_description","ext_color_generic","ext_color_code","int_color_generic","int_color_code","int_upholstery","engine_block_type","engine_aspiration_type","engine_description","transmission_speed","transmission_description","drivetrain","fuel_type","citympg","highwaympg","epaclassification","wheelbase_code","internet_price","misc_price1","misc_price2","misc_price3","factory_codes","marketclass","passengercapacity","extcolorhexcode","intcolorhexcode","enginedisplacementcubicinches"];

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }


    public function ProductOption()
    {
        return $this->hasMany(ProductOption::class,'product_id');
    }



    public function dealer(){
        return $this->hasOne(Dealer::class,'dealer_id','dealer_id');
    }

}
