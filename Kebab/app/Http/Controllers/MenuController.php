<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Store or update current category selection
        if ($request->has('category')) {
            session(['actual_category' => $request->input('category')]);
            return redirect()->route('menu');
        }

        // Default category
        if (!session()->has('actual_category')) {
            session(['actual_category' => 'Ninguna']);
        }

        // Get unique categories once
        if (!session()->has('categorias')) {
            $categorias = Producto::select('category as cat')->distinct()->get()->toArray();
            session(['categorias' => $categorias]);
        } else {
            $categorias = session('categorias');
        }

        // Filter products by selected category
        $actualCategory = session('actual_category');
        $productos = ($actualCategory !== 'Ninguna')
            ? Producto::where('category', $actualCategory)->select('product_id as id', 'product_name as nombre', 'img_src as img')->get()
            : Producto::select('product_id as id', 'product_name as nombre', 'img_src as img')->get();

        return view('Menu', compact('categorias', 'productos', 'actualCategory'));
    }
}