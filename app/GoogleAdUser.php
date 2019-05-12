<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleAdUser extends Model
{
    protected $table = 'googleaduser';

    public function dealer(){
        return $this->hasOne(Dealer::class,'dealer_slug','dealer_slug');
    }
}
