<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campo;
use Illuminate\Http\Request;

class CampoController extends Controller
{
    public function index()
    {
        return response()->json(Campo::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);

        $campo = Campo::create($validated);
        return response()->json($campo, 201);
    }

    public function show(Campo $campo)
    {
        return response()->json($campo);
    }

    public function update(Request $request, Campo $campo)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
        ]);

        $campo->update($validated);
        return response()->json($campo);
    }

    public function destroy(Campo $campo)
    {
        $campo->delete();
        return response()->json(['message' => 'Campo eliminado']);
    }
}