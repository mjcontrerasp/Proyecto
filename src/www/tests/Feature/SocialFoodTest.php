<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Donacion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SocialFoodTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registro_usuario_comercio()
    {
        $response = $this->post('/register', [
            'nombre' => 'Comercio Test',
            'email' => 'comercio@test.com',
            'telefono' => '123456789',
            'rol' => 'comercio', // <- cambiado
            'contrasena_hash' => bcrypt('1234'),
            'contrasena_hash_confirmation' => '1234'
        ]);

        $response->assertRedirect(route('comercio.create'));
        $this->assertDatabaseHas('usuarios', ['email' => 'comercio@test.com', 'rol' => 'comercio']);
    }

    /** @test */
    public function inicio_sesion_redireccion_segun_rol()
    {
        $usuario = User::factory()->create([
            'rol' => 'voluntario',
            'contrasena_hash' => bcrypt('1234')
        ]);

        $response = $this->post('/login', [
            'email' => $usuario->email,
            'password' => '1234' // Laravel automáticamente usa getAuthPassword()
        ]);

        $response->assertRedirect(route('donaciones.disponibles'));
    }

    /** @test */
    public function usuario_no_puede_registrarse_con_email_existente()
    {
        $usuario = User::factory()->create([
            'email' => 'testexistente@test.com'
        ]);

        $response = $this->post('/register', [
            'nombre' => 'Nuevo Usuario',
            'email' => 'testexistente@test.com',
            'telefono' => '987654321',
            'rol' => 'voluntario',
            'contrasena_hash' => bcrypt('1234'),
            'contrasena_hash_confirmation' => '1234'
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function comercio_puede_crear_donacion()
    {
        $comercio = User::factory()->create(['rol' => 'comercio']);
        $this->actingAs($comercio);

        $response = $this->post('/donaciones', [
            'tipo_comida' => 'Pan',
            'cantidad' => 10,
            'fecha_hora' => now()->toDateTimeString(),
            'punto_recogida' => 'Calle 123',
            'estado' => 'No asignada'
        ]);

        $response->assertRedirect(route('donaciones.index'));
        $this->assertDatabaseHas('donaciones', [
            'tipo_comida' => 'Pan',
            'id_usuario' => $comercio->id_usuario
        ]);
    }

    /** @test */
    public function voluntario_acepta_y_recoge_donacion()
    {
        $voluntario = User::factory()->create(['rol' => 'voluntario']);
        $comercio = User::factory()->create(['rol' => 'comercio']);
        $donacion = Donacion::factory()->create(['id_usuario' => $comercio->id_usuario]);

        $this->actingAs($voluntario);

        // Acepta donación
        $response1 = $this->post("/donaciones/{$donacion->id}/aceptar");
        $response1->assertRedirect();
        $this->assertDatabaseHas('donaciones', [
            'id' => $donacion->id,
            'id_voluntario_asignado' => $voluntario->id_usuario,
            'estado' => 'Asignada'
        ]);

        // Recoger donación
        $response2 = $this->post("/donaciones/{$donacion->id}/recoger", [
            'id_ong_destino' => 999 // ejemplo, necesitarás un usuario ONG creado si quieres prueba completa
        ]);

        $response2->assertRedirect();
    }

    /** @test */
    public function validacion_de_campos_obligatorios_en_donacion()
    {
        $comercio = User::factory()->create(['rol' => 'comercio']);
        $this->actingAs($comercio);

        $response = $this->post('/donaciones', [
            'tipo_comida' => '',
            'cantidad' => '',
            'fecha_hora' => '',
            'punto_recogida' => '',
            'estado' => ''
        ]);

        $response->assertSessionHasErrors([
            'tipo_comida',
            'cantidad',
            'fecha_hora',
            'punto_recogida',
            'estado'
        ]);
    }
}
