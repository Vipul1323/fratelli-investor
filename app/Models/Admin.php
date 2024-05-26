<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Http\Traits\Encryptable;
use Hashids\Hashids;
use Carbon\Carbon;
use Validator;
use Storage;

class Admin extends Authenticatable
{
    use LaratrustUserTrait, SoftDeletes, Encryptable, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The table virtual fields with the model.
     *
     * @var string
     */
    //protected $appends = ['profile_image'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $encryptable = [
        // 'gender',
        // 'address',
        // 'lat',
        // 'lng',
        // 'country',
    ];

    /*Global Scope for Admin*/
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

        static::addGlobalScope('admin_roles', function (Builder $builder) {
            $builder->where('role_id', '!=', env('USER_ROLE', 4));
        });
    }

    /*Validation Rules*/

    //1. Admin signin form
    protected static function cmsSigninRules(){
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        return $rules;
    }

    //2. Admin forgot password
    protected static function cmsForgotPasswordRules(){
        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        return $rules;
    }

    /**
     * The permissions that belong to the subadmin.
     */
    public function getpermissions(){
        return $this->hasMany('App\Models\PermissionAdmin', 'user_id');
    }

    /*To check Role OR Permission condition anywhere*/
    public function hasRoleOrPermissionAndOwns($role, $permission){
        if (! $this->hasRole($role) && ! $this->can($permission)) {
            return false;
        }

        return true;
    }

    //3. Admin reset password
    protected static function cmsResetPasswordRules(){
        $rules = [
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];

        return $rules;
    }

    //4. Edit Admin
    protected static function cmsEditAdminRules(){
        $rules = [
            'first_name' => 'required|max:200',
        ];

        return $rules;
    }

    //4. Change password admin
    protected static function cmsChangePasswordAdminRules(){
        $rules = [
            'old_password' => 'required|pwdvalidation',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];

        return $rules;
    }

    /*Validator - Model*/
    public static function rules($method, $requestdata = null, $id = 0, $role_id = 2){
        $validator = Validator::make($requestdata, self::{$method}(), self::messages());

        return $validator;
    }

    /*Validator - Javascript - Front-end*/
    public static function jsRules($method){
        $validator = \JsValidator::make(self::{$method}(), self::messages());

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
            'old_password.pwdvalidation' => trans('validation.cureent_password_mismatch.message'),
        ];
    }

    public function editField($id, $field, $value){
        $flag = false;
        $user = Admin::find($id);

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

    /**
     * Get created date convertion
     *
     * @var array
     */
    public function getCreatedDateAttribute(){
        if (! empty($this->created_at)) {
            return Carbon::parse($this->created_at)->format('jS F, Y h:i:s');
        }
    }

    /**
     * Get updated date convertion
     *
     * @var array
     */
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
}
