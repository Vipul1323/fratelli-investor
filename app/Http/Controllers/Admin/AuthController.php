<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ForgotPassword;
use App\Models\AdminSettings;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hashids\Hashids;
use App\Models\User;
use Carbon\Carbon;
use Mail;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * POST: Login to Admin
     *
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request){
        if ($request->isMethod('post')) {
            $remember = $request->has('remember') ? true : false;
            $userObj = Admin::where('email', $request->email)->whereNull('deleted_at')->first();

            if (empty($userObj)) {
                $request->session()->flash('error', trans('flash.invalid_credentials.message'));
                return redirect()->back();
            }

            if (! $userObj->is_active) {
                $request->session()->flash('error', trans('flash.inactive_account.message'));
                return redirect()->back();
            }

            if ($userObj->is_block) {
                $request->session()->flash('error', trans('flash.inactive_account.message'));
                return redirect()->back();
            }

            if (Auth::guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ], $remember)) {
                return redirect('admin/dashboard');
            } else {
                $request->session()->flash('error', trans('flash.invalid_credentials.message'));
                return redirect()->back();
            }
        } else {
            $validator = Admin::jsRules('cmsSigninRules', $request->all());
            return view('cms.signin')->with(['validator' => $validator]);
        }
    }

    public function checkemail(Request $request){
        try {
            if (! empty($_POST['id'])) {
                $users = User::where('email', $_POST['email'])->where('id', '!=', $_POST['id'])->first();
            } else {
                $users = User::where('email', $_POST['email'])->first();
            }

            if (! empty($users)) {
                return '1';
            } else {
                return '2';
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * Show the admin's forgot password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request){
        if ($request->isMethod('post')) {
            $validator = Admin::rules('cmsForgotPasswordRules', $request->all());

            if ($validator->passes()) {
                /*Generate and Save Reset Token*/
                $admin = Admin::where('email', $request->email)
                ->first();
                if (empty($admin)) {
                    return redirect()->back()->with('error', 'Email not exist');
                }

                $reset_token = md5($admin->id.Carbon::now());

                $admin->reset_token = $reset_token;
                $admin->save();

                /*Send reset password email*/
                $admin->notify(new ForgotPassword());

                $request->session()->flash('success', trans('flash.forgot_link_sent.message'));

                return redirect()->back();
            } else {
                return view('admin.forgot-password')
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            $validator = Admin::jsRules('cmsForgotPasswordRules', $request->all());
            return view('cms.forgot-password')->with(['validator' => $validator]);
        }
    }

    /**
     * Reset Password
     * Used for reset password of Admin
     *
     * @param  Request  $request
     */
    public function resetPassword(Request $request){
        try {
            if ($request->isMethod('get')) {
                if (isset($request['reset_token'])) {
                    $user = Admin::where('reset_token', $request['reset_token'])->first();
                    if (! empty($user)) {
                        if ($user->is_active == 0) {
                            $request->session()->flash('error', trans('flash.inactive_account.message'));
                            return redirect('/admin/signin/');
                        } else {
                            $validator = Admin::jsRules('cmsResetPasswordRules', $request->all());
                            return view('cms.reset-password')->with([
                                'validator' => $validator,
                                'user' => $user,
                            ]);
                        }
                    } else {
                        $request->session()->flash('error', trans('flash.token_expired.message'));
                        return redirect('/admin/signin/forgot-password');
                    }
                }
            }

            if ($request->isMethod('post')) {
                try {
                    /*Validate request Params*/
                    $validator = Admin::rules('cmsResetPasswordRules', $request->all());

                    if ($validator->passes()) {
                        $hashids = new Hashids();
                        $user_id = $hashids->decode($request['id'])[0];

                        $user = Admin::findOrFail($user_id);
                        $user->reset_token = '';
                        $user->password = bcrypt($request->password);
                        $user->save();

                        $request->session()->flash('success', trans('flash.password_reset_success.message'));

                        return redirect('/admin/signin/');
                    } else {
                        return redirect()->back()->withErrors($validator->errors())->with(compact('request'));
                    }
                } catch (\Exception $e) {
                    $request->session()->flash('error', $e->getMessage());
                    return redirect()->back();
                }
            }
            return redirect('/admin/signin');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect('/admin/signin');
        }
    }

    /**
     * Reset Password
     * Used for reset password of User
     *
     * @param  Request  $request
     */
    public function resetPasswordUser(Request $request){
        try {
            if ($request->isMethod('get')) {
                if (isset($request['reset_token'])) {
                    $user = User::where('reset_token', $request['reset_token'])->first();

                    if (! empty($user)) {
                        if ($user->is_active == 0) {
                            $request->session()->flash('error', trans('flash.inactive_account.message'));
                            return redirect('/admin/signin');
                        } else {
                            $validator = Admin::jsRules('cmsResetPasswordRules', $request->all());
                            return view('cms.reset-password-user')->with([
                                'validator' => $validator,
                                'user' => $user,
                            ]);
                        }
                    } else {
                        $request->session()->flash('error', trans('flash.token_expired.message'));
                        return redirect('/');
                    }
                }
            }

            if ($request->isMethod('post')) {
                try {
                    /*Validate request Params*/
                    $validator = Admin::rules('cmsResetPasswordRules', $request->all());

                    if ($validator->passes()) {
                        $hashids = new Hashids();
                        $user_id = $hashids->decode($request['id'])[0];

                        $user = User::find($user_id);
                        $user->reset_token = '';
                        $user->password = bcrypt($request->password);
                        $user->save();

                        $request->session()->flash('success', trans('flash.password_reset_success.message'));
                        return redirect('/');
                    } else {
                        return redirect()->back()->withErrors($validator->errors())->with(compact('request'));
                    }
                } catch (\Exception $e) {
                    $request->session()->flash('error', $e->getMessage());
                    return redirect()->back();
                }
            }
            return redirect('/admin/signin');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect('/admin/signin');
        }
    }

    /**
     * Returns field name to use at login.
     *
     * @return string
     */
    public function username(){
        return config('auth.providers.users.field', 'email');
    }

    /**
     * Logout
     * Used for logout user from the site
     *
     * @param void
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/signin');
    }
}
