<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Cita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'paciente_id',
        'campo_id',
        'fecha_cita',
        'estado',
        'notas'
    ];

    // IMPORTANTE: Configurar fecha_cita como cast a datetime
    protected $casts = [
        'fecha_cita' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // También puedes usar dates (método más antiguo, pero aún funciona)
    protected $dates = [
        'fecha_cita',
        'deleted_at'
    ];

    // Una cita pertenece a un paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Una cita pertenece a un campo médico
    public function campo()
    {
        return $this->belongsTo(Campo::class);
    }

    // Método para obtener el estado con estilo
    public function getEstadoClaseAttribute()
    {
        return [
            'programada' => 'warning',
            'confirmada' => 'info',
            'cancelada' => 'danger',
            'completada' => 'success'
        ][$this->estado] ?? 'secondary';
    }

    // Método para formatear la fecha
    public function getFechaFormateadaAttribute()
    {
        return $this->fecha_cita ? $this->fecha_cita->format('d/m/Y H:i') : 'Sin fecha';
    }
}