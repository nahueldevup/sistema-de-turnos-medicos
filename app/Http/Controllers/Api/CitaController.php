<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        return response()->json(Cita::with(['paciente', 'campo'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'campo_id' => 'required|exists:campos,id',
            'fecha_cita' => 'required|date',
            'estado' => 'in:programada,confirmada,cancelada,completada',
            'notas' => 'nullable|string',
        ]);

        $cita = Cita::create($validated);
        return response()->json($cita->load(['paciente', 'campo']), 201);
    }

    public function show(Cita $cita)
    {
        return response()->json($cita->load(['paciente', 'campo']));
    }

    public function update(Request $request, Cita $cita)
    {
        $validated = $request->validate([
            'paciente_id' => 'sometimes|exists:pacientes,id',
            'campo_id' => 'sometimes|exists:campos,id',
            'fecha_cita' => 'sometimes|date',
            'estado' => 'sometimes|in:programada,confirmada,cancelada,completada',
            'notas' => 'nullable|string',
        ]);

        $cita->update($validated);
        return response()->json($cita->load(['paciente', 'campo']));
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return response()->json(['message' => 'Cita eliminada']);
    }
}