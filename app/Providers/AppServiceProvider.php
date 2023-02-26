<?php

namespace App\Providers;

use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        if ($defaultTarget = config('mail.to')) {
            Mail::alwaysTo($defaultTarget);
        }

        Str::macro('toSluggedUsername', static function (string $str) {
            return str_replace(' ', '-', strtolower($str));
        });

        Str::macro('toHumanUsername', static function (string $str) {
            return ucfirst(str_replace('-', ' ', $str));
        });

        Blade::directive('urlify', static function ($expression) {
            return preg_replace(
                REGEX_URL,
                '<a href="$0" target="_blank" rel="noopener noreferrer">$0</a>',
                $expression
            );
        });

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
