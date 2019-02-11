<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class ProductOptionsTypes extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'options_types';
        $this->filename = base_path('/database/seeds/csvs/RalphSchompMINI.csv');
        $this->should_trim = true;
     
    }
    
 

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		DB::table('options_types')->truncate();
		DB::table('options_sub_types')->truncate();

        $csv = array_map("str_getcsv", file($this->filename,FILE_SKIP_EMPTY_LINES));

        $keys = array_shift($csv);
        $keys = array_map("strtolower", $keys);
        $keys = array_map("snake_case", $keys);
     
        foreach ($csv as $i=>$row) {
            $data = array_combine($keys, $row);

            $product = [];
            foreach($keys as $field)
            {
                if($field == 'options')
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
                
                }
                
            }
        }


		
	}
}
