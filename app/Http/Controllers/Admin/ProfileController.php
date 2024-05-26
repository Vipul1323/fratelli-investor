<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Notifications\PasswordChanged;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hashids\Hashids;
use Carbon\Carbon;
use Config;
use Str;
use Mail;

class ProfileController extends Controller
{

    public function __construct(){
        $this->Hashids = new Hashids();
    }

    /**
     * Show the edit admin form.
     *
     * @return \Illuminate\Http\Response
     */
    public function editAdmin(Request $request){
        if ($request->isMethod('post')) {
            /*Check Validations*/
            $validator = Admin::rules('cmsEditAdminRules', $request->all());

            if ($validator->passes()) {
                $user = Auth::guard('admin')->user();

                if ($user) {
                    if (! empty($request->profile_picture)) {
                        $exists = Storage::exists($request->profile_picture);
                        if (! empty($exists)) {
                            Storage::delete($request->profile_picture);
                        }
                        $file = $request->file('profile_picture');
                        $mimeType = $file->getMimeType();
                        $extention = $file->getClientOriginalExtension();
                        $destinationPath = "uploads/profile";
                        $fileName = str_replace(" ", "_", Str::lower($user->name)).".".$extention;

                        $file->move($destinationPath,$fileName);

                        $filePath = $destinationPath."/".$fileName;
                        $user->image = $filePath;
                    } else {
                        $request->request->remove('image');
                    }

                    $user->first_name = $request['first_name'];
                    $user->last_name = $request['last_name'];
                    $user->gender = $request['gender'];
                    $user->save();

                    return redirect()->back()->with('success', trans('flash.edit_profile_success.message'));
                } else {
                    return redirect()->back()->withErrors('Something went wrong. Please try again.');
                }
            } else {
                return redirect()->back()->withErrors($validator->errors());
            }
        } else {
            $user = Auth::guard('admin')->user();
            $validator = Admin::jsRules('cmsEditAdminRules', $request->all());

            return view('cms/profile/edit-admin')->with([
                'user' => $user,
                'validator' => $validator,
            ]);
        }
    }

    /**
     * Change Password
     *
     * @param  none
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request){
        if ($request->isMethod('post')) {
            $validator1 = Admin::rules('cmsChangePasswordAdminRules', $request->all());

            if ($validator1->passes()) {
                $user = Auth::guard('admin')->user();

                $allData = $request->all();
                $user->password = bcrypt($allData['password']);
                $user->save();

                /*Send reset password email*/
                $user->notify(new PasswordChanged());

                return redirect()->back()->with('success', trans('flash.change_password_success.message'));
            } else {
                return redirect()->back()->withErrors($validator1->errors());
            }
        } else {
            $user = Auth::guard('admin')->user();
            $validator = Admin::jsRules('cmsChangePasswordAdminRules', $request->all());

            return view('cms/profile/change-password')->with([
                'user' => $user,
                'validator' => $validator,
            ]);
        }
    }
}
