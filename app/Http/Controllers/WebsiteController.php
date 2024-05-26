<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use Illuminate\Http\Request;
use App\Models\TradeData;
use App\Models\Category;
use App\Models\Media;

class WebsiteController extends Controller
{
    public function index(Request $request){
        $folders = Category::whereNull('parent_id')->get();
        $settings = AdminSettings::where('slug', 'about_us')->first();
        $breadCrumbsArray = [];

        return view('website.index', compact('folders', 'breadCrumbsArray', 'settings'));
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
        $tradeData = TradeData::all();

        $tradeDataArray = [];
        foreach($tradeData as $trade){
            $tradeDataArray[] = [
                $trade->date_on,
                $trade->open
            ];
        }

        return response()->json($tradeDataArray, 200);
    }
}
