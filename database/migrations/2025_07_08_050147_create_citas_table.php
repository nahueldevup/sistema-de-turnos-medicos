<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('campo_id')->constrained('campos')->onDelete('cascade');
            $table->datetime('fecha_cita'); // IMPORTANTE: debe ser datetime
            $table->enum('estado', ['programada', 'confirmada', 'cancelada', 'completada'])->default('programada');
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Para soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};