<?php

namespace App\Console\Commands;

use App\Dealer;
use App\Product;
use Illuminate\Console\Command;

class XmlSiteMapGenerate extends Command
{
    public $file_name = 'sitemap/inventory/sitemap_inventory.xml';
    public $total;
    public $chunk;
    public $progress;
    public $current_date;
    public $generated_url = 0;
    public $filecount = 0;
    public $start = 0;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:sitemap {chunk?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sitemap_inventory.xml generation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->total = Product::count();
        $this->current_date = date('d-m-Y');
        $this->file_name = "sitemap/inventory/sitemap_inventory".$this->filecount.".xml";
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->chunk = $this->argument('chunk') ?? 1000;

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                
                <urlset xmlns=\"https://www.sitemaps.org/schemas/sitemap/0.9\">
            ";
    try{
            \Storage::disk('public_direct')->put($this->file_name, $xml);
            $this->info("Generating Sitemap");
            $this->progress = $this->output->createProgressBar($this->total);
            $this->start = 0;
            $from = $this->start;
            $to = 0;
            Product::with('dealer')->chunk($this->chunk, function ($products) use(&$from,&$to){
                $this->generated_url +=$this->chunk;
                if($this->generated_url<=50000){
                    \Storage::disk('public_direct')->append($this->file_name, $this->xmlgenerate($products));
                    $to = $this->start += count($products);
                }
                else{
                    \Storage::disk('public_direct')->append($this->file_name, "</urlset>");
                    $this->progress->clear();
                    $this->info("File Saved : ".$this->file_name."  [$from - $to]");
                    \Storage::disk('public_direct')->append('robots.txt',"\nSitemap: ".secure_asset($this->file_name));
                    $this->createNewFileInstance(++$this->filecount);
                    \Storage::disk('public_direct')->append($this->file_name, $this->xmlgenerate($products));
                    $from = $this->start;
                    $to = $this->start += count($products);
                    $this->generated_url +=$this->chunk;
                }
                $this->progress->advance();
            });

            
            \Storage::disk('public_direct')->append($this->file_name, "</urlset>");
            $this->progress->finish();
            $this->progress->clear();
            $this->info("File Saved : ".$this->file_name."  [{$this->start} - {$this->total}]");
            \Storage::disk('public_direct')->append('robots.txt',"\nSitemap: ".secure_asset($this->file_name));
            $this->info("Sitemap Generation Complet !!");
        }
        catch(Exception $e)
        {
            $this->error("Error Generating Sitemap");
            $this->error($e->getMessage());
        }



    }

    public function xmlgenerate($products){

        $xml = '';
        foreach($products as $product){
            if(empty($product->dealer)) continue;
            $xml.=
                "
            <url>

                <loc>".route('list_details',['dealername'=> $product->dealer->dealer_slug ?? makeslug($product->dealer->name,$product->dealer->dealer_id),'city'=> makeslug($product->dealer->city,"city"),'vin'=>$product->vin,'make'=>makeslug($product->make,"make"),'model'=>makeslug($product->model,"model")])."</loc>

                <lastmod>". $this->current_date."</lastmod>

                <changefreq>monthly</changefreq>

                <priority>1.0</priority>

            </url>";
        }

        return $xml;
    }

    public function xmlgenerate_dealer($dealers){

        $xml = '';
        foreach($dealers as $dealer)
        {
    
                $xml.=
                    "
                    <url>

                        <loc>".route('list',['dealername'=>$dealer->dealer_slug,'id'=>$dealer->dealer_id,'zip'=>makeslug($dealer->zip,"zip")])."</loc>

                        <lastmod>". $this->current_date."</lastmod>

                <changefreq>monthly</changefreq>

                <priority>1.0</priority>

                </url>";
        }

        return $xml;
    }

    public function createNewFileInstance($count){
        $this->file_name = "sitemap/inventory/sitemap_inventory".$count.".xml";
        $this->generated_url=0;
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                
                <urlset xmlns=\"https://www.sitemaps.org/schemas/sitemap/0.9\">
            ";
        \Storage::disk('public_direct')->put($this->file_name, $xml);
        $this->progress->display();
    }
}
