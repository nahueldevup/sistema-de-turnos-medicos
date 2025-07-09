<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campo;

class CampoSeeder extends Seeder
{
    public function run()
    {
        $campos = [
            ['nombre' => 'Medicina General', 'descripcion' => 'Consultas médicas generales'],
            ['nombre' => 'Cardiología', 'descripcion' => 'Especialista en corazón'],
            ['nombre' => 'Dermatología', 'descripcion' => 'Especialista en piel'],
            ['nombre' => 'Pediatría', 'descripcion' => 'Medicina infantil'],
            ['nombre' => 'Ginecología', 'descripcion' => 'Salud femenina'],
        ];

        foreach ($campos as $campo) {
            Campo::create($campo);
        }
    }
}