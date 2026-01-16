<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = DB::select("
        SELECT 
            T.transaction_id, 
            COALESCE(O.order_date, R.replenishment_date) AS transaction_date, 
            COALESCE(O.user_id, R.manager_id) AS user_id,
            CASE 
                WHEN T.order_id IS NOT NULL THEN 'Venta' 
                ELSE 'Compra' 
            END AS transaction_type,
            CASE 
                WHEN T.replenishment_id IS NOT NULL THEN -T.transaction_money 
                ELSE T.transaction_money 
            END AS balance
        FROM transactions T
        LEFT JOIN orders O ON T.order_id = O.order_id
        LEFT JOIN users U ON O.user_id = U.user_id
        LEFT JOIN replenishments R ON T.replenishment_id = R.replenishment_id
        ORDER BY transaction_date DESC
    ");

        $total_ventas = 0;
        $total_compras = 0;

        foreach ($transactions as $tx) {
            if ($tx->balance > 0)
                $total_ventas += $tx->balance;
            else
                $total_compras += abs($tx->balance);
        }

        $balance_final = $total_ventas - $total_compras;

        return view('manager.transaction', compact('transactions', 'total_ventas', 'total_compras', 'balance_final'));
    }

}

