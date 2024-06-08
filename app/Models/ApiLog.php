<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiteSettings;
use App\Models\TradeData;
use GuzzleHttp\Client;
use Log;

class ApiLog extends Model
{
    protected $table = "api_logs";

    protected $fillable = [
        'endpoint',
        'method',
        'request_headers',
        'request_body',
        'response_headers',
        'response_body',
        'status_code',
        'requested_at',
        'responded_at',
        'status',
        'error_message',
    ];

    protected $casts = [
        'response_body' => 'array',
    ];

    public static function logApiCall($endpoint, $response)
    {
        ApiLog::create([
            'endpoint' => $endpoint,
            'method' => "GET",
            'response_body' => $response->getBody()->getContents(),
            'status_code' => $response->getStatusCode(),
            'requested_at' => now(),
            'responded_at' => now(),
            'status' => $response->getStatusCode() == 200 ? 'success' : 'failed',
            'error_message' => $response->getStatusCode() == 200 ? null : $response->getBody()->getContents(),
        ]);
    }

    public static function makeApiCall($symbol = "")
    {
        $settings = SiteSettings::select('marketstack_key', 'marketstack_endpoint', 'api_call_per_minute')->first();

        Log::info("Cron run");

        $dateFrom = date('Y-m-d', strtotime("-5 days"));
        $dateTo = date('Y-m-d');
        $apiKey = $settings->marketstack_key;

        $stockSymbol = $symbol;

        $queryString = http_build_query([
            'access_key' => $apiKey,
            'limit' => 1000
            // 'symbols' => $stockSymbol,
            // 'date_from' => $dateFrom,
            // 'date_to' => $dateTo
        ]);

        $endpoint = $settings->marketstack_endpoint."/".$stockSymbol."/eod?".$queryString;

        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $statusCode = $response->getStatusCode();
        $responseBody = $response->getBody()->getContents();


        Log::info('Endpoint => '.$endpoint);
        Log::info('Status Code => '.$statusCode);
        Log::info('responseBody => '.$responseBody);

        $body = json_decode($responseBody, true);

        if(isset($body['data']['eod']) && count($body['data']['eod']) > 0){
            foreach($body['data']['eod'] as $key =>  $trade){
                $tradeObj = TradeData::where('date_on', date('Y-m-d H:i:s', strtotime($trade['date'])))->where('symbol', $stockSymbol)->first();
                if(empty($tradeObj)){
                    $tradeObj = new TradeData();
                }
                $tradeObj->date_on = date('Y-m-d H:i:s', strtotime($trade['date']));
                $tradeObj->symbol = $trade['symbol'];
                $tradeObj->exchange = $trade['exchange'];
                $tradeObj->open = $trade['open'];
                $tradeObj->high = $trade['high'];
                $tradeObj->low = $trade['low'];
                $tradeObj->close = $trade['close'];
                $tradeObj->volume = $trade['volume'];
                //$tradeObj->last = $trade['last'];
                $tradeObj->save();
            }
        }
        ApiLog::logApiCall($endpoint, $response);
        return $response;
    }
}
