@extends('layouts.app')

@section('title', 'Editar Cita')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    <i class="fas fa-edit me-2"></i>
                    Editar Cita #{{ $cita->id }}
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('citas.update', $cita) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Selección de Paciente -->
                    <div class="mb-3">
                        <label for="paciente_id" class="form-label">
                            <i class="fas fa-user me-1"></i>
                            Paciente
                        </label>
                        <select class="form-select @error('paciente_id') is-invalid @enderror" 
                                id="paciente_id" 
                                name="paciente_id" 
                                required>
                            <option value="">Seleccionar paciente...</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" 
                                        {{ old('paciente_id', $cita->paciente_id) == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre_completo }} - {{ $paciente->dni }}
                                </option>
                            @endforeach
                        </select>
                        @error('paciente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Selección de Campo Médico -->
                    <div class="mb-3">
                        <label for="campo_id" class="form-label">
                            <i class="fas fa-stethoscope me-1"></i>
                            Campo Médico
                        </label>
                        <select class="form-select @error('campo_id') is-invalid @enderror" 
                                id="campo_id" 
                                name="campo_id" 
                                required>
                            <option value="">Seleccionar campo médico...</option>
                            @foreach($campos as $campo)
                                <option value="{{ $campo->id }}" 
                                        {{ old('campo_id', $cita->campo_id) == $campo->id ? 'selected' : '' }}>
                                    {{ $campo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('campo_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fecha y Hora -->
                    <div class="mb-3">
                        <label for="fecha_cita" class="form-label">
                            <i class="fas fa-calendar-alt me-1"></i>
                            Fecha y Hora de la Cita
                        </label>
                        <input type="datetime-local" 
                               class="form-control @error('fecha_cita') is-invalid @enderror" 
                               id="fecha_cita" 
                               name="fecha_cita" 
                               value="{{ old('fecha_cita', $cita->fecha_cita ? $cita->fecha_cita->format('Y-m-d\TH:i') : '') }}"
                               required>
                        @error('fecha_cita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="mb-3">
                        <label for="estado" class="form-label">
                            <i class="fas fa-flag me-1"></i>
                            Estado
                        </label>
                        <select class="form-select @error('estado') is-invalid @enderror" 
                                id="estado" 
                                name="estado" 
                                required>
                            <option value="programada" {{ old('estado', $cita->estado) == 'programada' ? 'selected' : '' }}>
                                Programada
                            </option>
                            <option value="confirmada" {{ old('estado', $cita->estado) == 'confirmada' ? 'selected' : '' }}>
                                Confirmada
                            </option>
                            <option value="cancelada" {{ old('estado', $cita->estado) == 'cancelada' ? 'selected' : '' }}>
                                Cancelada
                            </option>
                            <option value="completada" {{ old('estado', $cita->estado) == 'completada' ? 'selected' : '' }}>
                                Completada
                            </option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Notas -->
                    <div class="mb-3">
                        <label for="notas" class="form-label">
                            <i class="fas fa-notes-medical me-1"></i>
                            Notas (Opcional)
                        </label>
                        <textarea class="form-control @error('notas') is-invalid @enderror" 
                                  id="notas" 
                                  name="notas" 
                                  rows="4" 
                                  placeholder="Observaciones adicionales...">{{ old('notas', $cita->notas) }}</textarea>
                        @error('notas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Información de fechas -->
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            <strong>Creado:</strong> {{ $cita->created_at->format('d/m/Y H:i') }}
                            @if($cita->updated_at != $cita->created_at)
                                | <strong>Última actualización:</strong> {{ $cita->updated_at->format('d/m/Y H:i') }}
                            @endif
                        </small>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('citas.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times me-1"></i>
                                Cancelar
                            </a>
                            <a href="{{ route('citas.show', $cita) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>
                                Ver Cita
                            </a>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Actualizar Cita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection