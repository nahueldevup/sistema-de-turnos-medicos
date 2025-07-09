@extends('layouts.app')

@section('title', 'Lista de Citas Médicas')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-calendar-medical me-2"></i>
                Lista de Citas Médicas
            </h1>
            <a href="{{ route('citas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Nueva Cita
            </a>
        </div>

        @if($citas->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Campo Médico</th>
                            <th>Fecha y Hora</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($citas as $cita)
                        <tr>
                            <td>{{ $cita->id }}</td>
                            <td>
                                <strong>{{ $cita->paciente->nombre_completo }}</strong>
                                <br>
                                <small class="text-muted">{{ $cita->paciente->dni }}</small>
                            </td>
                            <td>{{ $cita->campo->nombre }}</td>
                            <td>{{ $cita->fecha_formateada }}</td>
                            <td>
                                <span class="badge bg-{{ $cita->estado_clase }}">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>
                            <td>
                              
                                    <a href="{{ route('citas.show', $cita) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('citas.edit', $cita) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('citas.destroy', $cita) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                              
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle fa-3x mb-3"></i>
                <h4>No hay citas registradas</h4>
                <p>Aún no has creado ninguna cita médica.</p>
                <a href="{{ route('citas.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Crear la primera cita
                </a>
            </div>
        @endif
    </div>
</div>
@endsection