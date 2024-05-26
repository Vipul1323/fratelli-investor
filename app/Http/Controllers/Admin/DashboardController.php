<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class DashboardController extends Controller
{

    public function __construct(){
    }


    /**
     * Dashboard
     * View Dashboard
     *
     * @param  Request  $request
     * @param  int  $id
     */
    public function dashboard(Request $request){
        $user = User::where(['role_id' => 4])->count();

        $with = [
            'users' => $user,
        ];

        return view('cms.dashboard')->with($with);
    }
}
