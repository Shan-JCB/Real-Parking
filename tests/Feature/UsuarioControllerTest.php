<?php

namespace Tests\Feature;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsuarioControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase; // Esto reinicia la base de datos antes de cada prueba

    public function test_authentication_pass(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_destroy_deletes_user()
    {
        // Crea un usuario para simular la eliminación
        $user = User::factory()->create();
        
        // Verifica que el usuario existe antes de eliminarlo
        $this->assertDatabaseHas('users', ['id' => $user->id]);

        // Simula la solicitud para eliminar el usuario
        $response = $this->actingAs($user)->delete(route('usuarios.destroy', $user->id));

        // Verifica que el usuario fue eliminado de la base de datos
        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        // Verifica que se redirige correctamente a la página de usuarios
        $response->assertRedirect(route('usuarios.index'));
    }

    public function test_store_creates_new_user()
    {
        $user = User::factory()->create();
    
        // Datos de entrada para crear un nuevo usuario
        $userData = [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@usuario.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    
        // Simula la solicitud para crear un usuario
        $response = $this->actingAs($user)->post(route('usuarios.store'), $userData);
    
        // Verifica que el usuario haya sido creado en la base de datos
        $this->assertDatabaseHas('users', ['email' => 'nuevo@usuario.com']);
    
        // Verifica que redirige a la página de usuarios
        $response->assertRedirect(route('usuarios.index'));
    }
    

    public function test_index_returns_users_and_view()
    {
        $user = User::factory()->create();
        
        // Simula una solicitud autenticada
        $response = $this->actingAs($user)->get(route('usuarios.index'));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.usuarios.index');
        
        // Verifica que los usuarios se pasen a la vista
        $response->assertViewHas('usuarios');
    }

    public function test_create_view_is_accessible()
    {
        $user = User::factory()->create();
        
        // Simula una solicitud autenticada
        $response = $this->actingAs($user)->get(route('usuarios.create'));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.usuarios.create');
    }

    public function test_show_displays_user_info()
    {
        $user = User::factory()->create();
    
        // Simula la solicitud para ver los detalles de un usuario
        $response = $this->actingAs($user)->get(route('usuarios.show', $user->id));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.usuarios.show');
    
        // Verifica que el usuario específico se pase a la vista
        $response->assertViewHas('usuario', $user);
    }

    public function test_edit_view_is_accessible()
    {
        $user = User::factory()->create();
    
        // Simula la solicitud para cargar la vista de edición
        $response = $this->actingAs($user)->get(route('usuarios.edit', $user->id));
    
        // Asegura que la vista se cargue correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.usuarios.edit');
    
        // Verifica que el usuario específico se pase a la vista
        $response->assertViewHas('usuario', $user);
    }
}
