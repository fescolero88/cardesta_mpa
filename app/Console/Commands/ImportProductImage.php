<?php

namespace App\Console\Commands;

use App\Product;
use App\OptionType;
use App\ProductOption;
use GuzzleHttp\Client;
use App\OptionTypeCategory;
use Illuminate\Console\Command;

class ImportProductImage extends Command
{
/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:import_image {product_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import inventory data from market check api ';

    protected $url="http://marketcheck-prod.apigee.net/v1/listing/";

    public $feature_type = [];

    public $start = 0;
    public $inserted = 0;
    public $total_inserted = 0;
    public $skipped = 0;
    public $max_rows = 0;

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
        
        while($product = Product::with('images')->where('image_import',0)->limit(1)->first())
        { 
            $product->update(['image_import' => 3]);  
            if(empty($product->images->all()))
            {
                dump("No Images for product ID {$product->id}");
                continue;
            }

            
            if($product->images[0]->imported > 0)
            {
                dump("Image already imported {$product->images[0]->id}");
                continue;
            }
           
            //$product->update(['image_import' => 3]);

            $image = $product->images[0];
            
            try{
                $image_content = @file_get_contents($image->image);
                if(strstr($http_response_header[0],"200"))
                {
                    
                        if($image->imported == 1)
                        {
                            dump("Already imported {$image->id}");
                            $product->update(['image_import' => 3]);
                            continue ;
                        }

                        $name =  'product-images/'.$product->dealer_id.'-'.$product->vin.'-'.$image->id.'.jpg';
                        $d = \Storage::disk('s3')->put($name, $image_content);
                        $image->original_url = $image->image;
                        $image->image = env('CDN_URL').$name;
                        $image->imported = 1;
                        $image->save();
                        $this->total_inserted++;
                        $product->update(['image_import' => 1]);
                        dump("Image imported {$image->id}");
                
                }
                else
                {
                    $image->delete();
                    $product->update(['image_import' => 2]);
                    dump("Image url not found deleted {$image->id}");
                }

            }
            catch(\Exception $e)
            {
                dump($e->getMessage());
                $product->update(['image_import' => 2]);
                continue;
            }
            
        }

        dump("Total products image Imported {$this->total_inserted}");
    }

 
}
