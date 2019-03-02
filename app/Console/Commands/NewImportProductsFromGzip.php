<?php

namespace App\Console\Commands;

use App\Dealer;
use App\Product;
use Carbon\Carbon;
use App\ProductImage;
use App\ProductOption;
use App\Helpers\CSVReader;
use Illuminate\Console\Command;

class NewImportProductsFromGzip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:gzip_new {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    public $ftp;
    public $index = 0;
    public $total_imports = 0;
    public $dealer;
    public $headers;
    public $ftp_credentials = array(
        'host'      => 'ftp.marketcheck.com',
        'username'  => 'cdsauto',
        'password'  => 'SqvqMRCF7HagNndX',
        'passive'   => true,
        'secure'    => false,
     );

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
     *Product::select('fuel_type')->groupBy('fuel_type')->remember(1440)->get()->filter(function($fuel_type){ return !empty($fuel_type->fuel_type); })->values()->toArray();
     * @return mixed
     */
    public function handle()
    {
        if(!in_array($this->argument('type'),['Used','New']))
        {
            $this->error("Type should be 'Used' or 'New'");
            return;
        }

        $file_name = storage_path("used_sample.csv.gz");
        $reader = new CSVReader('compress.zlib://'.$file_name);
        foreach($reader as $key => $row) {
            $this->processRow($row);
            // if($key >= 100)
            // {
            //     dd();
            // }
        }
    }

