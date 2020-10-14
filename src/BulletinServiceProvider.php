<?php

namespace TCStudios\Seat\SeatBulletins;

use Seat\Services\AbstractSeatPlugin;

class BulletinServiceProvider extends AbstractSeatPlugin
{
    public function boot() {
        $this->add_commands();
        $this->add_routes();
        $this->add_views();
        $this->add_migrations();
        $this->add_translations();
        $this->add_publications();
        $this->apply_custom_configuration();
    }

    public function add_routes() {
        if (!$this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }
    public function add_translations() {
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'bulletins');
    }
    public function add_views() {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'bulletins');
    }
    private function add_migrations() {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');
    }
    private function add_commands() {
        $this->commands([
            // InsuranceUpdate::class,
            // FlagShim::class
        ]);
    }

    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/Config/bulletins.config.php', 'bulletins.config');
        $this->mergeConfigFrom(__DIR__ . '/Config/bulletins.sidebar.php', 'package.sidebar');
        $this->registerPermissions(__DIR__ . '/Config/Permissions/bulletins.permissions.php', 'bulletins');
    }
    public function add_publications() {
        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('web'),
        ]);
    }

    public function apply_custom_configuration() {
        $current = config('l5-swagger.paths.annotations');
        if (!is_array($current))
            $current = [$current];
        config([
            'l5-swagger.paths.annotations' => array_unique(array_merge($current, [
                __DIR__ . '/Http/Controllers',
            ])),
        ]);
    }

    public function getName(): string { return 'Bulletins'; }
    public function getPackageRepositoryUrl(): string { return 'https://github.com/tcstudios/seat-bulletins'; }
    public function getPackagistPackageName(): string { return 'seat-bulletins'; }
    public function getPackagistVendorName(): string { return 'tcstudios'; }
    public function getVersion(): string { return config('bulletins.config.version'); }
}
