<?php

namespace App\Console\Commands;

use App\Product;
use App\ProductImage;
use App\ProductOption;
use Illuminate\Console\Command;

class removeDuplicateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:remove_duplicates';

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
        while($row = \DB::select('SELECT products.vin FROM products INNER JOIN (SELECT products.vin FROM products GROUP BY vin HAVING COUNT(vin) > 1) dup ON products.vin = dup.vin LIMIT 0,1'))
        {
            dump("Product VIN : {$row[0]->vin}");
            $products = Product::where('vin',$row[0]->vin)->orderBy('id','desc')->get()->pluck('id')->flatten();
            $products->shift();
            try{
                \DB::beginTransaction();
                    // ProductOption::whereIn('product_id',$products)->delete();
                    // ProductImage::whereIn('product_id',$products)->delete();
                    // Product::whereIn('id',$products)->delete();
                \DB::commit();
                dump("Products Deleted : ".json_encode($products));
            } catch (\Exception $e) {
                \DB::rollBack();
                dump($e->getMessage());
            }
        }
    }
}
