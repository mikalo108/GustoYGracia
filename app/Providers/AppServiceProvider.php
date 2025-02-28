<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Establece el idioma desde la sesión
        // Debería bastar, pero no sirve
        /*
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Si no hay idioma en la sesión, usa el predeterminado
            App::setLocale(config('app.locale'));
        }
        */
    }
}
