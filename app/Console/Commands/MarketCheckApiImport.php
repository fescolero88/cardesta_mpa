<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Dealer;

class MarketCheckApiImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:import_dealers {rows?}{radius?}{url?} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from the market check api';

    public $url;

    public $radius =100000;
    public $url_index = 0;

    public $start = 0;
    public $max_rows = 0;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = [
            'http://marketcheck-prod.apigee.net/v1/dealers?api_key='.env('MARKET_CHECK_API_KEY').'&latitude=43.1856307&longitude=-77.7565881',
            'http://marketcheck-prod.apigee.net/v1/dealers?api_key='.env('MARKET_CHECK_API_KEY').'&latitude=34.05&longitude=-118.24',
            'http://marketcheck-prod.apigee.net/v1/dealers?api_key='.env('MARKET_CHECK_API_KEY').'&latitude=39.73&longitude=-104.99'
        ];
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = $this->start;
        $row = $this->argument('rows') ?? 50;
        $url = $this->argument('url')??$this->url[$this->url_index];
        $radius = $this->argument('radius')??$this->radius;
        $clienturl = $url.'&radius='.$radius.'&start='.$start.'&rows='.$row.'&sort_by=id&sort_order=desc';
        try{
            $client = new Client();
            $res = $client->get($clienturl);
            $status = $res->getStatusCode();
            $response = $res->getBody();
            $response = json_decode($response);
        }
        catch(\Exception $e)
        {
            dump("Error : ".$e->getMessage());
            $this->handle();
        }
        if(empty($response))
        {
            dd("empty response");
        }
        $this->insertDealers($response->dealers,$row);
        if($this->start >= $response->num_found)
        {
            $this->url_index++;
            $this->start = 0;
            if($this->url_index > count($this->url))
            {
                $this->url_index = 0;
            }
            $this->handle();
            dump("Total {$this->max_rows} rows imported.");
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
            $checking=Dealer::where('dealer_id',$dealer->id)->count();
            if($checking == 0){
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
