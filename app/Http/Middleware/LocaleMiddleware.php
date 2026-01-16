<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Primero, revisa si hay un idioma en la URL
        $locale = $request->segment(1);

        if ($locale && in_array($locale, ['es', 'tr'])) {
            App::setLocale($locale);
            Session::put('locale', $locale); // Guarda para futuras peticiones
            URL::defaults(['locale' => $locale]);
        } elseif (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
        } else {
            App::setLocale(config('app.locale')); // Idioma por defecto
        }
        return $next($request);
    }
}