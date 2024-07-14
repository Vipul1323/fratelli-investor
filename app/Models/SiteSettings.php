<?php

namespace App\Models;

use App\Http\Traits\Encryptable;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class SiteSettings extends Model
{
    use SoftDeletes;
    use Encryptable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_settings';

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
        'id',
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'marketstack_key',
        'marketstack_endpoint',
        'api_call_per_minute',
        'youtube_video_link',
        'upstocks_code',
        'upstocks_token',
        'created_at',
        'updated_at',
    ];

    protected $encryptable = [
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'marketstack_key',
        'upstocks_code',
        'upstocks_token',
        'marketstack_endpoint',
        'api_call_per_minute',
    ];

    /**
     * Get updated date convertion
     *
     * @var array
     */
    public function getCreatedDateAttribute(){
        if (! empty($this->created_at)) {
            return Carbon::parse($this->created_at)->format('jS F, Y h:m:s');
        }
    }

    /**
     * Get created date convertion
     *
     * @var array
     */
    public function getUpdatedDateAttribute(){
        if (! empty($this->updated_at)) {
            return Carbon::parse($this->updated_at)->format('jS F, Y h:m:s');
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

    /*Validation Custom Messages*/
    public static function messages(){
        return [
            'mail_mailer.required' => 'Please enter mail driver/mailer',
            'mail_host.required' => 'Please enter mail host',
            'mail_port.required' => 'Please enter mail port',
            'mail_username.required' => 'Please enter mail username',
            'mail_password.required' => 'Please enter mail password',
            'mail_encryption.required' => 'Please enter mail encryption',
        ];
    }

    //1. Mail Settings Validation
    protected static function cmsMailSettingRules($id = 0){
        $rules = [
            'mail_mailer' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
        ];

        return $rules;
    }

    //2. Market API Settings Validation
    protected static function cmsMarketStackSettingRules($id = 0){
        $rules = [
            'marketstack_key' => 'required',
            'marketstack_endpoint' => 'required',
            'api_call_per_minute' => 'required',
        ];

        return $rules;
    }

    /*Validator - Model*/
    public static function rules($method, $requestdata = null, $id = 0, $role_id = 2){
        $validator = Validator::make($requestdata, self::{$method}($id), self::messages());
        return $validator;
    }

    /*Validator - Javascript - Front-end*/
    public static function jsRules($method, $id = 0){
        $validator = \JsValidator::make(self::{$method}($id), self::messages());
        return $validator;
    }
}
