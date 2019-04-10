<?php

namespace App\Http\Controllers;

use App\Dealer;
use App\Product;
use Carbon\Carbon;
use App\ImportCsv;
use App\ProductImage;
use App\ProductOption;
use App\UploadImage;
use App\Settings;
use App\ProductSubOption;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\ProductsImport;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    public function index(){
        $dealers = Dealer::all();
        return view('admin/inventory/inventories',compact('dealers'));
    }

    public function csvImport(Request $request){
       
        $file=$request->product_data;

       if(!empty($file))
       {
            if(!$file->isValid()){
                return response()->json(['success' => false,'message' => $file->getErrorMessage()]);
            }
            else{
                $filename = Carbon::now()->timestamp.'.csv';
                $file->storeAs('public',$filename);
                $importcsv = new ImportCsv;
                $importcsv->name = $filename;
                $importcsv->save();
                return response()->json(['success' => true,'message' => 'success','filename' => $filename]);
            }

        }

        $file = $request->file;
        $file_path =  storage_path('app/public/'.$file);

        $ext = @end(explode('.',$file_path));
        $handle = @fopen( $file_path, "r");
        

        if ($request->process_csv) {

            $dealer_id = $request->dealer_id;

            $file = $request->filename;
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
                "lastupdated" => "-1",
                "custom1" => "-1",
                "custom2" => "-1",
                "custom3" => "-1",
                "custom4" => "-1",
                "custom5" => "-1",
                "lastphotoupdateutc" => "-1",
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

            // foreach ($csv as $i=>$row) {
                $x = 0;
                while (($row = fgetcsv($handle, 4096)) !== false) {
                

                    if($x++ == 0)
                    {  
                        $row = array_map("strtolower", $row);
                        $keys = array_map("snake_case", $row);
                        //dd($keys);
                        continue;
                    }
                    
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

                $product = [];
                $product_options = [];
                $product_sub_options = [];
                $product_images = [];
                
                $dealer_data = [];
                $dealer_id = $data['dealer_id'] ?? $data['dealerid'] ?? $data['dealer_i_d'] ?? $request->dealer_id;
                $dealer = Dealer::where('dealer_id', $dealer_id)->count();
                
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
                    else if(strstr($field, 'date'))
                    { 
                        $date = str_replace('/', '-', $data[$field]);
                        $data[$field] = date('Y-m-d', strtotime($date));
                        $product[$field] = date('Y-m-d', strtotime($date));
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
            
                $date = Carbon::now();
                $product['created_at'] = $date;
                $product['updated_at'] = $date;
                try{
                    \DB::beginTransaction();    
                    $product_insert = [];
                    foreach($db_csv_mapping as $dbfield => $csv_header_field )
                    {
                        $product_insert[$dbfield] = $product[$csv_header_field];
                    } 
    
                $product_insert['dealer_id'] = $dealer_id;
                
                $pid = Product::insertGetId($product_insert);
    
    
    
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
               ProductOption::insert($product_options);
               if(!empty($dealer_data))
                {
                    $dealer_data['dealer_id'] = $dealer_id;
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
                //dump($data);
                //dd($e->getMessage());
                //\LaravelSweetAlert::setMessageError($e->getMessage());
    
                return response()->json(['success' => false,'message' => $e->getLine().':'.$e->getMessage()]);
            }
    
            }

            \LaravelSweetAlert::setMessageSuccess("Data imported Successfuly");
            return response()->json(['success' => true,'message' => 'success']);

        }
        else
        {
            try{
                $x = 0;
                while (($row = fgetcsv($handle, 4096)) !== false) {
                

                    if($x++ == 0)
                    {  
                        break;
                    }
                }

                $csv_headers = $row;
                $headers = array_map("strtolower", $csv_headers);
                $headers = array_map("snake_case", $headers);
                }
                catch(\Exception $e)
                {   
                    \LaravelSweetAlert::setMessageError($e->getMessage());
                    return redirect()->back();
                }
    

            $DBcolumns = \Schema::getColumnListing('products');
            unset($DBcolumns[array_search('id', $DBcolumns)]);
            unset($DBcolumns[array_search('created_at', $DBcolumns)]);
            unset($DBcolumns[array_search('updated_at', $DBcolumns)]);

            $csv_dropdown = array_combine($headers,$csv_headers);
        }
        return view('admin/inventory/csvimport',compact('file','csv_dropdown','DBcolumns'));
    }


    public function processCSVGeneral($request)
    {
        $file = $request->filename;
        $db_csv_mapping = collect($request->colums)->filter(function($item){
            return $item != -1;
        });
        

        $dealer_data_fields = [
            'dealer_address',
            'dealer_city',
            'dealer_state',
            'dealer_zip',
            'dealer_phone',
            'dealer_fax',
        ];

        // foreach ($csv as $i=>$row) {
            $x = 0;
            while (($row = fgetcsv($handle, 4096)) !== false) {
            

                if($x++ == 0)
                {  
                    $row = array_map("strtolower", $row);
                    $keys = array_map("snake_case", $row);
                    //dd($keys);
                    continue;
                }
                
                try{

                    $data = array_combine($keys, $row);
                    dd($data);
                }
                catch(\Exception $e)
                {   
                    $data = [];
                    foreach($keys as $key => $field)
                    {
                        $data[$field] = $csv[$key] ?? '';
                    }
                }

            $product = [];
            $product_options = [];
            $product_sub_options = [];
            $product_images = [];
            
            $dealer_data = [];
            $dealer_id = $data['dealer_id'] ?? $data['dealerid'] ?? $data['dealer_i_d'];
            $dealer = Dealer::where('dealer_id', $dealer_id)->count();
            
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
                else if(strstr($field, 'date'))
                { 
                    $date = str_replace('/', '-', $data[$field]);
                    $data[$field] = date('Y-m-d', strtotime($date));
                    $product[$field] = date('Y-m-d', strtotime($date));
                }
                if(strstr($field,'price'))
                {
                    $data[$field] = floatval($data[$field]);
                    $product[$field] = floatval($data[$field]);
                }
                else if(strstr($field,'mpg'))
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
                $product_insert = [];
                foreach($db_csv_mapping as $dbfield => $csv_header_field )
                {
                    $product_insert[$dbfield] = $product[$csv_header_field];
                } 
               
            $pid = Product::insertGetId($product_insert);



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
           ProductOption::insert($product_options);
           if(!empty($dealer_data))
            {
                $dealer_data['dealer_id'] = $dealer_id;
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
            return response()->json(['success' => false,'message' => $e->getLine().':'.$e->getMessage()]);
        }

        }

        \LaravelSweetAlert::setMessageSuccess("Data imported Successfuly");
        return response()->json(['success' => true,'message' => 'success']);
    }

    public function ajaxFileCheck(ProductsImport $request){

      $file  = $request->file('products_data');

      if(!$file->isValid()){
          return response()->json(['success' => false,'message' => $file->getErrorMessage()]);
      }
      else{
          $filename = Carbon::now()->timestamp.'.csv';
          $file->storeAs('public',$filename);
          $importcsv = new ImportCsv;
          $importcsv->name = $filename;
          $importcsv->save();
          return response()->json(['success' => true,'message' => 'success','filename' => $filename]);
      }
    }

    public function getInventory(){
        $products=Product::with('images','dealer');
        return Datatables::of($products)->make(true);
    }

    public function dealerDetails($id){
        $dealer = Dealer::where('dealer_id',$id)->get();
        //dd(is_Null($dealer[0]->state) || $dealer[0]->state === '' );
        $dealerproduct = $dealer[0]->dealerproduct();
        return view('admin/inventory/dealerdetails',compact('dealer','dealerproduct'));
    }

    public function getMoreContent(Request $request){
        $id_val=explode('_',$request->id);
        if($id_val[1]=='featured'){
            return $id_val[1];
        }
        elseif($id_val[1]=='recent'){
            $productrecent=Product::with(['images'])->orderBy('created_at','desc')->offset($id_val[0])->limit(8)->get();
            $type = $id_val[1];
            $val= intval($id_val[1])+8;
            //dd($productrecent);
            return  view('frontend/ajax/getmorecontent',compact('productrecent','type','val'));
        }
    }
    
    //return view feactured image
    public function feacturedImage(Request $request){
        try{
            $getdata = UploadImage::first();
            return view('admin/feacturedImage/uploadImage',compact('getdata'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    //upload feacture Image
    public function uploadFeacturedImage(Request $request){
        try{
            
            //get data from image
            $getImage = UploadImage::first();
            
            if(empty($getImage)){
                $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'image' => 'required|mimes:jpeg,png,bmp,tiff'
                ]);
            }else{
                if($getImage->image != ""){
                    $request->validate([
                        'title' => 'required',
                        'description' => 'required'
                    ]); 
                }else{
                    $request->validate([
                        'title' => 'required',
                        'description' => 'required',
                        'image' => 'required|mimes:jpeg,png,bmp,tiff'
                    ]);
                }
            }
            
            
            //upload image
            if ($request->hasFile('image')) {
                $destinationPath = public_path() . '/new_ui/feactureImage'; // upload path
                $extension = $request->image->getClientOriginalExtension(); // getting image
                $fileName = rand(11111111, 99999999) . '.' . $extension; // renameing image
                $request->image->move($destinationPath, $fileName); // uploading file to given path
                $request->image = $fileName;
            }
            
            if(empty($getImage)){
                $save = UploadImage::create(['title' => $request->title,'description' => $request->description,"image" => $fileName]);
            }else{
                $save = UploadImage::where('id',$getImage->id)->update(['title' => $request->title,'description' => $request->description,"image" => $getImage->image]);
            }
            
            if($save){
                \LaravelSweetAlert::setMessageSuccess("Image Upload Successfuly");
                return redirect()->back();
               
            }else{
                \LaravelSweetAlert::setMessageSuccess("Image Not Upload Successfuly");   
                return redirect()->back();
            }
            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
	
	//return view marketcheck import
    public function marketCheckImport(Request $request){
        try{
            $data = Settings::all();
			$keyfound = false;
			$settingsData = array();
			if( !empty($data) ){
				foreach($data as $fields){
					if( $fields->slug == 'market_check_api_key' ){
						$keyfound = true;
					}
				}
			}
			return view('admin/marketcheck-import/marketcheck-import',compact('keyfound'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
	
	
	
	
	//return view marketcheck import inventory page
    public function marketImportInventory(Request $request){
        try{
			$settingsObj = \DB::table('settings')->select('value')->where('slug','market_check_api_key')->get()->first();
			if( !empty($settingsObj) ){
				$api_key = $settingsObj->value;
				$results = [];
				$car_conditions = array('new', 'used', 'certified');
				foreach($car_conditions as $condition){
					$curl = curl_init();
					curl_setopt_array
					(
						$curl, 
						array(
							CURLOPT_URL => "http://api.marketcheck.com/v1/search?api_key=". $api_key ."&car_type=".$condition,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => "",
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => false,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => "GET",
							CURLOPT_HTTPHEADER => array(
									"Host: marketcheck-prod.apigee.net"
							),
						)
					);
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);
					if ($err) {
					  continue;
					} else {
						$results[] = $response;
					}
				}
				// Read JSON file
				//$json = file_get_contents('marketcheck.json');
				$feed = array();
				if( !empty($results) ){
					foreach($results as $result){
						$res_data = json_decode($result, true);
						if( !empty($res_data) && isset($res_data['listings'])){
							foreach($res_data['listings'] as $item){
								$feed[] = $item;
							}
						}						
					}
				}
				
				//Decode JSON
				if($request->session()->has('mcheck_api_feed')){
					$request->session()->forget('mcheck_api_feed');
				} 
				$request->session()->put('mcheck_api_feed',$feed);
				$field_array = array();
				if( !empty($feed) ){
					$field_array = array('year','make','model','trim','body','doors','engine_cylinders','engine_displacement','transmission','drivetrain','engine_description','engine_block_type','highway_mpg','city_mpg','exterior_color','interior_color','miles','selling_price','msrp','dealer_id','type','stock','vin','products_image');
				}
				return view('admin/marketcheck-import/marketcheck-import-page',compact('field_array'));
			}	
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
	public function processInventory(Request $request){
		try{
			$inventory_imported = $processed_inv = array();
			if($request->session()->has('mcheck_api_feed')){
				$csvdata = $request->session()->get('mcheck_api_feed');
				$field_array['year']              = 'build&&year';
				$field_array['make']              = 'build&&make';
				$field_array['model']             = 'build&&model';
				$field_array['trim']              = 'build&&trim';
				$field_array['body']              = 'build&&body_type';
				$field_array['doors']             = 'build&&doors';
				$field_array['enginecylinders']   = 'build&&cylinders';
				$field_array['enginedisplacement']= 'build&&engine_size';
				$field_array['transmission']      = 'build&&transmission';
				$field_array['drivetrain']        = 'build&&drivetrain';
				$field_array['engine_description']= 'build&&engine';
				$field_array['engine_block_type'] = 'build&&engine_block';
				$field_array['highwaympg']        = 'build&&highway_miles';
				$field_array['citympg']           = 'build&&city_miles';
				$field_array['certified']         = 'is_certified';
				$field_array['exteriorcolor']     = 'exterior_color';
				$field_array['interiorcolor']     = 'interior_color';
				$field_array['miles']             = 'miles';
				$field_array['sellingprice']      = 'price';
				$field_array['msrp']              = 'msrp';
				$field_array['dealer_id']         = 'dealer&&id';
				$field_array['type']              = 'inventory_type';
				$field_array['stock']             = 'stock_no';
				$field_array['vin']               = 'vin';
				$field_array['products_image']    = 'media&&photo_links';
				if( !empty($csvdata) ){
					$import_array = array();
					foreach( $csvdata as $csv ){
						$csvfield = array();
						foreach( $field_array as $field => $csv_field ){
							if (strpos($csv_field, '&&') !== false) {
								$key = explode("&&", $csv_field);
								if( isset( $csv[$key[0]][$key[1]] ) ){
									$csvfield[$field] = $csv[$key[0]][$key[1]];
								}
							} else if( isset($csv[$csv_field]) ) {
								if($field == 'certified'){
									$csvfield[$field] = ($csv[$csv_field] == 1)? 'True':'False';
								}else{
									$csvfield[$field] = $csv[$csv_field];
								}
							}
						}
						$import_array[] = $csvfield;
					}
					if( !empty($import_array) ){
						$inventory_arr = array();
						$inventory_imported = array();
						foreach($import_array as $car_item){
							// check car already exists
							$car = \DB::table('products')->where('vin',$car_item['vin'])->get()->first();
							if( empty($car) && isset($car_item['dealer_id']) && !empty($car_item['dealer_id']) ){
								// get dealer information from database
								$dealerObj = \DB::table('dealer')->select('dealer_id')->where('dealer_id',$car_item['dealer_id'])->get()->first();
								
								// If not found, get info througn API call and insert into db
								$dealer_id = '';
								if( empty($dealerObj) ){
									$dealer_feed = array();
									$settingsObj = \DB::table('settings')->select('value')->where('slug','market_check_api_key')->get()->first();
									$api_key = $settingsObj->value;
									$curl = curl_init();
									curl_setopt_array
									(
										$curl, 
											array(
												CURLOPT_URL => "http://api.marketcheck.com/v1/dealer/". $car_item['dealer_id'] ."?api_key=".$api_key,
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_ENCODING => "",
												CURLOPT_MAXREDIRS => 10,
												CURLOPT_TIMEOUT => 0,
												CURLOPT_FOLLOWLOCATION => false,
												CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
												CURLOPT_CUSTOMREQUEST => "GET",
												CURLOPT_HTTPHEADER => array(
														"Host: marketcheck-prod.apigee.net"
												),
											)
										);
										$response = curl_exec($curl);
										$err = curl_error($curl);
										curl_close($curl);
										if ($err) {
										  continue;
										} else {
											$dealer_feed = json_decode($response, true);
											if((isset($dealer_feed['id']) && !empty($dealer_feed['id']))){
												$dealer_ins_arr = array(
													'dealer_id' => $dealer_feed['id'],
													'name'      => isset($dealer_feed['seller_name'])? $dealer_feed['seller_name']:'',
													'phone'     => isset($dealer_feed['seller_phone'])? $dealer_feed['seller_phone']:'',
													'address'   => isset($dealer_feed['street'])? $dealer_feed['street']:'',
													'city'      => isset($dealer_feed['city'])? $dealer_feed['city']:'',
													'state'     => isset($dealer_feed['state'])? $dealer_feed['state']:'',
													'zip'       => isset($dealer_feed['zip'])? $dealer_feed['zip']:'',
													'website'   => isset($dealer_feed['inventory_url'])? $dealer_feed['inventory_url']:'',
													'created_at'=> date('Y-m-d H:i:s'),
													'updated_at'=> date('Y-m-d H:i:s'),
													'latitude'  => isset($dealer_feed['latitude'])? $dealer_feed['latitude']:'',
													'longitude' => isset($dealer_feed['longitude'])? $dealer_feed['longitude']:'',
												);
												// INSERT DEALER INTO DB
												if( !empty($dealer_feed) ){
													$dealer_id = \DB::table('dealer')->insertGetId($dealer_ins_arr);
												}
											} else {
												continue;
											}
										}
										
								} else {
									$dealer_id = $dealerObj->dealer_id;
								}
								
								
								if( !empty($dealer_id) ){
									$car_img = $car_item['products_image'];
									unset($car_item['products_image']);
									$car_item['dealer_id'] = $dealer_id;
									$product_id = \DB::table('products')->insertGetId($car_item);
									$inventory_arr[$product_id] = $car_img;
									$inventory_imported[$product_id] = $car_item['type']. ' ' .$car_item['year']. ' ' .$car_item['make']. ' ' .$car_item['model'];
								}								
							} 
						}
						if( !empty($inventory_arr) ){
							$product_ids = array_keys($inventory_arr);
							foreach($inventory_arr as $id => $image_arr){
								foreach($image_arr as $key => $image_url){
									// upload image
									/*$extension = pathinfo($image_url, PATHINFO_EXTENSION);
									if( empty($extension) ){ continue; }
									//Store in the filesystem.
									if( ! is_dir(public_path().'/images/product_images') ){
										mkdir(public_path().'/images/product_images');
									}
									try{
										$ch = curl_init();  
										curl_setopt($ch, CURLOPT_HEADER, 0); 
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
										curl_setopt($ch, CURLOPT_URL, $image_url); 		  
										$data = curl_exec($ch); 
										curl_close($ch);
										$filenm = public_path()."/images/product_images/". $id ."-". ($key+1) . '-' . time() .'.'. $extension;
										if( !empty($data) ){
											file_put_contents( $filenm, $data );
										} else {
											continue;
										}										
									} catch (Exception $e){
										continue;
									}*/
								
								
									$car_item_img_arr = array(
										'product_id'  => $id,
										'image'       => $image_url,
										'active'      => 1,
										'created_at'  => date('Y-m-d H:i:s'),
										'updated_at'  => date('Y-m-d H:i:s'),
										'imported'    => 1,
										'original_url'=> $image_url,
									);
									$img_id[] = \DB::table('products_image')->insertGetId($car_item_img_arr);									
								}
							}
						}						
					}
				}
			}
			return view('admin/marketcheck-import/marketcheck-import-result',compact('inventory_imported'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
	}
	
	//return view API settings page
    public function siteSettings(Request $request){
        try{
            $data = Settings::all();
			$settingsData = array();
			if( !empty($data) ){
				foreach($data as $fields){
					if( !empty($fields->value) ){
						$settingsData[$fields->slug] = $fields->value;
					}
				}
			}
			return view('admin/settings/settings',compact('settingsData'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
	
	//Save site settings
    public function saveSiteSettings(Request $request){
		try{
            $request->validate([
				'market_check_api_key' => 'required'                    
            ]);
            $data = $request->all();
			
			if( isset($data['_token']) ){
			   unset($data['_token']);
			}
			if( !empty($data) ){
				foreach($data as $field => $value){
					$getSettings = Settings::where('slug',$field)->get()->toArray();
					if( !empty($getSettings) ){
						$save = Settings::where('slug',$field)->update(['value' => $value]);
					} else {
						$save = Settings::create([
							'name' => ucwords( str_replace("_", " ", $field) ),
							'slug' => $field,
							'value' => $value
						]);
					}
				}
			}                
            if($save){
                \LaravelSweetAlert::setMessageSuccess("Settings Successfully Saved");
                return redirect()->back();
               
            }else{
                \LaravelSweetAlert::setMessageSuccess("Error on saving settings");   
                return redirect()->back();
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
