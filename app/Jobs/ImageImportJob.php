<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\ProductImage;

class ImageImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        while($image = ProductImage::where('imported',0)->first())
        {
            if(empty($image->image))
            {
                $image->delete();
                dump("Image Empty url deleted {$image->id}");
                continue;
            }            
            $product = $image->product;
        
            $image_content = @file_get_contents($image->image);
            if(strstr($http_response_header[0],"200"))
            {
                try{
                    $name =  'product-images/'.$product->dealer_id.'-'.$product->vin.'-'.$image->id.'.jpg';
                    $d = \Storage::disk('s3')->put($name, $image_content);
                    $image->original_url = $image->image;
                    $image->image = env('CDN_URL').$name;
                    $image->imported = 1;
                    $image->save();
                    dump("Image imported {$image->id}");
                }
                catch(\Exception $e)
                {
                    dd($e->getMessage());
                }
            }
            else
            {
                $image->delete();
                dump("Image url not found deleted {$image->id}");
            }
        }
    }
}
