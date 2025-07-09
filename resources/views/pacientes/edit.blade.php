@extends('layouts.app')

@section('title', 'Editar Paciente')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h3>Editar Paciente #{{ $paciente->id }}</h3>
        <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $paciente->nombre) }}" required>
            </div>
            <div class="mb-3">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $paciente->apellido) }}" required>
            </div>
            <div class="mb-3">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', $paciente->dni) }}" required>
            </div>
            <div class="mb-3">
                <label for="correo_electronico">Email</label>
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="{{ old('correo_electronico', $paciente->correo_electronico) }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Paciente</button>
        </form>
    </div>
</div>
@endsection