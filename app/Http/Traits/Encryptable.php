<?php

namespace App\Http\Traits;

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    public function getEncryptable(){
        return property_exists($this, 'encryptable') ? $this->encryptable : [];
    }

    /**
     * decryptIt
     *
     *
     * @param  string  $key key
     * @return array result
     */
    public function decryptIt($key)
    {
        try {
            $thisEncrypter = new Encrypter(config('constants.p_key'), 'AES-256-CBC');

            return $thisEncrypter->decrypt($key);
        } catch (\Exception $e) {
            Log::info("decryptIt => ".$e->getMessage());
        }
    }

    /**
     * encryptIt
     *
     *
     * @param  string  $key key
     * @return array result
     */
    public function encryptIt($key)
    {
        try {
            $thisEncrypter = new Encrypter(config('constants.p_key'), 'AES-256-CBC');

            return $thisEncrypter->encrypt($key);
        } catch (\Exception $e) {
            Log::info("encryptIt => ".$e->getMessage());
        }
    }

    /**
     * encryptPKey
     *
     *
     * @param  string  $key key
     * @return array result
     */
    public function getAttribute($key)
    {
        try {
            $value = parent::getAttribute($key);
            if (in_array($key, $this->encryptable)) {
                $value = Crypt::decrypt($value);
            }

            return $value;
        } catch (\Exception $e) {
            Log::info("getAttribute => ".$e->getMessage());
        }
    }

    /**
     * decryptPKey
     *
     *
     * @param  string  $key key
     * @return array result
     */
    public function setAttribute($key, $value)
    {
        try {
            if (in_array($key, $this->encryptable)) {
                $value = Crypt::encrypt($value);
            }

            return parent::setAttribute($key, $value);
        } catch (\Exception $e) {
            Log::info("setAttribute => ".$e->getMessage());
        }
    }

    public function attributesToArray()
    {
        $attributes = parent::attributesToArray(); // call the parent method
        foreach ($this->encryptable as $key) {
            if (isset($attributes[$key])){
                $attributes[$key] = Crypt::decrypt($attributes[$key]);
            }
        }
        return $attributes;
    }
}
