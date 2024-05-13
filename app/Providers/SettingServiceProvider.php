<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Cache\Factory;

use App\Models\Setting;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Factory $cache, Setting $setting)
    {
        if (Schema::hasTable('settings')) {
            $setting = $cache->remember('setting', 60, function () use ($setting)
            {
                return $setting->first();
            });

            config()->set('setting', $setting);
        }
    }
}
