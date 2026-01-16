<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        // Obtener ingredientes del request (si existen)
        $lista_ingredientes = json_decode($request->input('ingr_list_info', '[]'), true);
        if (!is_array($lista_ingredientes)) {
            $lista_ingredientes = [];
        }

        // Obtener nombres de los ingredientes desde la base de datos
        $ingredientes_formateados = [];
        foreach ($lista_ingredientes as $ingr) {
            $id = $ingr[0] ?? null;
            $cantidad = $ingr[1] ?? 1;

            if ($id) {
                $nombre = DB::table('INGREDIENTS')
                    ->where('ingredient_id', $id)
                    ->value('ingredient_name') ?? 'Desconocido';

                $ingredientes_formateados[] = [
                    'id' => $id,
                    'cantidad' => $cantidad,
                    'nombre' => htmlspecialchars($nombre),
                ];
            }
        }

        // Obtener carrito actual o inicializarlo
        $carrito = Session::get('compra', []);

        // Agregar producto al carrito
        $carrito[] = [
            'id' => $request->input('product_id'),
            'nombre' => $request->input('product_name'),
            'precio' => $request->input('product_price'),
            'cantidad' => 1,
            'lista_ingredientes' => $ingredientes_formateados,
            'category' => $request->input('category'),
        ];

        // Guardar carrito actualizado en sesión
        Session::put('compra', $carrito);

        return redirect('/menu');
    }
}
