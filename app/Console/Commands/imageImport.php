<?php

namespace App\Console\Commands;

use App\ProductImage;
use Illuminate\Console\Command;

class imageImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:import_images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        while($image = ProductImage::where('imported',0)->limit(1)->first())
        {
            $image->imported = 3;
            $image->save();

            if(empty($image->image))
            {
                $image->delete();
                dump("Image Empty url deleted {$image->id}");
                continue;
            }            
            $product = $image->product;
            try{
                $image_content = @file_get_contents($image->image);
                if(strstr($http_response_header[0],"200"))
                {
                    
                        $name =  'product-images/'.$product->dealer_id.'-'.$product->vin.'-'.$image->id.'.jpg';
                        $d = \Storage::disk('s3')->put($name, $image_content);
                        $image->original_url = $image->image;
                        $image->image = env('CDN_URL').$name;
                        $image->imported = 1;
                        $image->save();
                        dump("Image imported {$image->id}");
                    
                }
                else
                {
                    $image->delete();
                    dump("Image url not found deleted {$image->id}");
                }

            }
            catch(\Exception $e)
            {
                dump("Error : ".$e->getMessage());
                continue;
            }
        }
    }
}
