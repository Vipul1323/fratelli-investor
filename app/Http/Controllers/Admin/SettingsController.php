<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSettings;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show the form for editing the Mail settings.
     *
     * @param  none
     * @return \Illuminate\Http\Response
     */
    public function smtpSettings(Request $request){
        if ($request->isMethod('post')) {
            $formData = $request->all();

            $settings = SiteSettings::first();
            $validator = SiteSettings::rules('cmsMailSettingRules', $formData);

            if ($validator->passes()) {
                if (empty($settings)) {
                    $settings = new SiteSettings();
                }
                $settings->mail_mailer = $formData['mail_mailer'];
                $settings->mail_host = $formData['mail_host'];
                $settings->mail_port = $formData['mail_port'];
                $settings->mail_username = $formData['mail_username'];
                $settings->mail_password = $formData['mail_password'];
                $settings->mail_encryption = $formData['mail_encryption'];

                if ($settings->save()) {
                    return redirect()->route('admin.settings-mail')
                    ->with('success', trans('flash.mail_setting_update_success.message'));
                } else {
                    return redirect()->back()->withErrors('Something went wrong. Please try again.');
                }
            } else {
                return redirect()->back()->withErrors('Something went wrong. Please try again.');
            }
        }

        $settings = SiteSettings::select('mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption')->first();
        $validator = SiteSettings::jsRules('cmsMailSettingRules', $request->all());

        return view('cms.settings.mail')->with([
            'settings' => $settings,
            'validator' => $validator,
        ]);
    }

    public function marketApiSettings(Request $request){
        if ($request->isMethod('post')) {
            $formData = $request->all();

            $settings = SiteSettings::first();
            $validator = SiteSettings::rules('cmsMarketStackSettingRules', $formData);

            if ($validator->passes()) {
                if (empty($settings)) {
                    $settings = new SiteSettings();
                }
                $settings->marketstack_key = $formData['marketstack_key'];
                $settings->marketstack_endpoint = $formData['marketstack_endpoint'];
                $settings->api_call_per_minute = $formData['api_call_per_minute'];

                if ($settings->save()) {
                    return redirect()->route('admin.settings-market-api')
                    ->with('success', "API Setting Updated");
                } else {
                    return redirect()->back()->withErrors('Something went wrong. Please try again.');
                }
            } else {
                return redirect()->back()->withErrors('Something went wrong. Please try again.');
            }
        }

        $settings = SiteSettings::select('marketstack_key', 'marketstack_endpoint', 'api_call_per_minute', 'youtube_video_link')->first();
        $validator = SiteSettings::jsRules('cmsMarketStackSettingRules', $request->all());

        return view('cms.settings.market_stack')->with([
            'settings' => $settings,
            'validator' => $validator,
        ]);
    }

    public function aboutUsText(Request $request){
        $siteSettings = SiteSettings::first();
        $settings = AdminSettings::where('slug', 'about_us')->first();
        if ($request->isMethod('post')) {
            $formData = $request->all();

            $validator = AdminSettings::rules('cmsEditPageRules', $formData);

            if ($validator->passes()) {
                if (empty($settings)) {
                    $settings = new AdminSettings();
                }
                $settings->title = $formData['title'];
                $settings->description = $formData['description'];

                if ($settings->save()) {

                    $siteSettings->youtube_video_link = $formData['youtube_video_link'];
                    $siteSettings->save();
                    return redirect()->route('admin.settings-about-us')
                    ->with('success', "About Us Updated");
                } else {
                    return redirect()->back()->withErrors('Something went wrong. Please try again.');
                }
            } else {
                return redirect()->back()->withErrors('Something went wrong. Please try again.');
            }
        }

        $settings = AdminSettings::where('slug', 'about_us')->first();
        $validator = AdminSettings::jsRules('cmsEditPageRules', $request->all());

        return view('cms.settings.about_us')->with([
            'settings' => $settings,
            'siteSettings' => $siteSettings,
            'validator' => $validator
        ]);
    }
}
