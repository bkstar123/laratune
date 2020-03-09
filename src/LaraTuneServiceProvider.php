<?php
/**
 * LaraTuneServiceProvider
 *
 * @author: tuanha
 * @last-mod: 04-Jan-2020
 */
namespace Bkstar123\LaraTune;

use Bkstar123\LaraTune\Models\Setting;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Bkstar123\LaraTune\Facades\Setting as SettingFacade;
use Bkstar123\LaraTune\Services\Setting as SettingService;

class LaraTuneServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        if (count(Schema::getColumnListing('settings'))) {
            $settings = Setting::all();
            foreach ($settings as $setting) {
                if (!is_null($setting->value)) {
                    Config::set("settings.{$setting->key}", $setting->value);
                }
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('setting', function ($app) {
            return new SettingService;
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('Setting', SettingFacade::class);
    }
}
