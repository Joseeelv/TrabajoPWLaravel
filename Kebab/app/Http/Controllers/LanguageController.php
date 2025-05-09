<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {
        $locale = $request->locale;

        // Establecer el idioma
        App::setLocale($locale);

        // Guardar el idioma en la sesión
        Session::put('locale', $locale);

        // Redirigir a la misma página
        return redirect()->back();
    }
}
