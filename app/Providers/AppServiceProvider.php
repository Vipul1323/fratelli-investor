<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        /*pwd validation*/
        \Validator::extend('pwdvalidation', function ($field, $value, $parameters) {
            return \Hash::check($value, \Auth::guard('admin')->user()->password);
        });
        /*Sortable*/
        Blade::directive('sortable', function ($expression) {
            [$db_field, $title, $sort_field, $sort, $link] = explode(',', $expression);

            $html = "<?php if( {$sort_field} == ".$db_field.') {';
            $html .= "echo('<th scope=\'col\' class=\'sorting sorting_'.(($sort=='asc')?'desc':'asc').'\'><a href='.$link.'>'.$title.'</a></th>');";
            $html .= '}else{';
            $html .= "echo('<th scope=\'col\' class=\'sorting\'><a href='.$link.'>'.$title.'</a></th>');";
            $html .= '} ?>';

            return $html;
        });

        \Validator::extend('without_spaces', function ($attr, $value) {
            if (empty(trim($value))) {
                return false;
            }

            return true;
        });
    }
}
