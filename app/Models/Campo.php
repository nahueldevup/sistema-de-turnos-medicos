<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    // Un campo puede tener muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    // Un campo puede tener muchos médicos
    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }
}