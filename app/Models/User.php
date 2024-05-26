<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Traits\Encryptable;
use Hashids\Hashids;
use Carbon\Carbon;
use Validator;
use Storage;
use Log;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, LaratrustUserTrait, SoftDeletes, Encryptable;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(){
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'role_id',
        'last_name',
        'phone_number',
        'country_code',
        'email',
        'birth_date',
        'password',
        'image',
        'gender',
        'device_type',
        'reset_token',
        'device_token',
        'is_active',
        'remember_token',
        'access_token',
        'last_logged_in',
        'last_logged_out',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'image',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $appends = [
        'profile_image',
    ];

    protected $encryptable = [
    ];

    /*Global Scope for Admin*/
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot(){
        parent::boot();

        static::addGlobalScope('user_roles', function (Builder $builder) {
            $builder->where('role_id', '=', env('USER_ROLE', 4));
        });

        self::created(function (User $userObj) {
            $userObj->attachRole(env('USER_ROLE', 4));
        });
    }

    /*Validation Rules*/

    //1. Admin signin form
    protected static function cmsSigninRules($id = 0){
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        return $rules;
    }

    //2. Admin forgot password
    protected static function cmsForgotPasswordRules($id = 0){
        $rules = [
            'email' => 'required|email|exists:users,email,role_id,2',
        ];

        return $rules;
    }

    //3. Admin reset password
    protected static function cmsResetPasswordRules($id = 0){
        $rules = [
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];

        return $rules;
    }

    //6. Add subadmin form
    protected static function AddSubAdminRules($id = 0){
        $rules = [
            'first_name' => 'required|without_spaces|max:20',
            'last_name' => 'required|without_spaces|max:20',
            'password' => 'required',
            'email' => 'required|email|max:60|unique:users,email,'.$id.',id,deleted_at,NULL',
        ];

        return $rules;
    }

    /*Validator - Model*/
    public static function rules($method, $requestdata = null, $id = 0, $role_id = 2){
        $validator = Validator::make($requestdata, self::{$method}($id, $requestdata), self::messages());
        return $validator;
    }

    /*Validator - Javascript - Front-end*/
    public static function jsRules($method, $id = 0){
        $validator = \JsValidator::make(self::{$method}($id), self::messages());

        return $validator;
    }

    /*Validation messages*/
    public static function messages(){
        return [
            'email.required' => trans('validation.email_required.message'),
            'email.email' => trans('validation.email_format.message'),
            'email.exists' => trans('validation.email_exists.message'),
            'password.required' => trans('validation.password_required.message'),
            'password.min' => trans('validation.password_min.message'),
            'confirm_password.required' => trans('validation.confirm_password_required.message'),
            'confirm_password.same' => trans('validation.confirm_password_same.message'),
            'first_name.without_spaces' => trans('validation.without_space.message'),
            'last_name.without_spaces' => trans('validation.without_space.message'),
        ];
    }

    /*Relations*/

    /*Methods*/

    public function forgotPassword($user, $platform = 'app'){
        if (! empty($user) && empty($user->forgot_token)) {
            $forgot_token = md5($user->id.date('Y-m-d H:i:s'));
        } else {
            $forgot_token = $user->forgot_token;
        }

        $user->forgot_token = $forgot_token;
        try {
            $user->save();
            $flag = true;
        } catch (\Exception $e) {
            $flag = false;
        }
        if ($flag) {
            try {
                /*Send email*/
                Mail::send('emails.forgot_password', [
                    'user' => $user,
                    'platform' => $platform,
                ], function ($m) use ($user) {
                    $m->to($user['email'])->subject(env('PROJECT_NAME').' : Reset Password Request');
                });
            } catch (\Exception $e) {
            }
        }

        return $flag;
    }

    public function editField($id, $field, $value){
        $flag = false;
        $user = User::fine($id);
        if (isset($user->$field)) {
            $user->$field = $value;
            try {
                $user->save();
                $flag = true;
            } catch (\Exception $e) {
                $flag = false;
            }
        }

        return $flag;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function getProfileImageAttribute(){
        try {
            if (! empty($this->image)) {
                if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                    return $this->image;
                }

                $image = url($this->image);
                return $image;
            } else {
                return asset('img/avatar_simple_visitor.png');
            }
        } catch (\Exception $e) {
            Log::error('Error While accessing profile image');
            Log::info('user => '.$this->id);

            return asset('img/avatar_simple_visitor.png');
        }
    }

    /**
     * The attributes that should be decode id.
     *
     * @return string
     */
    public function getEncodeIdAttribute(){
        $this->Hashids = new Hashids();

        return $this->Hashids->encode($this->attributes['id']);
    }

    /**
     * The attributes that should be decode id.
     *
     * @return string
     */
    public function getDecodeIdAttribute($encode_hex = ''){
        $this->Hashids = new Hashids();

        return $this->Hashids->decode($encode_hex)[0];
    }

    public function getCreatedDateAttribute(){
        if (! empty($this->created_at)) {
            return Carbon::parse($this->created_at)->format('jS F, Y h:i:s');
        }
    }

    public function getUpdatedDateAttribute(){
        if (! empty($this->updated_at)) {
            return Carbon::parse($this->updated_at)->format('jS F, Y h:i:s');
        }
    }

    public function getNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    public function getActiveAttribute(){
        return $this->is_active ? "Active" : "In-Active";
    }

    public function getBlockAttribute(){
        return $this->is_block ? "Blocked" : "Un-Blocked";
    }

    public function getGenderNameAttribute(){
        $genderArray = config('constants.gender');
        return $genderArray[$this->gender];
    }

    public function getLastLoginDateAttribute(){
        if (! empty($this->last_logged_in)) {
            return Carbon::parse($this->last_logged_in)->format('jS F, Y h:i:s');
        }
    }
}
