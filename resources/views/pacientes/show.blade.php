@extends('layouts.app')

@section('title', 'Detalles del Paciente')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h3>Detalles del Paciente #{{ $paciente->id }}</h3>
        <table class="table table-borderless">
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $paciente->nombre }}</td>
            </tr>
            <tr>
                <td><strong>Apellido:</strong></td>
                <td>{{ $paciente->apellido }}</td>
            </tr>
            <tr>
                <td><strong>DNI:</strong></td>
                <td>{{ $paciente->dni }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td>{{ $paciente->correo_electronico }}</td>
            </tr>
        </table>
        <div class="d-flex justify-content-between">
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection