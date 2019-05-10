<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use GuzzleHttp\Client;
use App\Dealer;

class DealerImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $url;

    public $radius =100;

    public $start = 0;
    public $max_rows = 0;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = 'http://marketcheck-prod.apigee.net/v1/dealers?api_key='.env('MARKET_CHECK_API_KEY').'&latitude=43.1856307&longitude=-77.7565881';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = $this->start;
        $row = 50;
        $url = $this->url;
        $radius = $this->argument('radius')??$this->radius;
        $clienturl = $url.'&radius='.$radius.'&start='.$start.'&rows='.$this->argument('rows').'&sort_by=id&sort_order=desc';
        $client = new Client();
        $res = $client->get($clienturl);
        $status = $res->getStatusCode();
        $response = $res->getBody();
        $response = json_decode($response);
        if(empty($response))
        {
            dd("empty response");
        }
        $this->insertDealers($response->dealers,$row);
        if($this->start >= $response->num_found)
        {
            dd("Total {$this->max_rows} rows imported.");
        }

        $this->max_rows = $response->num_found;

        $this->start = $this->start + $row;
        //dd($response->dealers);
        dump("Rows importing {$this->start}");
        $this->handle();
    }

    public function insertDealers($dealers){
        $count=0;
        foreach($dealers as $dealer){
            $checking=Dealer::where('dealer_id',$dealer->id)->get();
            if($checking->isEmpty()){
               $newdealer=new Dealer;
               $newdealer->dealer_id=$dealer->id;
               $newdealer->name=$dealer->seller_name;
               $newdealer->phone= $dealer->seller_phone ?? '';
               $newdealer->email=$dealer->seller_email??'';
               $newdealer->address=$dealer->street??'';
               $newdealer->state=$dealer->state??'';
               $newdealer->zip=$dealer->zip??'';
               $newdealer->city=$dealer->city??'';
               $newdealer->fax=$dealer->seller_fax??'';
               $newdealer->website=$dealer->inventory_url??'';
               $newdealer->latitude=$dealer->latitude??'';
               $newdealer->longitude=$dealer->longitude??'';
               $newdealer->distance=$dealer->distance??'';
               $newdealer->save();
               $count++;
            }
        }
        dump("{$count} dealers added");
        return true;

    }
}
