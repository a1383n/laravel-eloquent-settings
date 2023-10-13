<?php

namespace LaravelEloquentSettings;

use Illuminate\Support\ServiceProvider;
use LaravelEloquentSettings\Contracts\SettingHandlerInterface;
use LaravelEloquentSettings\Contracts\SettingRepositoryInterface;
use LaravelEloquentSettings\Repositories\SettingRepository;

/**
 * Class EloquentSettingsServiceProvider
 *
 * Laravel service provider for the EloquentSettings package.
 *
 * @package LaravelEloquentSettings
 */
class EloquentSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/eloquent_settings.php', 'eloquent_settings');

        $this->app->bind('eloquent_settings', EloquentSettingManager::class);

        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(SettingHandlerInterface::class, SettingHandler::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPublishables();
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishables(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../config/eloquent_settings.php' => config_path('eloquent_settings.php'),
        ], 'config');

        if (empty(glob(database_path('migrations/*_create_eloquent_settings_table.php')))) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_eloquent_settings_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_eloquent_settings_table.php'),
            ], 'migrations');
        }
    }
}
