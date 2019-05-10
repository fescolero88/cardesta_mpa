<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Dealer;
use App\Product;
use App\ProductImage;
use GuzzleHttp\Client;

class ProductImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url="http://marketcheck-prod.apigee.net/v1/search?api_key=";

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
        $this->url .= env('MARKET_CHECK_API_KEY');
    }

 

    public function get_products($dealer)
    {
        $start = $this->start;
        $rows =  50;
        $clienturl = $this->url."&dealer_id=".$dealer->dealer_id.'&start='.$start.'&rows='.$rows.'&sort_by=id&sort_order=desc';
        $client = new Client();
        $res = $client->get($clienturl);
        $status = $res->getStatusCode();
        $response = $res->getBody();
        $response = json_decode($response);
        if(!empty($response))
        {
            if(empty($response->listings))
            {
                dump("DealerID: {$dealer->dealer_id} No listing found");
                $dealer->update(['product_import' => 1]); 
                return;
            }
            $total_dealer_products = $response->num_found;

            $return = $this->importinventory($response->listings,$dealer);

            $this->inserted += $return['total_inserted'];
            $this->skipped += $return['products_skipped'];

            dump("DealerID: {$dealer->dealer_id}  Imported={$return['total_inserted']}/{$return['total_listing']} Skipped={$return['products_skipped']}  Total Imported={$this->inserted}/{$total_dealer_products} Total Skipped={$this->skipped} Total Rows={$this->total_inserted}");
            if($return['total_listing'] <= $total_dealer_products)
            {
                $this->start += $rows;
                $this->get_products($dealer);
            }
        }
        else
        {
            dump("DealerID: {$dealer->dealer_id} No response");
        }
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        while($dealer=$this->getdealerid())
        {
            $this->total_inserted += $this->inserted;

            $this->start = 0;
            $this->inserted = 0;
            $this->skipped = 0;
            dump("Importing inventory for DealerID: {$dealer->dealer_id}");
            $this->get_products($dealer);
        }

        dump("Total products Imported {$this->total_inserted}");
    }

    public function getdealerid(){
        $dealer = Dealer::whereIn('product_import',[0,2])->orderBy('id','asc')->first();
        return $dealer;
    }

    public function importinventory($listings,$dealer){
        $total_products = count($listings);
        $products_inserted = 0;
        $products_skipped = 0;
        
        foreach($listings as $list){
        
           if(Product::where('market_check_api_id',$list->id)->count())
           {
            $products_skipped++;
               continue;
           }

                try {
                    \DB::beginTransaction();
                    $id = \DB::table('products')->insertGetId(
                        [
                            'dealer_id' => $list->dealer->id ?? '',
                            'type' => $list->inventory_type ?? '',
                            'stock' => $list->stock_no ?? '',
                            'vin' => $list->vin ?? '',
                            'year' => $list->build->year ?? '',
                            'make' => $list->build->make ?? '',
                            'model' => $list->build->model ?? '',
                            'body' => $list->build->body_type ?? '',
                            'trim' => $list->build->trim ?? '',
                            'doors' => $list->build->doors ?? '',
                            'exteriorcolor' => $list->exterior_color ?? '',
                            'interiorcolor' => $list->interior_color ?? '',
                            'enginecylinders' => $list->build->cylinders ?? '',
                            'enginedisplacement' => explode(' ', ($list->build->engine ?? 'none'))[0] ?? '',
                            'transmission' => $list->build->transmission ?? '',
                            'miles' => $list->miles ?? '',
                            'sellingprice' => floatval($list->price ?? 0.00) ?? '',
                            'msrp' => $list->msrp ?? '',
                            'engine_block_type' => $list->build->engine_block ?? '',
                            'drivetrain' => $list->build->drivetrain ?? '',
                            'fuel_type' => $list->build->fuel_type ?? '',
                            'citympg' => floatval($list->build->city_miles ?? 0.00),
                            'highwaympg' => floatval($list->build->highwaymiles ?? 0.00),
                            'passengercapacity' => $list->build->std_seating ?? '',
                            'market_check_api_id' => $list->id,
                            'latitude' => $dealer->latitude,
                            'longitude' => $dealer->longitude,
                            'distance' => $dealer->distance,
                            'zip'=>$dealer->zip,
                        ]
                    );
                    $images = [];

                    foreach ($list->media->photo_links as $photo) {
                        // // check image url is valid
                        // $handle = curl_init($photo);
                        //     curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

                        //     /* Get the HTML or whatever is linked in $url. */
                        //     $response = curl_exec($handle);

                        //     /* Check for 404 (file not found). */
                        //     $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        //     if($httpCode == 200) {
                                
                        //        continue;
                        //     }

                        //     curl_close($handle);

                            $images[] = [
                                'product_id' => $id,
                                'image' => $photo,
                                'active' => 1,
                            ];
                    }
                    // insert the images
                    ProductImage::insert($images);
                    // dealer products  imported successfully
                    $dealer->update(['product_import' => 1]);
                    \DB::commit();
                    $products_inserted++;
                    
                    
                } catch (\Exception $e) {
                    \DB::rollBack();
                    // import failed
                    $dealer->update(['product_import' => 2]);
                    dump('product did not imported' . ' Error : ' . $e->getMessage());
                }
        
        }

        return [
            'total_listing' => $total_products,
            'total_inserted' => $products_inserted,
            'products_skipped' => $products_skipped
         ];

    }
}
