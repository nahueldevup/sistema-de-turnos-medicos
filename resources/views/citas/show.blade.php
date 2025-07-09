@extends('layouts.app')

@section('title', 'Detalles de la Cita')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>
                    <i class="fas fa-calendar-check me-2"></i>
                    Detalles de la Cita #{{ $cita->id }}
                </h3>
                <span class="badge bg-{{ $cita->estado_clase }} fs-6">
                    {{ ucfirst($cita->estado) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Información del Paciente -->
                    <div class="col-md-6">
                        <h5>
                            <i class="fas fa-user me-2"></i>
                            Información del Paciente
                        </h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nombre:</strong></td>
                                <td>{{ $cita->paciente->nombre_completo }}</td>
                            </tr>
                            <tr>
                                <td><strong>DNI:</strong></td>
                                <td>{{ $cita->paciente->dni }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $cita->paciente->correo_electronico }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Información de la Cita -->
                    <div class="col-md-6">
                        <h5>
                            <i class="fas fa-calendar-alt me-2"></i>
                            Información de la Cita
                        </h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Campo:</strong></td>
                                <td>{{ $cita->campo->nombre }}</td>
                            </tr>
                            <tr>
                                <td><strong>Fecha:</strong></td>
                                <td>{{ $cita->fecha_formateada }}</td>
                            </tr>
                            <tr>
                                <td><strong>Estado:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $cita->estado_clase }}">
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($cita->notas)
                    <div class="mt-4">
                        <h5>
                            <i class="fas fa-notes-medical me-2"></i>
                            Notas
                        </h5>
                        <div class="alert alert-light">
                            {{ $cita->notas }}
                        </div>
                    </div>
                @endif

                <!-- Información de fechas -->
                <div class="mt-4">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Creado:</strong> {{ $cita->created_at->format('d/m/Y H:i') }}
                        @if($cita->updated_at != $cita->created_at)
                            | <strong>Actualizado:</strong> {{ $cita->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </small>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('citas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Volver a la lista
                </a>
                <div>
                    <a href="{{ route('citas.edit', $cita) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-1"></i>
                        Editar
                    </a>
                    <form action="{{ route('citas.destroy', $cita) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                            <i class="fas fa-trash me-1"></i>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection