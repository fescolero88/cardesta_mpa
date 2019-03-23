<?php

namespace App\Helpers;

use Config;
use Mail;

class BasicHelper {

    /**
     * Get URL for Product object.
     *
     * @param string $slug
     * @param object $product
     * @return string $url
     */
    public static function getURL($slug, $product) {

        //Vehicle description page
        if ($slug == 'list_details') {
            
            $params = array();
            $params[] = $product->make ?? '';
            $params[] = $product->model ?? '';
            $params[] = $product->dealer->city ?? '';
            $params[] = $product->dealer->dealer_slug ?? '';
            $params[] = $product->vin ?? '';
            $url = Route($slug, $params);
        }

        return $url;
    }
    
    /**
     * Get default car image.
     *
     * @param void
     * @return string $image
     */
    public static function getDefaultImage() {

        $image = asset('images/no-car.png');
        
        return $image;
    }

}
