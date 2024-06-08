<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use GuzzleHttp\Client;
use App\Models\TradeData;
use App\Models\SiteSettings;
use App\Models\ApiLog;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule){

        $schedule->call(function(){
            $stockSymbol = "TINNATFL.XBOM";
            //$stockSymbol = "AAPL";
            ApiLog::makeApiCall($stockSymbol);

        })->everyMinute();

        $schedule->call(function(){
            $stockSymbol = "BSE.XNSE";
            ApiLog::makeApiCall($stockSymbol);

        })->everyMinute();
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
