<?php

namespace App\Console;

use App\Notifications\CronNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * 
         * Fetch data from fet every day
         * 
         */
        $file = storage_path('logs/ftp_import_'.date("Y-m-d").'.txt');
        $schedule->command('csv:ftp_import')->daily()
        ->sendOutputTo($file)
        ->after(function (){            
                \Mail::raw('CSV product import from FTP', function ($message) {
                    $message->subject("Daily CSV import");
                    $message->to('david@cdsautos.com')->bcc('riazcool77@gmail.com');
                    $message->attach(storage_path('logs/ftp_import_'.date("Y-m-d").'.txt'));
                });
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
