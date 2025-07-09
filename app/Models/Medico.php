<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'correo_electronico',
        'campo_id'
    ];

    // Un médico pertenece a un campo
    public function campo()
    {
        return $this->belongsTo(Campo::class);
    }

    // Método para obtener el nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}