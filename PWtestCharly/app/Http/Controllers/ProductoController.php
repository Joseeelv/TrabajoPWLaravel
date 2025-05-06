<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function mostrar($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            abort(404);
        }

        return view('ProductoView', compact('producto'));
    }
}
