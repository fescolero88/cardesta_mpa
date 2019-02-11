<?php

use App\Dealer;
use App\Product;
use Carbon\Carbon;
use App\ProductImage;
use App\ProductOption;
use App\ProductSubOption;
use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class ProductsTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'products';
        $this->filename = base_path('/database/seeds/csvs/RalphSchompMINI.csv');
        $this->should_trim = true;
     
    }
    
 

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		DB::table($this->table)->truncate();
		DB::table('product_options')->truncate();
		DB::table('product_sub_options')->truncate();

        $csv = array_map("str_getcsv", file($this->filename,FILE_SKIP_EMPTY_LINES));

        $keys = array_shift($csv);
        $keys = array_map("strtolower", $keys);
        $keys = array_map("snake_case", $keys);
        $dealer_data_fields = [
            'dealer_address',
            'dealer_city',
            'dealer_state',
            'dealer_zip',
            'dealer_phone',
            'dealer_fax',
        ];
     
        foreach ($csv as $i=>$row) {
            $data = array_combine($keys, $row);

            $product = [];
            $product_options = [];
            $product_sub_options = [];
            $product_images = [];
            $dealer_data = [];

            $dealer = Dealer::where('dealer_id', $data['dealer_id'] ?? $data['dealerid'])->count();
            
            foreach($keys as $field)
            {

                if(in_array($field,$dealer_data_fields))
                {
                    if(empty($dealer))
                        $dealer_data[ltrim('dealer_')] = $data[$field];
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
                            $p_sub_option = [];
                            
                            if (strpos($options[1], '-inc:') !== false) {
                                
                                $p_option = explode('-inc:',$p_option);
                                $p_sub_option = explode(',',$p_option[1]);

                            }// if option is seperated by w/
                            else if (strpos($options[1], 'w/') !== false) {
                                
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
                                            'slug' => str_slug($sub_option)
                                            ])->first();
                                        
                                            if(!empty($ot))
                                            {    
                                                $product_sub_options[] = [
                                                    'product_id' => '',
                                                    'product_options_cat_id' => $type->id,
                                                    'product_options_type_id' => $t->id ?? '',
                                                    'product_options_sub_type_id' => $ot->id
                                                ];
                                            }
                                    }
                                }
                        }
                        
                        
                    }
                
                }
                else if($field == 'imagelist')
                {
                    $product_images  = explode(',',$data[$field]);
                }
                else
                {
                    $product[$field] = $data[$field];
                }
                
            }
        
            $date = Carbon::now();
            $product['created_at'] = $date;
            $product['updated_at'] = $date;
            try{
                \DB::beginTransaction();    
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
          
           if(!empty($dealer_data))
           {
               $dealer_data['dealer_id'] = $data['dealer_id'] ?? $data['dealerid'];
               $dealer_data['created_at'] = $date;
               $dealer_data['updated_at'] = $date;
               Dealer::insert($dealer_data);
           }
           \DB::commit();
        }
        catch(\Exception $e)
        {
            \DB::rollBack();
            \Log::error($e->getMessage());
            dump($e->getLine());
            dd($e->getMessage());
        }

        }


		
	}
}
