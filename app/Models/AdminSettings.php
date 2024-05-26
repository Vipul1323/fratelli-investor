<?php

namespace App\Models;

use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Storage;

class AdminSettings extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_settings';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    protected $hidden = [
        'image',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'subject',
        'title',
        'description',
        'image',
        'type',
        'setting_type',
        'value',
        'is_active',
        'created_at',
        'updated_at',
        'slug',
    ];

    /*Validation Custom Messages*/
    public static function messages(){
        return [
            'description.required' => trans('messages.Please enter laboratory name.'),
        ];
    }

    //1. form
    protected static function cmsEditEmailPageRules($id = 0){
        $rules = [
            'description' => 'required',
            'subject' => 'required',
        ];

        return $rules;
    }

    protected static function cmsEditPageRules($id = 0){
        $rules = [
            'description' => 'required',
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function getPagesImageAttribute(){
        try {
            if (! empty($this->image)) {
                if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                    return $this->image;
                }

                $disk = Storage::disk(env('FILESYSTEM_DISK', 'public'));
                $command = $disk->getDriver()->getAdapter()->getClient()->getCommand('GetObject', [
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $this->image,
                ]);
                $request = $disk->getDriver()->getAdapter()->getClient()->createPresignedRequest($command, '+3600 minutes');

                $generate_url = (string) $request->getUri();

                return $generate_url;
            } else {
                return asset('img/avatar_simple_visitor.png');
            }
        } catch (\Exception $e) {
            return asset('img/avatar_simple_visitor.png');
        }
    }
}
