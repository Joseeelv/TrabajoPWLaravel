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
        
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
        } else {
            App::setLocale(config('app.locale')); // Idioma por defecto
        }
        return $next($request);
    }
}