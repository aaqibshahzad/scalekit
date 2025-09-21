<?php

namespace Aaqibshahzad\Scalekit;

use Illuminate\Support\ServiceProvider;

class ScaleKitServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Merge package config
        $this->mergeConfigFrom(__DIR__.'/Config/scalekit.php', 'scalekit');
    }

    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        // Load package migrations directly (optional)
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        /*
        |--------------------------------------------------------------------------
        | Publishable files
        |--------------------------------------------------------------------------
        */

        // Config
        $this->publishes([
            __DIR__.'/Config/scalekit.php' => config_path('scalekit.php'),
        ], 'scalekit-config');

        // Migrations
        $this->publishes([
            __DIR__.'/Migrations' => database_path('migrations'),
        ], 'scalekit-migrations');

        // Seeders
        $this->publishes([
            __DIR__.'/Database/Seeders' => database_path('seeders'),
        ], 'scalekit-seeders');

        // Sanctum migrations
        $this->publishes([
            base_path('vendor/laravel/sanctum/database/migrations') => database_path('migrations'),
        ], 'scalekit-sanctum');

        /*
        |--------------------------------------------------------------------------
        | All-in-one publish (config + migrations + sanctum + seeders)
        |--------------------------------------------------------------------------
        */
        $this->publishes([
            __DIR__.'/Config/scalekit.php' => config_path('scalekit.php'),
            __DIR__.'/Migrations' => database_path('migrations'),
            __DIR__.'/Database/Seeders' => database_path('seeders'),
            base_path('vendor/laravel/sanctum/database/migrations') => database_path('migrations'),
        ], 'scalekit-install');
    }

    /**
     * Register Laravel Socialite if enabled.
     */
    protected function registerSocialite()
    {
        if (config('scalekit.oauth_providers.google') ||
            config('scalekit.oauth_providers.github') ||
            config('scalekit.oauth_providers.linkedin')) {
            if (class_exists(\Laravel\Socialite\SocialiteServiceProvider::class)) {
                $this->app->register(\Laravel\Socialite\SocialiteServiceProvider::class);
            }
        }
    }

    /**
     * Register Spatie Roles if enabled.
     */
    protected function registerSpatieRoles()
    {
        if (config('scalekit.roles.enabled')) {
            if (class_exists(\Spatie\Permission\PermissionServiceProvider::class)) {
                $this->app->register(\Spatie\Permission\PermissionServiceProvider::class);
            }
        }
    }

    /**
     * Register Tenancy (single-db approach).
     */
    protected function registerTenancy()
    {
        if (config('scalekit.tenant.enabled')) {
            // You can bind middleware or model observers here
            // Example: automatically add tenant_id when creating models
        }
    }
}