    public function processRow($row)
    {
      
        
        $colums = [
            "id" => "market_check_api_id",
            "year_is" => "year",
            "make_ss" => "make",
            "model_ss" => "model",
            "trim_ss" => "trim",
            "body_type_ss" => "body",
            "stock_no_ss" => "stock",
            "vin_ss" => "vin",
            "miles_fs" => "miles",
            "price_fs" => "sellingprice",
            "cylinders_is" => "enginecylinders",
            "engine_block_ss" => "engine_block_type",
            "engine_aspiration_ss" => "engine_aspiration_type",
            "transmission_ss" => "transmission",
            "exterior_color_ss" => "exteriorcolor",
            "interior_color_ss" => "interiorcolor",
            "seller_comments_texts" => "description",
            "msrp_fs" => "msrp",
            "first_scraped_at_dts" => "dateinstock",
            "scraped_at_dts" => "updated_at",
            "doors_is" => "doors",
            "engine_size_ss" => "enginecylinders",
            "fuel_type_ss" => "fuel_type",
            "drivetrain_ss" => "drivetrain",
            "is_certified_is" => 'certified',
            "zip_is" => -1,
            "latitude_fs" => -1,
            "longitude_fs" => -1,
            "heading_ss" => -1,
            // "make_orig_ss" => -1,
            // "model_orig_ss" => -1,
            // "trim_orig_ss" => -1,
            "vehicle_type_ss" => -1,
            "vehicle_type_orig_ss" => -1,
            "body_type_orig_ss" => -1,
            "body_subtype_ss" => -1,
            "body_subtype_orig_ss" => -1,
            // "drivetrain_orig_ss" => -1,
            // "fuel_type_orig_ss" => -1,
            "engine_ss" => -1,
            // "engine_orig_ss" => -1,
            "engine_block_orig_ss" => -1,
            // "engine_size_orig_ss" => -1,
            "engine_measure_ss" => -1,
            // "engine_measure_orig_ss" => -1,
            // "engine_aspiration_orig_ss" => -1,
            // "transmission_orig_ss" => -1,
            "speeds_is" => -1,
            "speeds_orig_ss" => -1,
            "doors_orig_ss" => -1,
            "cylinders_orig_ss" => -1,
            "color_ss" => -1,
            "taxonomy_vin_ss" => -1,
            "status_date_dts" => -1,
            "touch_count_is" => -1,
            "source_ss" => -1,
            "domain_id_ls" => -1,
            "more_info_ss" => -1,
            "address_ss" => -1,
            "city_ss" => -1,
            // "city_state_ss" => -1,
            // "city_state_zip_ss" => -1,
            "county_ss" => -1,
            "state_ss" => -1,
            "street_ss" => -1,
            "area_ss" => -1,
            "seller_type_ss" => -1,
            "seller_email_ss" => -1,
            "seller_phone_ss" => -1,
            "seller_name_ss" => -1,
            // "seller_name_orig_ss" => -1,
            // "aws_ss" => -1,
            "photo_url_ss" => -1,
            "listing_type_ss" => -1,
            // "is_taxonomy_enriched_is" => -1,
            // "is_real_vin_is" => -1,
            // "is_duplicate_is" => -1,
            // "is_grouped_is" => -1,
            // "grouped_at_dts" => -1,
            // "new_vin_is" => -1,
            // "group_id_ls" => -1,
            // "robot_id_ls" => -1,
            // "stage2_id_ls" => -1,
            // "robot_cycle_id_ls" => -1,
            "options_texts" => -1,
            "features_texts" => -1,
            "photo_links_ss" => -1,
            "car_street_ss" => -1,
            "car_address_ss" => -1,
            "car_city_ss" => -1,
            "car_state_ss" => -1,
            "car_zip_is" => -1,
            "dealer_id_is" => -1,
            "car_seller_name_ss" => -1,
            "car_seller_id_is" => -1,
            "dom_is" => -1,
            "dom_180_is" => -1,
        ];



        $db_csv_mapping = [];
        foreach($colums as $k => $v)
        {
            if($v != -1)
            {
                 $db_csv_mapping[$k] = $v;
            }
        }
        
        $db_csv_mapping = array_flip($db_csv_mapping);

        $dealer_data_fields = [
            'dealer_address',
            'dealer_city',
            'dealer_state',
            'dealer_zip',
            'dealer_phone',
            'dealer_fax',
            'dealer_fax',
            'zip_is',
            'latitude_fs',
            'longitude_fs',
            'address_ss',
            'city_ss',
            'county_ss',
            'state_ss',
            'street_ss',
            'area_ss',
            'seller_type_ss',
            'seller_email_ss',
            'seller_phone_ss',
            'seller_name_ss',
            // 'seller_name_orig_ss',
            'source_ss'
        ];            

                
                    
                    $this->headers = array_keys($row);
                    
                
                
                $keys = $this->headers;

                $data = $row;

            $product = [];
            $product_options = [];
            $product_sub_options = [];
            $product_images = [];
            if(!empty($row['photo_links_ss']))
            {
                $product_images  = explode('|',$row['photo_links_ss']);
            }
            $dealer_data = [];
            $dealer_id = $data['dealer_id'] ?? $data['dealerid'] ?? $data['dealer_i_d'] ?? $data['dealer_id_is'];
            $dealer = Dealer::where('dealer_id', $dealer_id)->first();
            if(!empty($dealer))
            {

                if(!empty($dealer->zip) && empty($dealer->latitude) && empty($dealer->longitude))
                {
                    $pos = \Geocoder::getCoordinatesForAddress($dealer->zip);
                    if(!empty($pos['lat']))
                    {
                        // $product_insert['latitude'] = $pos['lat'];
                        $dealer->latitude = $pos['lat'];
                    }

                    if(!empty($pos['lng']))
                    {
                        // $product_insert['longitude'] = $pos['lng'];
                        $dealer->longitude = $pos['lng'];
                    }

                    $dealer->save(); 
                }
            }
            foreach($keys as $field)
            {

                if(in_array($field,$dealer_data_fields))
                {
                    if(empty($dealer))
                    {
                        if(strstr($field,'email'))
                        {
                            $dealer_data['email'] = $data['seller_email_ss'];
                        }
                        else if(strstr($field,'phone'))
                        {
                            $dealer_data['phone'] = $data['seller_phone_ss'];
                        }
                        else if(strstr($field,'name'))
                        {
                            $dealer_data['name'] = $data['seller_name_ss'];
                            $dealer_data['dealer_slug'] = str_slug($data['seller_name_ss']);
                        }
                        else if(strstr($field,'zip'))
                        {
                            $dealer_data['zip'] = $data['zip_is'];
                        }
                        else if(strstr($field,'latitude'))
                        {
                            $dealer_data['latitude'] = $data['latitude_fs'];
                        }
                        else if(strstr($field,'longitude'))
                        {
                            $dealer_data['longitude'] = $data['longitude_fs'];
                        }
                        else if(strstr($field,'address'))
                        {
                            $dealer_data['address'] = $data['address_ss'] ?? $data['street_ss'] ?? '';
                        }
                        else if(strstr($field,'city'))
                        {
                            $dealer_data['city'] = $data['city_ss'];
                        }
                        else if(strstr($field,'state'))
                        {
                            $dealer_data['state'] = $data['state_ss'];
                        }
                        else if(strstr($field,'country'))
                        {
                            $dealer_data['country'] = $data['country_ss'];
                        }
                        else if(strstr($field,'source'))
                        {
                            $dealer_data['website'] = $data['source_ss'];
                        }

                        $dealer_data['call_tracking_no'] = '(888) 309-5664';
                        $dealer_data['feed_type'] = 'Market Check FTP';
                        $dealer_data['product_import'] = '1';
                        $dealer_data['dealer_id'] = $data['dealer_id_is'];
                        
                    }
                    

                        continue;
                }
                else if(
                    strstr($field, 'date')             || 
                    $field == 'lastphotoupdateutc'     ||
                    $field == 'first_scraped_at_dts' 
                    )
                { 
                    $data[$field] = Carbon::parse($data[$field])->format('Y-m-d');
                    $product[$field] = Carbon::parse($data[$field])->format('Y-m-d');
                }
                else if($field == 'scraped_at_dts')
                { 
                    $data[$field] = Carbon::parse($data[$field])->format('Y-m-d H:i:s');
                    $product[$field] = Carbon::parse($data[$field])->format('Y-m-d H:i:s');
                }
                else if($field == 'miles' || $field == 'miles_fs')
                {
                    $data[$field] = !empty($data[$field]) ? intval($data[$field]) : 0;
                    $product[$field] = !empty($data[$field]) ? intval($data[$field]) : 0;
                }
                else if($field == 'is_certified_is')
                {
                    $data[$field] = $data[$field] == 1 ? 'True' : 'False';
                    $product[$field] = $data[$field] == 1 ? 'True' : 'False';
                }
                else if(strstr($field,'price'))
                {
                    $data[$field] = floatval($data[$field]);
                    $product[$field] = floatval($data[$field]);
                }
                else if(strstr($field,'msrp'))
                {
                    $data[$field] = floatval($data[$field]);
                    $product[$field] = floatval($data[$field]);
                }
                else if(strstr($field,'mpg'))
                {
                    $data[$field] = floatval($data[$field]);
                    $product[$field] = floatval($data[$field]);
                }
                elseif($field == 'options' || $field == 'options_texts'|| $field == 'features_texts')
                {
                    if(empty($data[$field])) continue;

                    $ops = explode('|',$data[$field]);
                    // dump($ops);
                    // continue;
                    if(strstr($field,'option'))
                    {
                        $type = \DB::table('options_type_category')->where('type', 'options')->first();
                    }
                    else
                    {
                        $type = \DB::table('options_type_category')->where('type', 'general')->first();
                    }

                    foreach($ops as $op)
                    {
                        if($type)
                        {

                            $p_option = $op;
                            

                            
                            // check option type already exists in table
                            $t = \DB::table('options_types')->where([
                                'option_cat_id' => $type->id,
                                'slug' => str_slug($p_option)])->first();
                            
                                if(empty($t))
                                {

                                    $insert = [
                                        'option_cat_id' => $type->id,
                                        'name' => $p_option ,
                                        'slug' => str_slug($p_option),
                                        'created_at' => date("Y-m-d H:i:s"),
                                        'updated_at' => date("Y-m-d H:i:s")
                                    ];

                                    $t = \DB::table('options_types')->insertGetId($insert);
                                }


                                    $t = $t->id ?? $t;

                                    $product_options[] = [
                                        'product_id' => '',
                                        'product_options_cat_id' => $type->id,
                                        'product_options_type_id' => $t
                                    ];
                            



                        }
                    }
                        
                    
                }
                else
                {
                    $product[$field] = $data[$field];
                }
                
            }
        
           

            try{
                \DB::beginTransaction();    
                $product_insert = [];
                foreach($db_csv_mapping as $dbfield => $csv_header_field )
                {
                    $product_insert[$dbfield] = $product[$csv_header_field];
                } 


                $date = Carbon::now();
                $product_insert['created_at'] = $date;
                
                if(empty($product_insert['updated_at']))
                    $product_insert['updated_at'] = $date;

                
                $product_insert['miles'] = !empty($product_insert['miles']) ? intval($product_insert['miles']) : 0;
                $product_insert['dealer_id'] = $dealer_id;
                $product_insert['type'] = $this->argument('type');
                // if(empty($product_insert['drivetrain']))
                // {
                //     $product_insert['drivetrain'] = $row['drivetrain_orig_ss'] ?? '';
                // }
                
                if(!empty($dealer))
                {
                    if(!empty($dealer->zip))
                    {
                        
                        if(!empty($dealer->latitude))
                        {
                            $product_insert['latitude'] = $dealer->latitude;
                          
                        }

                        if(!empty($dealer->longitude))
                        {
                            $product_insert['longitude'] = $dealer->longitude;
                        }
                    }
                }
               
                // dump($row);
                // dump($dealer_data);
                // dump($product_images);
                // dump($product_options);
                // dump($product_insert);
                // echo "\n----------------------------------------------\n";

                // return;

                $product_exists = Product::with('images')->where(['vin' => $product_insert['vin'],'dealer_id' => $dealer_id])->first();
            if(empty($product_exists))
            {    
                $pid = Product::insertGetId($product_insert);
            }
            else
            {
                if(Carbon::parse($product_insert['updated_at'])->gt(Carbon::parse($product_exists['updated_at'])))
                {
                    $product_exists->update($product_insert);
                }

                $pid = $product_exists->id;
            }




            $product_options = array_map(function($item) use ($pid,$date){
                $item['product_id'] = $pid;
                $item['created_at'] = $date;
                $item['updated_at'] = $date;
                return $item;
            },$product_options);

            $product_images = array_map(function($image) use ($pid,$date){
                $item = [];
                $item['image'] = $image;
                $item['product_id'] = $pid;
                $item['created_at'] = $date;
                $item['updated_at'] = $date;
                return $item;
            },$product_images);
        

          if(!empty($product_exists) && !empty($product_images))
          {
               ProductImage::where('product_id',$pid)->delete();
          }  

           if(!empty($product_images))
             ProductImage::insert($product_images); 
          
           if(!empty($product_options)) 
           {
             ProductOption::where('product_id',$pid)->delete();
             ProductOption::insert($product_options);
           }
           
           if(!empty($dealer_data))
           {
                $dealer_data['dealer_id'] = $dealer_id;
                $dealer_data['created_at'] = $date;
                $dealer_data['updated_at'] = $date;
                Dealer::insert($dealer_data);
           }
           
           \DB::commit();
           if(!empty($product_exists))
           {
            dump("Product Updated {$pid}");
           }
           else
           {
            $this->total_imports++;
            dump("Product Imported {$pid}");
           }
           

        }
        catch(\Exception $e)
        {
            \DB::rollBack();
            dump($e->getLine()." : ".$e->getMessage());
        }
    }
}
