<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    public function run()
    {
        $pacientes = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'dni' => '12345678',
                'correo_electronico' => 'juan.perez@email.com'
            ],
            [
                'nombre' => 'María',
                'apellido' => 'González',
                'dni' => '87654321',
                'correo_electronico' => 'maria.gonzalez@email.com'
            ],
            [
                'nombre' => 'Carlos',
                'apellido' => 'Rodríguez',
                'dni' => '11223344',
                'correo_electronico' => 'carlos.rodriguez@email.com'
            ],
        ];

        foreach ($pacientes as $paciente) {
            Paciente::create($paciente);
        }
    }
}