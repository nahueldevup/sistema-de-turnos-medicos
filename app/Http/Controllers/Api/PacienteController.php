<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        return response()->json(Paciente::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|unique:pacientes',
            'correo_electronico' => 'required|email|unique:pacientes',
        ]);

        $paciente = Paciente::create($validated);
        return response()->json($paciente, 201);
    }

    public function show(Paciente $paciente)
    {
        return response()->json($paciente);
    }

    public function update(Request $request, Paciente $paciente)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'dni' => 'sometimes|string|unique:pacientes,dni,' . $paciente->id,
            'correo_electronico' => 'sometimes|email|unique:pacientes,correo_electronico,' . $paciente->id,
        ]);

        $paciente->update($validated);
        return response()->json($paciente);
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->json(['message' => 'Paciente eliminado']);
    }
}