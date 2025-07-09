<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        return response()->json(Medico::with('campo')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo_electronico' => 'required|email|unique:medicos',
            'campo_id' => 'required|exists:campos,id',
        ]);

        $medico = Medico::create($validated);
        return response()->json($medico->load('campo'), 201);
    }

    public function show(Medico $medico)
    {
        return response()->json($medico->load('campo'));
    }

    public function update(Request $request, Medico $medico)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'correo_electronico' => 'sometimes|email|unique:medicos,correo_electronico,' . $medico->id,
            'campo_id' => 'sometimes|exists:campos,id',
        ]);

        $medico->update($validated);
        return response()->json($medico->load('campo'));
    }

    public function destroy(Medico $medico)
    {
        $medico->delete();
        return response()->json(['message' => 'Médico eliminado']);
    }
}
