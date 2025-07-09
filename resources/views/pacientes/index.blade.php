@extends('layouts.app')

@section('title', 'Lista de Pacientes')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-calendar-medical me-2"></i>
                Lista de Pacientes
            </h1>
            <a href="{{ route('pacientes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Nuevo Paciente
            </a>
        </div>
        
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->id }}</td>
                    <td>{{ $paciente->nombre }}</td>
                    <td>{{ $paciente->apellido }}</td>
                    <td>{{ $paciente->dni }}</td>
                    <td>{{ $paciente->correo_electronico }}</td>
                    <td>
                        <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i></a>

                        <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                        <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST"  style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')"><i class="fas fa-trash"></i></button> 
                            
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection