<?php

namespace App\Providers;

use App\Models\SiteSettings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        // get email view data in provider class
        $configuration = SiteSettings::first();

        if (! is_null($configuration)) {
            $mailConfig = [
                'driver' => $configuration->mail_mailer,
                'host' => $configuration->mail_host,
                'port' => $configuration->mail_port,
                'username' => $configuration->mail_username,
                'password' => $configuration->mail_password,
                'encryption' => $configuration->mail_encryption,
                'from' => [
                    'address' => env('MAIL_FROM_ADDRESS', $configuration->mail_username),
                    'name' => env('MAIL_FROM_NAME', 'Vaya'),
                ],
            ];
            // Config::set('mail', $mailConfig);

            $s3Config = [
                'key' => $configuration->aws_access_key,
                'secret' => $configuration->aws_secret_key,
                'region' => $configuration->aws_region,
                'bucket' => $configuration->aws_bucket,
                'url' => $configuration->aws_url,
                //'password'   =>     $configuration->aws_folder,
            ];
            // Config::set('filesystems.disks.s3', $s3Config);
        }
    }
}
