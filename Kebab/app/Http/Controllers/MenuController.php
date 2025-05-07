<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Detectar cambio de categoría
        if ($request->has('category')) {
            session(['actual_category' => $request->query('category')]);
        }

        // Categoría por defecto
        $actualCategory = session('actual_category', 'Ninguna');

        // Obtener categorías (cache en sesión)
        if (!session()->has('categorias')) {
            $categorias = Producto::select('category as cat')->distinct()->get()->toArray();
            session(['categorias' => $categorias]);
        } else {
            $categorias = session('categorias');
        }

        // Filtrar productos
        $productos = ($actualCategory !== 'Ninguna')
            ? Producto::where('category', $actualCategory)->select('product_id as id', 'product_name as nombre', 'img_src as img')->get()
            : Producto::select('product_id as id', 'product_name as nombre', 'img_src as img')->get();

        return view('Menu', compact('categorias', 'productos', 'actualCategory'));
    }

}