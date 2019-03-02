<?php

namespace App\Console\Commands;

use App\ProductImage;
use Illuminate\Console\Command;

class XmlImageSiteMapGenerate extends Command
{
    public $file_name = 'sitemap/images/sitemap_images.xml';
    public $total;
    public $chunk;
    public $progress;
    public $current_date;
    public $generated_url=0;
    public $filecount = 0;
    public $start = 0;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:imagesitemap {chunk?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sitemap_images.xml generation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->total = ProductImage::count();
        $this->current_date = date('Y-m-dTH:M:D');
        $this->file_name = "sitemap/images/sitemap_images".$this->filecount.".xml";
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
        <?xml-stylesheet type=\"text/xsl\" href=\"/sitemap.xsl\"?>
        <urlset
            xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
            xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
            xmlns:xhtml=\"http://www.w3.org/1999/xhtml\"
            xmlns:image=\"http://www.google.com/schemas/sitemap-image/1.1\"
            xsi:schemaLocation=\"
                    http://www.sitemaps.org/schemas/sitemap/0.9
                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">
        ";

    try{
            \Storage::disk('public_direct')->put($this->file_name, $xml);
            $this->info("Generating ImageSitemap");
           $this->progress = $this->output->createProgressBar($this->total);
           $this->start = 0;
            $from = $this->start;
            $to = 0;
            ProductImage::with('product')->chunk($this->chunk, function ($images) use(&$from,&$to){
                $this->generated_url +=$this->chunk;
                if($this->generated_url<=50000){
                    \Storage::disk('public_direct')->append($this->file_name, $this->xmlgenerate($images));
                    $to = $this->start += count($images);
                }
                else{
                    \Storage::disk('public_direct')->append($this->file_name, "</urlset>");
                    $this->progress->clear();
                    $this->info("File Saved : ".$this->file_name."  [$from - $to]");
                    \Storage::disk('public_direct')->append('robots.txt',"\nSitemap: ".secure_asset($this->file_name));
                    $this->createNewFileInstance(++$this->filecount);
                    \Storage::disk('public_direct')->append($this->file_name, $this->xmlgenerate($images));
                    $from = $this->start;
                    $to = $this->start += count($images);
                    $this->generated_url +=$this->chunk;
                }
                $this->progress->advance();
            });

            \Storage::disk('public_direct')->append($this->file_name, "</urlset>");
            $this->progress->finish();
            $this->progress->clear();
            $this->info("File Saved : ".$this->file_name);
            \Storage::disk('public_direct')->append('robots.txt',"\nSitemap: ".secure_asset($this->file_name));
            $this->info("ImageSitemap Generation Complet !!");
        }
        catch(Exception $e)
        {
            $this->error("Error Generating ImageSitemap");
            $this->error($e->getMessage());
        }



    }

    public function xmlgenerate($images){

        $xml = "<url>
       <loc>https://www.xml-sitemaps.com/</loc>
       <lastmod>".$this->current_date."</lastmod>
       <changefreq>daily</changefreq>
       <priority>1.0000</priority>";
        foreach($images as $image){
            $prod = $image->product;
            if(empty($image->image)) continue;
            $xml.=
                "
       <image:image>
         <image:loc>".$image->image."</image:loc>
         <image:caption>".ucfirst($prod->type).' '.$prod->year.' '.$prod->make.' '.$prod->model."</image:caption>
       </image:image>
     ";
        }

        return $xml."</url>";
    }

    public function createNewFileInstance($count){
        $this->file_name = "sitemap/images/sitemap_images".$count.".xml";
        $this->generated_url=0;
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <?xml-stylesheet type=\"text/xsl\" href=\"/sitemap.xsl\"?>
        <urlset
            xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
            xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
            xmlns:xhtml=\"http://www.w3.org/1999/xhtml\"
            xmlns:image=\"http://www.google.com/schemas/sitemap-image/1.1\"
            xsi:schemaLocation=\"
                    http://www.sitemaps.org/schemas/sitemap/0.9
                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">
        ";
        \Storage::disk('public_direct')->put($this->file_name, $xml);
        $this->progress->display();
    }
}
