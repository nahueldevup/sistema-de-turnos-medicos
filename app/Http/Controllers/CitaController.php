<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Campo;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Mostrar lista de todas las citas
     */
    public function index()
    {
        // Obtener todas las citas con sus relaciones (paciente y campo)
        // ¿Por qué with()? Para evitar el problema N+1 de consultas
        $citas = Cita::with(['paciente', 'campo'])
                     ->orderBy('fecha_cita', 'desc')
                     ->get();
        
        return view('citas.index', compact('citas'));
    }

    /**
     * Mostrar formulario para crear nueva cita
     */
    public function create()
    {
        // Necesitamos los pacientes y campos para los select del formulario
        $pacientes = Paciente::orderBy('nombre')->get();
        $campos = Campo::orderBy('nombre')->get();
        
        return view('citas.create', compact('pacientes', 'campos'));
    }

    /**
     * Guardar nueva cita en la base de datos
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'campo_id' => 'required|exists:campos,id',
            'fecha_cita' => 'required|date|after:now',
            'estado' => 'required|in:programada,confirmada,cancelada,completada',
            'notas' => 'nullable|string'
        ]);

        // Crear nueva cita
        Cita::create($request->all());

        return redirect()->route('citas.index')
            ->with('success', 'Cita creada exitosamente');
    }

    /**
     * Mostrar una cita específica
     */
    public function show(Cita $cita)
    {
        // Cargar las relaciones
        $cita->load(['paciente', 'campo']);
        
        return view('citas.show', compact('cita'));
    }

    /**
     * Mostrar formulario para editar cita
     */
    public function edit(Cita $cita)
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $campos = Campo::orderBy('nombre')->get();
        
        return view('citas.edit', compact('cita', 'pacientes', 'campos'));
    }

    /**
     * Actualizar cita en la base de datos
     */
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'campo_id' => 'required|exists:campos,id',
            'fecha_cita' => 'required|date',
            'estado' => 'required|in:programada,confirmada,cancelada,completada',
            'notas' => 'nullable|string'
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada exitosamente');
    }

    /**
     * Eliminar cita (soft delete)
     */
    public function destroy(Cita $cita)
    {
        // Usar soft delete (no elimina físicamente)
        $cita->delete();
        
        return redirect()->route('citas.index')
            ->with('success', 'Cita eliminada exitosamente');
    }
}