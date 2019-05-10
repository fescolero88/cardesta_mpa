<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Product;
use App\OptionType;
use App\ProductOption;
use GuzzleHttp\Client;
use App\OptionTypeCategory;

class FeatureImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

        $this->feature_type = OptionTypeCategory::all();
    }

 

    public function get_feature($product)
    {

        $clienturl = $this->url.$product->market_check_api_id."?api_key=".env('MARKET_CHECK_API_KEY');
        $client = new Client();
        $res = $client->get($clienturl);
        $status = $res->getStatusCode();
        $response = $res->getBody();
        $response = json_decode($response);
        if(!empty($response))
        {
            if(empty($response->extra))
            {
                dump("ProductID: {$product->market_check_api_id} No features found");
                $product->update(['features_import' => 1]);
                return;
            }

            if(!empty($response->extra->seller_comments))
            {
                if(empty($product->description))
                {
                    $product->description = $response->extra->seller_comments;
                    $product->save();
                }
            }

            $return = $this->import_feature($response->extra,$product);
            
            dump("ProductID:{$product->market_check_api_id}   {$return['features_imported']} features imported");
        }
        else
        {
            dump("ProductID:  {$product->market_check_api_id} No response");
        }
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        while($product=$this->getproduct())
        {
            if(empty($product->market_check_api_id))
                continue;
           
            dump("Importing feature ProductID:  {$product->market_check_api_id}");
            $this->get_feature($product);
        }

        dump("Total products Imported {$this->total_inserted}");
    }

    public function getproduct(){
        $product = Product::whereIn('features_import',[0,2])->whereNotNull('market_check_api_id')->orderBy('id','asc')->first();
        return $product;
    }

    public function import_feature($pfeatures,$product){
        
        $new_features = [];
        /*
        1	general
        2	exterior
        3	interior
        4	mechanical
        5	safety

        */
       
        foreach($pfeatures as $feature_type => $features){
         
          
                switch($feature_type)
                {
                    case 'exterior_f':     
                        $option_cat_id = 2;
                    break;
                    case 'interior_f':
                        $option_cat_id = 3;
                    break;
                    case 'safety_f':
                        $option_cat_id = 5;
                    break;
                    case 'mechanical_f':
                    case 'mech_f':
                        $option_cat_id = 4;
                    break;
                    default:
                        $option_cat_id = 1;
                    break;
                    
                }
                
                if(empty($features) || !is_array($features)) continue;
                
                foreach($features as $feature)
                            {
                                $optionTypes[] = [
                                    'option_cat_id' => $option_cat_id,
                                    'name' => $feature,
                                    'slug' => str_slug($feature),
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                ];
                            }
            }

            if(empty($optionTypes))
            { 
                $product->update(['features_import' => 1]);
                return [
                'features_imported' => count($new_features),
             ];
            }

            foreach($optionTypes as $newF)
            { 
                    $option = OptionType::where(['slug'=>$newF['slug'],'option_cat_id' => $newF['option_cat_id']])->first();
                    if(empty($option))
                    {

                        $option_id = OptionType::insertGetId($newF);
                    }
                    else
                    {
                            $option_id = $option->id;
                    }

                        
                        if(ProductOption::where([
                            'product_id' => $product->id,
                            'product_options_cat_id' => $newF['option_cat_id'],
                            'product_options_type_id' => $option_id,
                        ])->count())
                        {
                            continue; 
                        }
                            $new_features[] = [
                                    'product_id' => $product->id,
                                    'product_options_cat_id' => $newF['option_cat_id'],
                                    'product_options_type_id' => $option_id,
                                    'value' => 0,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                            ];
                    
                }

        if(!empty($new_features))
        {
            try{
                ProductOption::insert($new_features);
                $product->update(['features_import' => 1]);
            }
            catch(\Exception $e)
            {
                $product->update(['features_import' => 2]);
                dd($e->getMessage());
            }
        }

        return [
            'features_imported' => count($new_features),
         ];

    }
}
