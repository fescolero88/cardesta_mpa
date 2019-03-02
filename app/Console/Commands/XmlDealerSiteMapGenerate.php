<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Dealer;

class XmlDealerSiteMapGenerate extends Command
{
    public $file_name = 'sitemap/main/sitemap.xml';
    public $total;
    public $chunk;
    public $process = 0;
    public $current_date;
    public $generated_url = 0;
    public $filecount =1;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:sitemapdealer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sitemap.xml generation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->total = Dealer::count();
        $this->current_date = date('d-m-Y');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->chunk = 1000;

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                
                <urlset xmlns=\"https://www.sitemaps.org/schemas/sitemap/0.9\">

                <url>

                    <loc>".url()->to('/')."</loc>

                    <lastmod>". $this->current_date."</lastmod>

                    <changefreq>monthly</changefreq>

                    <priority>1.0</priority>

                </url>

                <url>

                    <loc>".url()->to('/inventory')."</loc>

                    <lastmod>".$this->current_date."</lastmod>

                    <changefreq>monthly</changefreq>

                    <priority>1.0</priority>

                </url>

                <url>

                    <loc>".url()->to('/dealers')."</loc>

                    <lastmod>".$this->current_date."</lastmod>

                    <changefreq>monthly</changefreq>

                    <priority>1.0</priority>

                </url>
            ";
        try{
            \Storage::disk('public_direct')->put($this->file_name, $xml);
            $this->info("Generating Sitemap");
            $this->output->progressStart($this->total);

            Dealer::chunk($this->chunk, function ($dealers){
                $this->output->progressAdvance();
                \Storage::disk('public_direct')->append($this->file_name, $this->xmlgenerate_dealer($dealers));
            });

            $this->output->progressFinish();
            \Storage::disk('public_direct')->append($this->file_name, "</urlset>");
            $this->info("Sitemap Generation Complet !!");
            $this->info("File Saved : ".$this->file_name);
            \Storage::disk('public_direct')->append('robots.txt',"\nSitemap: ".secure_asset($this->file_name));
        }
        catch(Exception $e)
        {
            $this->error("Error Generating Sitemap");
            $this->error($e->getMessage());
        }

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
}
