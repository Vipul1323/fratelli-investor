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
    use HasFactory;

    protected $fillable = [
        'endpoint',
        'method',
        'response_body',
        'status_code',
        'requested_at',
        'responded_at',
        'status',
        'error_message',
    ];

    protected $casts = [
        'response_body' => 'array',
        'requested_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public static function logApiCall($endpoint, $method, $response)
    {
        ApiLog::create([
            'endpoint' => $endpoint,
            'method' => $method,
            'response_body' => $response->getBody(),
            'status_code' => $response->getStatusCode(),
            'requested_at' => now(),
            'responded_at' => now(),
            'status' =>$response->getStatusCode() == 200 ? 'success' : 'failed',
            'error_message' =>$response->getStatusCode() == 200 ? null : $response->getBody(),
        ]);
    }

    public static function makeApiCall()
    {
        $settings = SiteSettings::select('marketstack_key', 'marketstack_endpoint', 'api_call_per_minute')->first();
        $dateFrom = date('Y-m-d', strtotime("-100 days"));
        $dateTo = date('Y-m-d', strtotime("-90 days"));
        $apiKey = $settings->marketstack_key;
        $stockSymbol = "TINNATFL.XBOM";
        $stockSymbol = "AAPL";

        $queryString = http_build_query([
            'access_key' => $apiKey,
            'symbols' => $stockSymbol,
            //'interval' => '5min'
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

        self::logApiCall($endpoint, "GET", $response);

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
                $tradeObj->last = $trade->last;
                $tradeObj->low = $trade->low;
                $tradeObj->close = $trade->close;
                $tradeObj->volume = $trade->volume;
                $tradeObj->save();
            }
        }
    }
}
