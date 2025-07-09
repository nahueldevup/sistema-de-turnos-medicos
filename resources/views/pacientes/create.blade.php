@extends('layouts.app')

@section('title', 'Añadir Paciente')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h3>Añadir Paciente</h3>
        <form action="{{ route('pacientes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            <div class="mb-3">
                <label for="correo_electronico">Email</label>
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
            </div>
            <button type="submit" class="btn btn-primary">Crear Paciente</button>
        </form>
    </div>
</div>
@endsection