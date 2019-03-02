<?php

namespace App\Console\Commands;

use App\Jobs\ImageImportJob;
use App\Jobs\FeatureImportJob;
use App\Jobs\ProductImportJob;
use Illuminate\Console\Command;

class DispachJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispach:job';

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
        // dump("Dealer Import started");
        // dispatch(new App\Jobs\DealerImportJob);
        dump("Product Import started");
        dispatch(new ProductImportJob);
        dump("Feature Import started");
        dispatch(new FeatureImportJob);
        dump("Image Import started");
        dispatch(new ImageImportJob);
    }
}
