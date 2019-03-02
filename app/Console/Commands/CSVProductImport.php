<?php

namespace App\Console\Commands;

use App\Dealer;
use App\Product;
use Carbon\Carbon;
use App\ProductImage;
use App\ProductOption;
use Illuminate\Console\Command;

class CSVProductImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:ftp_import {dealer_name?} {provider?}';

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

     public $ftp;
     public $index = 0;
     public $total_imports = 0;
     public $dealer;
     public $headers;
     public $ftp_credentials = array(
        'host' => 'ftp.capitaldealersolutions.com',
        'username' => 'livefeed',
        'password' => '#E2w+faJ',
        'passive'   => true,
        'secure'   => false,
     );
     
    public function __construct()
    {
        \Config::set('ftp.connections.connection1', $this->ftp_credentials);

        parent::__construct();
        try{
            $this->ftp = \FTP::connection();
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dealer = $this->argument('dealer_name') ?? 'tituswill';
        $this->dealer = $dealer;
        $files = $this->ftp->getDirListing();
        $files = collect($files);
        $files_to_import = $files->filter(function($file)use($dealer){
            return strstr($file,$dealer);
        });
        
        dump("CSVs files found for dealer $dealer  ".count($files_to_import));

        $files_to_import->map(function($file_name){
            $this->index = 0;
            try{
            
                $file = fopen("ftp://{$this->ftp_credentials['username']}:".urlencode($this->ftp_credentials['password'])."@{$this->ftp_credentials['host']}/$file_name","r");
                $x = 0;
                dump("Importing products From $file_name");
                $total_rows = $this->total_imports;
                while (($row = fgetcsv($file, 4096)) !== false) {
                   $this->processRow($row);
                }
                dump("Total Product Imported from $file_name :  ".($this->total_imports - $total_rows));
                fclose($file);
            
            }
            catch(\Exception $e)
            {
                dump($e->getMessage());
            }
        });

        dump("Total Product Imported {$this->total_imports}");
        \FTP::disconnect();

        \Storage::disk('public_direct')->put('robots.txt', "User-agent: *\nDisallow: /wp-admin/\nAllow: /wp-admin/admin-ajax.php");
        
        $this->callSilent('xml:sitemapdealer');
        $this->callSilent('xml:sitemap');
        $this->callSilent('xml:imagesitemap');
       
    }


    public function processRow($row)
    {
        

        $colums = [
            "usednew" => "type",
            "year" => "year",
            "make" => "make",
            "model" => "model",
            "trim" => "trim",
            "bodystyle" => "body",
            "stocknumber" => "stock",
            "vin" => "vin",
            "mileage" => "miles",
            "price" => "sellingprice",
            "engine" => "enginecylinders",
            "tramsission" => "transmission",
            "color" => "-1",
            "interior" => "-1",
            "comment" => "description",
            "lotprice" => "lotprice",
            "msrp" => "msrp",
            "invoice" => "-1",
            "imageurls" => "-1",
            "certified" => "certified",
            "modelcode" => "modelnumber",
            "autoid" => "-1",
            "internetspecial" => "-1",
            "inventorydate" => "dateinstock",
            "carfaxoneowner" => "-1",
            "carfaxavailable" => "-1",
            "videoplayerurl" => "-1",
            "videoembedurl" => "-1",
            "lastupdated" => "updated_at",
            "custom1" => "-1",
            "custom2" => "-1",
            "custom3" => "-1",
            "custom4" => "-1",
            "custom5" => "-1",
            "lastphotoupdateutc" => "image_updated_at",
            "doors" => "doors",
            "modelseries" => "-1",
            "enginecylinders" => "enginecylinders",
            "mpg_city" => "citympg",
            "mpg_highway" => "highwaympg",
            "fuel_type" => "fuel_type",
            "cab_type" => "-1",
            "cost" => "-1",
            "compareprice" => "-1",
            "drivetrain" => "drivetrain",
            "vehicledetailspage" => "-1",
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
        ];            

                if($this->index++ == 0)
                {  
                    $row = array_map("strtolower", $row);
                    $keys = array_map("snake_case", $row);
                    $this->headers = $keys;
                    return;
                }
                
                $keys = $this->headers;

                try{

                    $data = array_combine($keys, $row);
                   
                }
                catch(\Exception $e)
                {   
                    $data = [];
                    foreach($keys as $key => $field)
                    {
                        $data[$field] = $csv[$key] ?? '';
                    }
                }

                //dd($data);

            $product = [];
            $product_options = [];
            $product_sub_options = [];
            $product_images = [];
            
            $dealer_data = [];
            $dealer_id = $data['dealer_id'] ?? $data['dealerid'] ?? $data['dealer_i_d'] ?? $this->dealer;
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
                            if(strpos($field,'address') !== false)
                            {
                                $dealer_data['address'] = $data[$field];
                            }
                            else
                            {
                                $db_field = ltrim($field,'dealer_');
                                $dealer_data[$db_field] = $data[$field];
                            }
                        }
                       

                            continue;
                    }
                    else if(strstr($field, 'date') || $field == 'lastphotoupdateutc')
                    { 
                        $data[$field] = Carbon::parse($data[$field])->format('Y-m-d');
                        $product[$field] = Carbon::parse($data[$field])->format('Y-m-d');
                    }
                    else if($field == 'lastupdated')
                    { 
                        $data[$field] = Carbon::parse($data[$field])->format('Y-m-d H:i:s');
                        $product[$field] = Carbon::parse($data[$field])->format('Y-m-d H:i:s');
                    }
                    else if($field == 'miles')
                    {
                        $data[$field] = !empty($data[$field]) ? intval($data[$field]) : 0;
                        $product[$field] = !empty($data[$field]) ? intval($data[$field]) : 0;
                    }
                    else if($field == 'usednew')
                    {
                        $data[$field] = $data[$field] == 'N' ? 'New' : 'Used';
                        $product[$field] = $data[$field] == 'N' ? 'New' : 'Used';
                    }
                    else if($field == 'certified')
                    {
                        $data[$field] = $data[$field] == 'N' ? 'False' : 'True';
                        $product[$field] = $data[$field] == 'N' ? 'False' : 'True';
                    }
                    else if(strstr($field,'price'))
                    {
                        $data[$field] = floatval($data[$field]);
                        $product[$field] = floatval($data[$field]);
                    }
                    else if(strstr($field,'mpg'))
                    {
                        $data[$field] = floatval($data[$field]);
                        $product[$field] = floatval($data[$field]);
                    }
                    else if(strstr($field,'lotprice'))
                    {
                        $data[$field] = floatval($data[$field]);
                        $product[$field] = floatval($data[$field]);
                    }
                    elseif($field == 'options')
                    {
                        $ops = explode(',',$data[$field]);
    
                        $type = \DB::table('options_type_category')->where('type', 'general')->first();
    
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
                    elseif($field == 'interior')
                    {
                        $ops = explode(',',$data[$field]);
    
                        $type = \DB::table('options_type_category')->where('type', 'interior')->first();
    
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
                    else if($field == 'categorized_options')
                    {
                        $categorized_options = explode('~',$data[$field]);
                   
                        foreach($categorized_options as $options)
                        {
                            $options = explode('@',$options);
                            $category = $options[0];
                            $type = \DB::table('options_type_category')->where('type', $category)->first();
                            if($type)
                            {
                                $p_option = $options[1];
                                
    
                                // check option type already exists in table
                                $t = \DB::table('options_types')->where([
                                    'option_cat_id' => $type->id,
                                    'slug' => str_slug($p_option)])->first();
                                
                                    if(!empty($t))
                                    {    
                                        $product_options[] = [
                                            'product_id' => '',
                                            'product_options_cat_id' => $type->id,
                                            'product_options_type_id' => $t->id
                                        ];
                                    }
                                   
                            }
                            
                            
                        }
                    
                    }
                    else if($field == 'imagelist')
                    {
                        $product_images  = explode(',',$data[$field]);
                    }
                    else if($field == 'imageurls')
                    {
                        $product_images  = explode(',',$data[$field]);
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

                $product_exists = Product::with('images')->where(['vin' => $product_insert['vin'],'dealer_id' => $dealer_id])->first();
            if(empty($product_exists))
            {    
                $pid = Product::insertGetId($product_insert);
            }
            else
            {
                // if(Carbon::parse($product_insert['updated_at'])->gt(Carbon::parse($product_exists['updated_at'])))
                // {
                    $product_exists->update($product_insert);
                // }

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
            \Log::error($e->getMessage());
            dump($e->getMessage());
        }
    }
}
