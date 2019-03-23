<?php

if (!function_exists("money_format")) {
    function money_format($format,$amount)
    {
        return number_format( $amount, 2, ",", "." );
    }
 }
 
 function remote_asset($file,$env = false)
 {
    if(\App::environment() == 'production')
    {
        $env = true;
        //return env('CDN_URL').$file;
    }

    return asset($file,$env);    
 }

 function makeslug($item,$type){

    if(empty($item)){
        return "car-dealer-solution-".$type;
    }
    else{
        return str_slug($item);
    }
 }