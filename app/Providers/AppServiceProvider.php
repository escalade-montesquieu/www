<?php

namespace App\Providers;

use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
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
        Carbon::setLocale($this->app->getLocale());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                'account' => UserMenuItem::make()
                    ->url(route('profile.show'))
                    ->label('Mon compte'),
                'back-to-site' => UserMenuItem::make()
                    ->url(route('home'))
                    ->label('Retour au site')
                    ->icon('heroicon-o-arrow-right'),
            ]);
        });
    }
}
