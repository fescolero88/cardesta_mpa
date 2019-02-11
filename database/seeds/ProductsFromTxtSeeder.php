<?php

use App\Product;
use Carbon\Carbon;
use App\ProductImage;
use App\ProductOption;
use App\ProductSubOption;
use Illuminate\Database\Seeder;

class ProductsFromTxtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $r = readfile(base_path('/database/seeds/txt/vauto_inventory.txt'));
        // dd($r[0]);
        $headers = [];
        $products = [];
        /* $handle = @fopen(base_path('/database/seeds/txt/vauto_inventory.txt'), "r");
        
        if ($handle) {
            $x = 0;
            dump("Processing Product Features"); 
            while (($buffer = fgets($handle, 4096)) !== false) {
                $buffer = trim($buffer);
                $buffer = rtrim($buffer,"\r\n");
                if(empty($buffer))
                {
                    dump("Skipping row ".$x.'...'); 
                    continue;
                }
                if($x == 0)
                {
                    $keys = explode("\t",$buffer);
                    $keys = array_map("strtolower", $keys);
                    $keys = array_map("snake_case", $keys);
                    $headers = $keys;
                }
                else
                {
                    $data = explode("\t",$buffer);
                    try{
                        $p = array_combine($headers, $data);
                    }
                    catch(\Exception $e)
                    {
                        foreach($headers as $key => $field)
                        {
                            $p[$field] =   $data[$key] ?? '';
                        }
                    }
                   //
                    if(!empty($p['features']))
                    {
                        $type = \DB::table('options_type_category')->where('type', 'general')->first();

                        $p['features'] = explode(',',$p['features']);
                        foreach($p['features'] as $op)
                        {

                            $p_option = $op;
                            $p_sub_option = [];
                            
                        
                            if(strpos($op, '-inc: SIRIUSXM') !== false)
                            {
                                $p_option = explode('-inc: SIRIUSXM',$p_option);
                                $p_sub_option = explode('SIRIUSXM',$p_option[1]);
                            }
                            else if (strpos($op, '-inc:') !== false) {
                                
                                $p_option = explode('-inc:',$p_option);
                                $p_sub_option = explode(',',$p_option[1]);

                            }
                            // if option is seperated by w/
                            else if (strpos($op, 'w/') !== false) {
                                
                                $p_option = explode('w/',$p_option);
                                $p_sub_option = explode(',',$p_option[1]);
                            }
                            

                            $p_option = is_array($p_option) ? $p_option[0] : $p_option;

                            if(strlen($p_option) >= 150)
                            {
                                continue;
                            }

                            $insert = [
                                'option_cat_id' => $type->id,
                                'name' => $p_option ,
                                'slug' => str_slug($p_option),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ];
                            // check option type already exists in table
                            $t = \DB::table('options_types')->where([
                                'option_cat_id' => $type->id,
                                'name' => $p_option,
                                'slug' => str_slug($p_option)])->first();
                            
                                if(empty($t))
                                {    
                                    $t = \DB::table('options_types')->insertGetId($insert);
                                }
                                else
                                {
                                    $t = $t->id;
                                }
                                
                                if(!empty($p_sub_option))
                                {
                                    foreach($p_sub_option as $sub_option)
                                    {
                                        if(strlen($sub_option) >= 150)
                                        {
                                            continue;
                                        }

                                        $sub_insert = [
                                            'option_cat_id' => $type->id,
                                            'option_type_id' => $t,
                                            'name' => $sub_option ,
                                            'slug' => str_slug($sub_option),
                                            'created_at' => date("Y-m-d H:i:s"),
                                            'updated_at' => date("Y-m-d H:i:s")
                                        ];
                                    // check sub option type already exists in table
                                        $ot = \DB::table('options_sub_types')->where([
                                            'option_cat_id' => $type->id,
                                            'option_type_id' => $t,
                                            'name' => $sub_option ,
                                            'slug' => str_slug($sub_option)
                                            ])->first();
                                        
                                            if(empty($ot))
                                            {    
                                                \DB::table('options_sub_types')->insert($sub_insert);
                                            }
                                    }
                                }

                        }
                    }
                   dump("Processed row ".$x.'...'); 
                }
                $x++;
            }
            fclose($handle);
        } */

        $handle = @fopen(base_path('/database/seeds/txt/vauto_inventory.txt'), "r");
        if ($handle) {
            $x = 0;

            while (($buffer = fgets($handle, 4096)) !== false) {
                
                //$buffer = trim($buffer);
                $buffer = rtrim($buffer,"\r\n");
                if(empty($buffer))
                {
                    dump(" Products Skipping row ".$x.'...'); 
                    continue;
                }

                $product = [];
                $product_options = [];
                $product_sub_options = [];
                $product_images = [];

                if($x == 0)
                {
                    $keys = explode("\t",$buffer);
                    $keys = array_map("strtolower", $keys);
                    $keys = array_map("snake_case", $keys);
                    $headers = $keys;


                    $dbfields = [
                        "dealer_id",
                        "type"  ,
                        "stock",
                        "vin",
                        "year",
                        "make",
                        "model",
                        "body",
                        "trim",
                        "modelnumber",
                        "doors",
                        "exteriorcolor",
                        "interiorcolor",
                        "enginecylinders",
                        "enginedisplacement",
                        "transmission",
                        "miles",
                        "sellingprice",
                        "msrp",
                        "bookvalue",
                        "invoice",
                        "certified",
                        "dateinstock",
                        "description",
                        "dealer_address",
                        "dealer_city",
                        "dealer_state",
                        "dealer_zip",
                        "dealer_phone",
                        "dealer_fax",
                        "special_field1",
                        "special_field2",
                        "special_field3",
                        "special_field4",
                        "style_description",
                        "ext_color_generic",
                        "ext_color_code",
                        "int_color_generic",
                        "int_color_code",
                        "int_upholstery",
                        "engine_block_type",
                        "engine_aspiration_type",
                        "engine_description",
                        "transmission_speed",
                        "transmission_description",
                        "drivetrain",
                        "fuel_type",
                        "citympg",
                        "highwaympg",
                        "epaclassification",
                        "wheelbase_code",
                        "internet_price",
                        "misc_price1",
                        "misc_price2",
                        "misc_price3",
                        "factory_codes",
                        "marketclass",
                        "passengercapacity",
                        "extcolorhexcode",
                        "intcolorhexcode",
                        "enginedisplacementcubicinches"
                    ];

                }
                else
                {
                    $data = explode("\t",$buffer);
                    $p = array_combine($headers, $data);
                   //
                    if(!empty($p['features']))
                    {
                        $type = \DB::table('options_type_category')->where('type', 'general')->first();
                        $p['features'] = explode(',',$p['features']);
                    
                        foreach($p['features'] as $op)
                        {
                            if($type)
                            {
    
                                $p_option = $op;
                                $p_sub_option = [];
                                
                            
                                if(strpos($op, '-inc: SIRIUSXM') !== false)
                                {
                                    $p_option = explode('-inc: SIRIUSXM',$p_option);
                                    $p_sub_option = explode('SIRIUSXM',$p_option[1]);
                                }
                                else if (strpos($op, '-inc:') !== false) {
                                    
                                    $p_option = explode('-inc:',$p_option);
                                    $p_sub_option = explode(',',$p_option[1]);
    
                                }
                                // if option is seperated by w/
                                else if (strpos($op, 'w/') !== false) {
                                    
                                    $p_option = explode('w/',$p_option);
                                    $p_sub_option = explode(',',$p_option[1]);
                                }
                                
    
                                $p_option = is_array($p_option) ? $p_option[0] : $p_option;
    
                                if(strlen($p_option) >= 150)
                                {
                                    continue;
                                }
    
                                
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
                                    
                                    
                                    if(!empty($p_sub_option))
                                    {
                                        foreach($p_sub_option as $sub_option)
                                        {
                                            if(strlen($sub_option) >= 150)
                                            {
                                                continue;
                                            }
    
                                        
                                        // check sub option type already exists in table
                                            $ot = \DB::table('options_sub_types')->where([
                                                'option_cat_id' => $type->id,
                                                'option_type_id' => $t->id,
                                                'slug' => str_slug($sub_option)
                                                ])->first();
                                            
                                                if(!empty($ot))
                                                {    
                                                    $product_sub_options[] = [
                                                        'product_id' => '',
                                                        'product_options_cat_id' => $type->id,
                                                        'product_options_type_id' => $t->id,
                                                        'product_options_sub_type_id' => $ot->id
                                                    ];
                                                }
                                        }
                                    }
    
    
    
                            }
                        }

                    }
                    if(!empty($p['photo_url_list']))
                        $product_images = explode(',',$p['photo_url_list']);
                        
                        
                    unset($p['photo_url_list']);
                    unset($p['features']);

                    $product = $p;
                    //dd(product);
                    $date = Carbon::now();
                    $product['created_at'] = $date;
                    $product['updated_at'] = $date;
                    try{
                        \DB::beginTransaction(); 
                                               

                        $product_insert = [];
                        foreach($dbfields as $dbfield)
                        {
                            
                            if(isset($product[$dbfield]))
                            {
                                $product_insert[$dbfield] = $product[$dbfield];
                            }
                            else if(isset($product[str_replace(['_','#'],'',$dbfield)]))
                            {
                                $product_insert[$dbfield] = $product[str_replace(['_','#'],'',$dbfield)];
                            }
                            else
                            {
                                $product_insert[$dbfield] = '';
                            }
                        }

                        
                        dump($product);
                        dd($product_insert);
                        
                    $pid = Product::insertGetId($product);
        
        
                    $product_sub_options = array_map(function($item) use ($pid,$date){
                        $item['product_id'] = $pid;
                        $item['created_at'] = $date;
                        $item['updated_at'] = $date;
                        return $item;
                    },$product_sub_options);
        
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
        
                   ProductImage::insert($product_images); 
                   ProductSubOption::insert($product_sub_options);
                   ProductOption::insert($product_options);
                   \DB::commit();
                }
                catch(\Exception $e)
                {
                    \DB::rollBack();
                    \Log::error($e->getMessage());
                    dd($e->getMessage());
                }
                dump("Product Processed row ".$x.'...'); 
                }
                $x++;
            }
            fclose($handle);
        }
    }
}
