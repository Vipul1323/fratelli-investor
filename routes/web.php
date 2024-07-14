<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('store-token', function(){
    $siteSettings = App\Models\SiteSettings::first();
    $token = "eyJ0eXAiOiJKV1QiLCJrZXlfaWQiOiJza192MS4wIiwiYWxnIjoiSFMyNTYifQ.eyJzdWIiOiI3U0FENEYiLCJqdGkiOiI2NjZkNTdkYjY2N2RkNTRiYWRlOWM1ZDgiLCJpc011bHRpQ2xpZW50IjpmYWxzZSwiaWF0IjoxNzE4NDQxOTQ3LCJpc3MiOiJ1ZGFwaS1nYXRld2F5LXNlcnZpY2UiLCJleHAiOjE3MTg0ODg4MDB9.nXYhLBv-nf2XvnmNvH5hf9CJatVxg32Z1pmDHu1o87k";
    $siteSettings->upstocks_token = $token;
    $siteSettings->save();
});

Route::get('load-history', function(){
    App\Models\ApiLog::getTinnaStockHistoryData();

    echo "123";
    exit;
});


Route::get('artisan', function(){
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');


    //Artisan::call('schedule:run');
});


Route::namespace('Admin')->group(function () {
    /*Guest Access*/
    Route::prefix('auth')->middleware(['guest'])->name('auth.')->group(function () {
        Route::match(['get', 'post'], '/reset-password', ['uses' => 'AuthController@resetPasswordUser'])->name('reset-password');
    });
});

/*--------------Admin Namespace (App\Http\Controllers\Admin) --------------*/
Route::namespace('Admin')->group(function () {
    /*Guest Access*/
    Route::prefix('admin')->middleware(['guest'])->name('admin.')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/', 'signin');
            Route::match(['get', 'post'], '/signin', 'signin')->name('signin');

            Route::match(['get', 'post'], '/forgot-password', 'forgotPassword')->name('forgot-password');
            Route::match(['get', 'post'], '/reset-password', 'resetPassword')->name('reset-password');
        });
    });

    /*After Authenticated*/
    Route::prefix('admin')->middleware(['admin_auth'])->name('admin.')->group(function () {
        Route::get('/logout', ['uses' => 'AuthController@logout'])->name('logout');

        /* Dashboard */
        Route::controller(DashboardController::class)->group(function () {
            Route::match(['get', 'post'], 'dashboard',  'dashboard')->name('dashboard');
        });

        Route::controller(ProfileController::class)->group(function () {
            Route::match(['get', 'post'], 'edit-profile', 'editAdmin')->name('edit-profile');
            Route::match(['get', 'post'], 'change-password', 'changePassword')->name('change.password');

        });

        // Category/Folder Management
        Route::controller(CategoryController::class)->group(function () {
            Route::match(['get'], 'folders/index', 'index')->name('folders.index');
            Route::match(['get', 'post'], 'folders/create', 'create')->name('folders.create');
            Route::match(['post'], 'folders/load-child-folders', 'loadChildFolder')->name('folders.get-child-folder');
            Route::match(['get', 'post'], 'folders/edit/{id}', 'edit')->name('folders.edit');
            Route::match(['get'], 'folders/delete/{id}', 'delete')->name('folders.delete');
        });

        // Media Management
        Route::controller(MediaController::class)->group(function () {
            Route::match(['get'], 'media/index', 'index')->name('media.index');
            Route::match(['get', 'post'], 'media/create', 'create')->name('media.create');
            Route::match(['get', 'post'], 'media/edit/{id}', 'edit')->name('media.edit');
            Route::match(['get'], 'media/delete/{id}', 'delete')->name('media.delete');
        });

        /* SMTP Settings */
        Route::controller(SettingsController::class)->group(function () {
            // Route::match(['get', 'post'], 'settings/mail', 'smtpSettings')->name('settings-mail');
            Route::match(['get', 'post'], 'settings/market-api', 'marketApiSettings')->name('settings-market-api');
            Route::match(['get', 'post'], 'settings/about-us', 'aboutUsText')->name('settings-about-us');
            // Route::match(['get', 'post'], 'settings/s3', 's3settings')->name('settings-s3');
        });
    });
});

Route::get('app', function(){
    return view('website.layout.app');
});


Route::get('/', 'WebsiteController@index')->name('/');
Route::get('folders', 'WebsiteController@showAllFolders');
Route::get('/get-files/{folder}', 'WebsiteController@getSubFolderFiles');
Route::post('stock-data', 'WebsiteController@getStockData')->name('stock-data');
Route::get('get-stock-sticker', 'WebsiteController@getStockSticker')->name('get-stock-sticker');
Route::post('send-newsletter', 'WebsiteController@sendNewsletter')->name('send-newsletter');
Route::get('get-api-code', 'WebsiteController@storeApiCode');
