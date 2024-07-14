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
            'response_body' => $response['status'] == 'error' ? json_encode($response['errors']) : json_encode($response),
            'status_code' => $response['status_code'],
            'requested_at' => now(),
            'responded_at' => now(),
            'status' => $response['status'] == 'success' ? 'success' : 'failed',
            'error_message' => $response['status'] == 'success' ? null : json_encode($response),
        ]);
    }

    public static function getTinnaStockHistoryData()
    {
        $symbol = "INE401Z01019";
        Log::channel('api')->info("=============getTinnaStockDetails================");
        $endpoint = "https://api.upstox.com/v2/historical-candle/BSE_EQ|INE401Z01019/day/".date('Y-m-d')."/2011-01-01";

        $siteSettings = SiteSettings::first();
        $headers = [
            'Authorization: Bearer '.$siteSettings->upstocks_token,
            'Cookie: __cf_bm=krT..Ezm9tEq79zqwMu7MemcK9iLCmiemacVrIdz.vc-1718429854-1.0.1.1-j3mrEf6G_L5F2ODeOKZ6D5udUlt2H7DZ0HtC.5vtFPjBhI6hfOUJO_taGJsiFfyT; _cfuvid=7ZQ9LBIAeZd3jNoe27gBJj3pa9vo0NmIN472iRF.PK8-1718429854067-0.0.1.1-604800000'
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        $response['status_code'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        Log::channel('api')->info('Response => '.json_encode($response));


        curl_close($curl);
        ApiLog::logApiCall($endpoint, $response);
        if($response['status'] == 'success' && isset($response['data']['candles'])){
            $data = $response['data']['candles'];
            Log::channel('api')->info("Get Stock Details Completed");
            foreach ($data as $key => $value) {

                $tradeObj = TradeData::where('date_on', date('Y-m-d H:i:s', strtotime($value[0])))->where('symbol', 'TINNATFL')->first();
                if(empty($tradeObj)){
                    $tradeObj = new TradeData();
                }
                $tradeObj->date_on = date('Y-m-d H:i:s', strtotime($value[0]));
                $tradeObj->symbol = "TINNATFL";
                $tradeObj->exchange = "BSE";
                $tradeObj->open = $value[1];
                $tradeObj->high = $value[2];
                $tradeObj->low = $value[3];
                $tradeObj->close = $value[4];
                $tradeObj->volume = $value[5];
                $tradeObj->last = $value[1];
                $tradeObj->net_change = 0;
                $tradeObj->save();
            }

        }else{
            ApiLog::logApiCall($endpoint, $response);
            Log::channel('api')->error('||============Error in getTinnaStockDetails============||');
            Log::channel('api')->error('|| Error => '.json_encode($response['errors']));
            Log::channel('api')->error('||============Error in getTinnaStockDetails============||');
        }
    }

    public static function getTinnaStockDetails()
    {
        $symbol = "INE401Z01019";
        Log::channel('api')->info("=============getTinnaStockDetails================");
        $endpoint = "https://api.upstox.com/v2/market-quote/quotes?instrument_key=BSE_EQ|".$symbol;
        $siteSettings = SiteSettings::first();
        $headers = [
            'Authorization: Bearer '.$siteSettings->upstocks_token,
            'Cookie: __cf_bm=krT..Ezm9tEq79zqwMu7MemcK9iLCmiemacVrIdz.vc-1718429854-1.0.1.1-j3mrEf6G_L5F2ODeOKZ6D5udUlt2H7DZ0HtC.5vtFPjBhI6hfOUJO_taGJsiFfyT; _cfuvid=7ZQ9LBIAeZd3jNoe27gBJj3pa9vo0NmIN472iRF.PK8-1718429854067-0.0.1.1-604800000'
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        $response['status_code'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        Log::channel('api')->info('Response => '.json_encode($response));
        curl_close($curl);
        ApiLog::logApiCall($endpoint, $response);
        if($response['status'] == 'success' && isset($response['data'])){
            $data = $response['data'];
            Log::channel('api')->info("Get Stock Details Completed");
            if(isset($data['BSE_EQ:TINNATFL'])){
                $stockData = $data['BSE_EQ:TINNATFL'];
                $tradeObj = TradeData::where('date_on', date('Y-m-d', strtotime($stockData['timestamp'])))->where('symbol', 'TINNATFL')->first();
                if(empty($tradeObj)){
                    $tradeObj = new TradeData();
                }
                $tradeObj->date_on = date('Y-m-d', strtotime($stockData['timestamp']));
                $tradeObj->symbol = "TINNATFL";
                $tradeObj->exchange = "BSE";
                $tradeObj->open = $stockData['ohlc']['open'];
                $tradeObj->high = $stockData['ohlc']['high'];
                $tradeObj->low = $stockData['ohlc']['low'];
                $tradeObj->close = $stockData['ohlc']['close'];
                $tradeObj->volume = $stockData['volume'];
                $tradeObj->last = $stockData['last_price'];
                $tradeObj->net_change = $stockData['net_change'];
                $tradeObj->save();

                TradeData::whereNot('id', $tradeObj->id)->where('symbol','TINNATFL')->whereDate('date_on', date('Y-m-d'))->delete();
            }

        }else{
            ApiLog::logApiCall($endpoint, $response);
            Log::channel('api')->error('||============Error in getTinnaStockDetails============||');
            Log::channel('api')->error('|| Error => '.json_encode($response['errors']));
            Log::channel('api')->error('||============Error in getTinnaStockDetails============||');
        }
    }

    public static function getBseStockDetails()
    {
        $symbol = "SENSEX";
        Log::channel('api')->info("=============getBseStockDetails================");
        $endpoint = "https://api.upstox.com/v2/market-quote/quotes?instrument_key=BSE_INDEX|".$symbol;
        $siteSettings = SiteSettings::first();
        $headers = [
            'Authorization: Bearer '.$siteSettings->upstocks_token,
            'Cookie: __cf_bm=krT..Ezm9tEq79zqwMu7MemcK9iLCmiemacVrIdz.vc-1718429854-1.0.1.1-j3mrEf6G_L5F2ODeOKZ6D5udUlt2H7DZ0HtC.5vtFPjBhI6hfOUJO_taGJsiFfyT; _cfuvid=7ZQ9LBIAeZd3jNoe27gBJj3pa9vo0NmIN472iRF.PK8-1718429854067-0.0.1.1-604800000'
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        $response['status_code'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        Log::channel('api')->info('Response => '.json_encode($response));
        curl_close($curl);
        ApiLog::logApiCall($endpoint, $response);
        if($response['status'] == 'success' && isset($response['data'])){
            $data = $response['data'];
            Log::channel('api')->info("Get Stock Details Completed");
            if(isset($data['BSE_INDEX:SENSEX'])){
                $stockData = $data['BSE_INDEX:SENSEX'];
                $tradeObj = TradeData::where('date_on', date('Y-m-d', strtotime($stockData['timestamp'])))->where('symbol', 'BSE')->first();
                if(empty($tradeObj)){
                    $tradeObj = new TradeData();
                }
                $tradeObj->date_on = date('Y-m-d', strtotime($stockData['timestamp']));
                $tradeObj->symbol = 'BSE';
                $tradeObj->exchange = "BSE";
                $tradeObj->open = $stockData['ohlc']['open'];
                $tradeObj->high = $stockData['ohlc']['high'];
                $tradeObj->low = $stockData['ohlc']['low'];
                $tradeObj->close = $stockData['ohlc']['close'];
                $tradeObj->volume = $stockData['volume'];
                $tradeObj->last = $stockData['last_price'];
                $tradeObj->net_change = $stockData['net_change'];
                $tradeObj->save();

                TradeData::whereNot('id', $tradeObj->id)->where('symbol','BSE')->whereDate('date_on', '<', date('Y-m-d', strtotime('-5 day')))->delete();

            }

        }else{
            ApiLog::logApiCall($endpoint, $response);
            Log::channel('api')->error('||============Error in getBseStockDetails============||');
            Log::channel('api')->error('|| Error => '.json_encode($response['errors']));
            Log::channel('api')->error('||============Error in getBseStockDetails============||');
        }
    }

    public static function getUpstocksToken(){
        Log::channel('api')->info("=============getUpstocksToken================");
        $endpoint = "https://api.upstox.com/v2/login/authorization/token";
        $siteSettings = SiteSettings::first();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Cookie' => '__cf_bm=krT..Ezm9tEq79zqwMu7MemcK9iLCmiemacVrIdz.vc-1718429854-1.0.1.1-j3mrEf6G_L5F2ODeOKZ6D5udUlt2H7DZ0HtC.5vtFPjBhI6hfOUJO_taGJsiFfyT; _cfuvid=7ZQ9LBIAeZd3jNoe27gBJj3pa9vo0NmIN472iRF.PK8-1718429854067-0.0.1.1-604800000'
        ];
        $queryString = http_build_query([
            'code' => $siteSettings->upstocks_code,
            'client_id' => '8d96393e-817c-4a95-a3e6-701cd773cbc6',
            'client_secret' => '76r2etin5b',
            'redirect_uri' => 'https://investor-relations.fratelliwines.in/',
            'grant_type' => 'authorization_code'
        ]);

        Log::channel('api')->info("QueryString => ".$queryString);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $queryString,
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        $response['status_code'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        Log::channel('api')->info('Response => '.json_encode($response));
        curl_close($curl);
        if(isset($response['access_token'])){
            $response['status'] = 'success';
        }else{
            $response['status'] = 'error';
        }
        ApiLog::logApiCall($endpoint, $response);
        if(isset($response['access_token'])){
            $siteSettings->upstocks_token = $response['access_token'];
            $siteSettings->save();
            Log::channel('api')->info("API Token Saved Successfully");
        }else{
            Log::channel('api')->error('||============Error in getUpstocksToken============||');
            Log::channel('api')->error('|| Error => '.json_encode($response['errors']));
            Log::channel('api')->error('||============Error in getUpstocksToken============||');
        }

        Log::channel('api')->info("=============getUpstocksToken End================");
    }
}
