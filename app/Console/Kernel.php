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
        Log::channel('api')->info("============================= Schedule Run Triggered =========================");

        // $schedule->call(function(){
        //     ApiLog::getUpstocksToken();
        // })->dailyAt('8:30');

        // exit;


        $schedule->call(function(){
            ApiLog::getTinnaStockDetails();

        })->weekdays()->between('8:45', '23:40')->everyMinute();

        $schedule->call(function(){
            ApiLog::getBseStockDetails();
        })->weekdays()->between('8:45', '23:40')->everyMinute();
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
