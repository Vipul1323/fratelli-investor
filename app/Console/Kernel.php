<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use GuzzleHttp\Client;
use App\Models\TradeData;
use App\Models\SiteSettings;
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
            $settings = SiteSettings::select('marketstack_key', 'marketstack_endpoint', 'api_call_per_minute')->first();

            Log::info("Cron run");

            $dateFrom = date('Y-m-d', strtotime("-5 days"));
            $dateTo = date('Y-m-d');
            $apiKey = $settings->marketstack_key;
            $stockSymbol = "TINNATFL.XBOM";
            //$stockSymbol = "AAPL";

            $queryString = http_build_query([
                'access_key' => $apiKey,
                'symbols' => $stockSymbol,
                'date_from' => $dateFrom,
                'date_to' => $dateTo
            ]);

            $endpoint = $settings->marketstack_endpoint."?".$queryString;

            $client = new Client();
            $response = $client->request('GET', $endpoint);
            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();


            Log::info('Endpoint => '.$endpoint);
            Log::info('Status Code => '.$statusCode);
            Log::info('responseBody => '.$responseBody);

            $body = json_decode($responseBody);

            if(isset($body->data) && count($body->data) > 0){
                foreach($body->data as $trade){
                    $tradeObj = TradeData::where('date_on', date('Y-m-d H:i:s', strtotime($trade->date)))->first();
                    if(empty($tradeObj)){
                        $tradeObj = new TradeData();
                    }
                    $tradeObj->date_on = date('Y-m-d H:i:s', strtotime($trade->date));
                    $tradeObj->symbol = $trade->symbol;
                    $tradeObj->exchange = $trade->exchange;
                    $tradeObj->open = $trade->open;
                    $tradeObj->high = $trade->high;
                    $tradeObj->low = $trade->low;
                    $tradeObj->close = $trade->close;
                    $tradeObj->volume = $trade->volume;
                    $tradeObj->adj_open = $trade->adj_open;
                    $tradeObj->adj_high = $trade->adj_high;
                    $tradeObj->adj_low = $trade->adj_low;
                    $tradeObj->adj_close = $trade->adj_close;
                    $tradeObj->adj_volume = $trade->adj_volume;
                    $tradeObj->save();
                }
            }

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
