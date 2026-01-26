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
        if (!Schema::hasTable('usuarios')) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->id('id_usuario');
                $table->string('nombre', 100);
                $table->string('email', 100)->unique();
                $table->string('telefono', 20)->nullable();
                $table->string('contrasena_hash');
                $table->string('password')->nullable();
                $table->enum('rol', ['comercio', 'voluntario', 'ong'])->default('voluntario');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('comercios')) {
            Schema::create('comercios', function (Blueprint $table) {
                $table->id('id_comercio');
                $table->unsignedBigInteger('id_usuario');
                $table->string('nombre_comercial', 255);
                $table->string('direccion', 255)->nullable();
                $table->string('horario', 255)->nullable();
                $table->boolean('activo')->default(true);
                $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('donaciones')) {
            Schema::create('donaciones', function (Blueprint $table) {
                $table->id('id_donacion');
                $table->unsignedBigInteger('id_usuario');
                $table->string('tipo_comida');
                $table->decimal('cantidad', 8, 2);
                $table->dateTime('fecha_hora');
                $table->string('punto_recogida', 255);
                $table->text('observaciones')->nullable();
                $table->string('foto')->nullable();
                $table->enum('estado', ['No asignada', 'Asignada', 'En camino', 'Recogida', 'Entregada', 'Entregada a ONG', 'Recogida confirmada'])->default('No asignada');
                $table->unsignedBigInteger('id_voluntario_asignado')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
                $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
                $table->foreign('id_voluntario_asignado')->references('id_usuario')->on('usuarios')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaciones');
        Schema::dropIfExists('comercios');
        Schema::dropIfExists('usuarios');
    }
};
