<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Operador;

class OperadorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase; // Esto reinicia la base de datos antes de cada prueba

    public function test_authentication_pass_operator(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_instance()
    {
        $operador = Operador::factory()->create();
    
        $this->assertDatabaseHas('operadors', [
            'dni' => $operador->dni,
        ]);
    }

    public function test_index_returns_operadores_and_view()
    {
        $user = User::factory()->create();
        $operador = Operador::factory()->create(['user_id' => $user->id]);
    
        // Simula una solicitud autenticada
        $response = $this->actingAs($user)->get(route('admin.operadores.index'));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.operadores.index');
        
        // Verifica que los operadores se pasen a la vista
        $response->assertViewHas('operadores');
    }

    public function test_create_view_is_accessible()
    {
        $user = User::factory()->create();
        
        // Simula una solicitud autenticada
        $response = $this->actingAs($user)->get(route('admin.operadores.create'));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.operadores.create');
    }

    public function test_store_creates_new_operador()
    {
        $user = User::factory()->create();
    
        // Datos de entrada para crear un nuevo operador
        $operadorData = [
            'nombres' => 'Nuevo Operador',
            'apellidos' => 'Apellido',
            'dni' => '12345678',
            'celular' => '987654321',
            'direccion' => 'Dirección de prueba',
            'email' => 'nuevo@usuario.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    
        // Simula la solicitud para crear un operador
        $response = $this->actingAs($user)->post(route('admin.operadores.store'), $operadorData);
    
        // Verifica que el operador haya sido creado en la base de datos
        $this->assertDatabaseHas('operadors', ['dni' => '12345678']);
        $this->assertDatabaseHas('users', ['email' => 'nuevo@usuario.com']);
    
        // Verifica que redirige a la página de creación de operadores
        $response->assertRedirect(route('admin.operadores.create'));
    }

    public function test_show_displays_operador_info()
    {
        $user = User::factory()->create();
        $operador = Operador::factory()->create(['user_id' => $user->id]);
    
        // Simula la solicitud para ver los detalles de un operador
        $response = $this->actingAs($user)->get(route('admin.operadores.show', $operador->id));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.operadores.show');
    
        // Verifica que el operador específico se pase a la vista
        $response->assertViewHas('operador', $operador);
    }
    
    public function test_edit_view_is_accessible()
    {
        $user = User::factory()->create();
        $operador = Operador::factory()->create(['user_id' => $user->id]);
    
        // Simula la solicitud para cargar la vista de edición
        $response = $this->actingAs($user)->get(route('admin.operadores.edit', $operador->id));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.operadores.edit');
    
        // Verifica que el operador específico se pase a la vista
        $response->assertViewHas('operador', $operador);
    }
    
    public function test_update_operador()
    {
        $user = User::factory()->create();
        $operador = Operador::factory()->create(['user_id' => $user->id]);
    
        // Datos actualizados
        $updatedData = [
            'nombres' => 'Operador Actualizado',
            'apellidos' => 'Apellido Actualizado',
            'dni' => '12345678',
            'celular' => '123456789',
            'direccion' => 'Dirección Actualizada',
            'email' => 'actualizado@usuario.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];
    
        // Simula la solicitud para actualizar un operador
        $response = $this->actingAs($user)->put(route('admin.operadores.update', $operador->id), $updatedData);
    
        // Verifica que el operador haya sido actualizado en la base de datos
        $this->assertDatabaseHas('operadors', ['dni' => '12345678', 'nombres' => 'Operador Actualizado']);
        $this->assertDatabaseHas('users', ['email' => 'actualizado@usuario.com']);
    
        // Verifica que redirige a la página de creación de operadores
        $response->assertRedirect(route('admin.operadores.create'));
    }
    
    public function test_confirm_delete_view_is_accessible()
    {
        $user = User::factory()->create();
        $operador = Operador::factory()->create(['user_id' => $user->id]);
    
        // Simula la solicitud para cargar la vista de confirmación de eliminación
        $response = $this->actingAs($user)->get(route('admin.operadores.confirmDelete', $operador->id));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.operadores.delete');
    
        // Verifica que el operador específico se pase a la vista
        $response->assertViewHas('operador', $operador);
    }

    public function test_destroy_deletes_operador_and_user()
    {
        $user = User::factory()->create();
        $operador = Operador::factory()->create(['user_id' => $user->id]);
    
        // Simula la solicitud para eliminar un operador
        $response = $this->actingAs($user)->delete(route('admin.operadores.destroy', $operador->id));
    
        // Verifica que el operador y su usuario hayan sido eliminados de la base de datos
        $this->assertDatabaseMissing('operadors', ['id' => $operador->id]);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    
        // Verifica que redirige a la página de índices de operadores
        $response->assertRedirect(route('admin.operadores.index'));
    }
    
}
