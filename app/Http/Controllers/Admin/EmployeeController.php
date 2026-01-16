<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    // Listar empleados (activos e inactivos)
    public function index()
    {
        $activeManagers = Manager::with('user')
            ->where('employee', 1)
            ->get();

        $inactiveManagers = Manager::with('user')
            ->where('employee', 0)
            ->get();

        return view('admin.employees.index', compact('activeManagers', 'inactiveManagers'));
    }

    // Contratar (activar) managers
    public function hire()
{
    $activeManagers = User::where('user_type', 'manager')
        ->whereHas('manager', fn($q) => $q->where('employee', 1))
        ->with('manager')
        ->get();

    $inactiveManagers = User::where('user_type', 'manager')
        ->whereHas('manager', fn($q) => $q->where('employee', 0))
        ->with('manager')
        ->get();

    return view('admin.employees.hire', compact('activeManagers', 'inactiveManagers'));
}

    // Despedir managers
    public function fire(Request $request)
    {
        $ids = $request->input('despedir', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'No se seleccionó ningún empleado para despedir.');
        }

        try {
            DB::beginTransaction();
            Manager::whereIn('user_id', $ids)->update(['employee' => 0]);
            DB::commit();
            return redirect()->route('admin.employees.index')->with('success', 'Empleados despedidos correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error al despedir empleados: ' . $e->getMessage());
        }
    }
}
