<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
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
        date_default_timezone_set('Europe/Kiev');

        Blade::if('admin', function () {
            $is_admin = DB::table('users')
                ->where('is_admin', 1)
                ->first();


            return $is_admin->id == session('LoggedUser');
        });

        Blade::if('user', function () {
            $is_user = DB::table('users')
                ->where('is_admin', 0)
                ->first();


            return $is_user->id == session('LoggedUser');
        });
    }
}
