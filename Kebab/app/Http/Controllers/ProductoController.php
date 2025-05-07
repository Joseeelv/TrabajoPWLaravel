<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function mostrar(Request $request)
    {
        $id = $request->input('idProdSelecCarta', 1);
        $cantidad = 1;

        $producto = DB::table('PRODUCTS')
            ->select('category', 'product_id', 'product_name', 'product_price', 'img_src')
            ->where('product_id', $id)
            ->first();

        if (!$producto) {
            abort(404, 'Producto no encontrado');
        }

        $ingredientes = [];
        if (DB::select("SHOW TABLES LIKE 'PRODUCTS_INGREDIENTS'")) {
            $ingredientes = DB::table('PRODUCTS_INGREDIENTS as pi')
                ->join('INGREDIENTS as i', 'pi.ingredient_id', '=', 'i.ingredient_id')
                ->where('pi.product_id', $id)
                ->select('i.ingredient_id', 'i.ingredient_name', 'i.img_src')
                ->get();
        }

        $alergenos = DB::table('INGREDIENTS_ALLERGENS as ia')
            ->join('ALLERGENS as a', 'ia.allergen_id', '=', 'a.allergen_id')
            ->whereIn('ia.ingredient_id', function ($query) use ($id) {
                $query->select('ingredient_id')
                    ->from('PRODUCTS_INGREDIENTS')
                    ->where('product_id', $id);
            })
            ->distinct()
            ->pluck('a.img_src')
            ->toArray();

        if (empty($alergenos)) {
            $alergenos = DB::table('PRODUCTS_NO_INGREDIENTS_ALLERGENS as pa')
                ->join('ALLERGENS as a', 'pa.allergen_id', '=', 'a.allergen_id')
                ->where('pa.product_id', $id)
                ->pluck('a.img_src')
                ->toArray();
        }

        return view('producto', compact('producto', 'ingredientes', 'alergenos', 'cantidad'));
    }
}

