<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use App\Models\TradeData;
use App\Models\Category;
use App\Models\Media;

class WebsiteController extends Controller
{
    public function index(Request $request){
        $folders = Category::whereNull('parent_id')->limit(8)->get();
        $settings = AdminSettings::where('slug', 'about_us')->first();
        $siteSetting = SiteSettings::select('youtube_video_link')->first()->toArray();
        $breadCrumbsArray = [];

        return view('website.index', compact('folders', 'breadCrumbsArray', 'settings', 'siteSetting'));
    }

    public function showAllFolders(Request $request){
        $folders = Category::whereNull('parent_id')->get();
        $settings = AdminSettings::where('slug', 'about_us')->first();

        return view('website.all_folders', compact('folders', 'settings'));
    }

    public function getSubFolderFiles($folder, Request $request){
        $folderObj = Category::where('id', $folder)->first();
        $subDirectory = $folderObj->children;

        //$subDirectory = Category::where('id', $folder)->get();

        return response()->json([
            'code' => 200,
            'folderName' => $folderObj->name,
            'files' => view('website.files', ['subDirectories' => $subDirectory])->render()
        ], 200);

    }

    public function getStockData(Request $request){
        $tradeData = TradeData::where('symbol', 'TINNATFL.XBOM')->get();

        $tradeDataArray = [];
        foreach($tradeData as $trade){
            $tradeDataArray[] = [
                $trade->date_on,
                $trade->open
            ];
        }

        return response()->json($tradeDataArray, 200);
    }

    public function getStockSticker(Request $request){
        $tinatrade = TradeData::where('symbol', 'TINNATFL.XBOM')->orderBy('date_on', 'desc')->limit(1)->first();
        $bsetrade = TradeData::where('symbol', 'BSE.XNSE')->orderBy('date_on', 'desc')->limit(1)->first();

        $tinnaCurrentRate = $tinatrade->close;
        $tinnaPreviousRate = $tinatrade->open;
        $tinnaRateDiff = $tinnaCurrentRate - $tinnaPreviousRate;

        if($tinnaRateDiff > 0){
            $tinnaDirection = 'up';
        }else{
            $tinnaDirection = 'down';
        }
        $tinnaRateDiff = floatval($tinnaRateDiff);
        $tinnaRatePercentage = ($tinnaRateDiff * 100) / $tinatrade->open;

        $bseCurrentRate = $bsetrade->close;
        $bsePreviousRate = $bsetrade->open;
        $bseRateDiff = $bseCurrentRate - $bsePreviousRate;

        if($bseRateDiff > 0){
            $bseDirection = 'up';
        }else{
            $bseDirection = 'down';
        }
        $bseRateDiff = floatval($bseRateDiff);
        $bseRatePercentage = ($bseRateDiff * 100) / $bsetrade->open;

        $tradeDataArray = [
            'tinna' => [
                'stock_name' => $tinatrade->symbol,
                'current_rate' => $tinatrade->close,
                'open' =>  $tinatrade->open,
                'rate_diff' => number_format($tinnaRateDiff, 2),
                'direction' => $tinnaDirection,
                'ratePercentage' => number_format($tinnaRatePercentage, 2)
            ],
            'bse' => [
                'stock_name' => $bsetrade->symbol,
                'current_rate' => $bsetrade->close,
                'open' =>  $bsetrade->open,
                'rate_diff' => number_format($bseRateDiff, 2),
                'direction' => $bseDirection,
                'ratePercentage' => number_format($bseRatePercentage, 2)
            ],
        ];

        $stockSticker = view('website.stock_sticker', compact('tradeDataArray'))->render();

        return response()->json([
            'sticker' => $stockSticker
        ], 200);
    }

    public function sendNewsletter(Request $request){
        $formData = $request->all();

        $curl = curl_init();

        $postData = [
            "EmailID" => $formData['email'],
            "SourceIP" => $request->ip(),
            "SourceTime" => date('Y-m-d H:i:s'),
            "BusinessUnit" => "Investor"
        ];

        $postData = json_encode([(object)$postData]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://data.fratelliwines.in/dataset/FratelliSubscribers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return response()->json([
            'message' => "Subscribed successfully"
        ], 200);
    }
}
