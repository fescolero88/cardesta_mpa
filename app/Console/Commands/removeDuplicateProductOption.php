<?php

namespace App\Console\Commands;

use App\Product;
use App\ProductImage;
use App\ProductOption;
use Illuminate\Console\Command;

class removeDuplicateProductOption extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:remove_duplicates_options';

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
        while($option = ProductOption::where('value',0)->limit(1)->first())
        {
            try{
                $option->value = 1;
                $option->save();
            //product_id='133006' and product_options_cat_id=3 and product_options_type_id=4614
                $duplicate = ProductOption::where([
                    'product_id' => $option->product_id,
                    'product_options_cat_id' => $option->product_options_cat_id,
                    'product_options_type_id' => $option->product_options_type_id,
                    'value' => 0
                ])->count();
        
            
                    \DB::beginTransaction();
                        
                        if(!empty($duplicate))
                        {
                            ProductOption::where([
                                'product_id' => $option->product_id,
                                'product_options_cat_id' => $option->product_options_cat_id,
                                'product_options_type_id' => $option->product_options_type_id,
                                'value' => 0
                            ])->delete();
                        
                        }
                    \DB::commit();
                    dump("Options removed : ".$duplicate);
            } catch (\Exception $e) {
                \DB::rollBack();
                dump($e->getMessage());
            }
        }
    }
}
