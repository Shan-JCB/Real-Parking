<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cliente;

class ClienteControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_authentication_pass_cliente(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_clientes_index_displays_properly()
    {
        $user = User::factory()->create();
        // Crear algunos clientes en la base de datos usando el factory
        Cliente::factory()->count(3)->create();
    
        // Hacer una solicitud GET al índice de clientes
        $response = $this->actingAs($user)->get(route('admin.clientes.index'));
    
        // Verificar que la vista devuelta sea la correcta y que se muestren los clientes
        $response->assertStatus(200);
        $response->assertViewIs('admin.clientes.index');
        $response->assertViewHas('clientes');
    }

    public function test_store_creates_a_new_cliente()
    {
        $user = User::factory()->create();
        // Datos válidos para el cliente
        $data = [
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'correo' => 'juan.perez@example.com',
            'celular' => '987654321',
            'direccion' => 'Av. Principal 123',
        ];
    
        // Hacer la solicitud POST para crear el cliente
        $response = $this->actingAs($user)->post(route('admin.clientes.store'), $data);
    
        // Verificar que la redirección sea correcta
        $response->assertRedirect(route('admin.clientes.create'));
    
        // Verificar que el cliente se haya registrado en la base de datos
        $this->assertDatabaseHas('clientes', [
            'correo' => 'juan.perez@example.com',
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $user = User::factory()->create();
        // Datos incompletos
        $data = [
            'nombres' => '',
            'apellidos' => '',
            'correo' => '',
            'celular' => '',
            'direccion' => '',
        ];
    
        // Hacer la solicitud POST
        $response = $this->actingAs($user)->post(route('admin.clientes.store'), $data);
    
        // Verificar que se devuelvan errores de validación
        $response->assertSessionHasErrors([
            'nombres', 'apellidos', 'correo', 'celular', 'direccion',
        ]);
    }
    
    public function test_update_modifies_an_existing_cliente()
    {
        $user = User::factory()->create();
        // Crear un cliente utilizando el factory
        $cliente = Cliente::factory()->create([
            'correo' => 'cliente.original@example.com',
        ]);
    
        // Datos actualizados
        $data = [
            'nombres' => 'Pedro',
            'apellidos' => 'González',
            'correo' => 'cliente.modificado@example.com',
            'celular' => '987654321',
            'direccion' => 'Nueva Dirección 456',
        ];
    
        // Hacer la solicitud PUT para actualizar el cliente
        $response = $this->actingAs($user)->put(route('admin.clientes.update', $cliente->id), $data);
    
        // Verificar que la redirección sea correcta
        $response->assertRedirect(route('admin.clientes.index'));
    
        // Verificar que los datos del cliente se hayan actualizado en la base de datos
        $this->assertDatabaseHas('clientes', [
            'correo' => 'cliente.modificado@example.com',
        ]);
    }
    
    public function test_destroy_deletes_a_cliente()
    {
        $user = User::factory()->create();

        // Crear un cliente usando el factory
        $cliente = Cliente::factory()->create();
    
        // Hacer la solicitud DELETE para eliminar el cliente
        $response = $this->actingAs($user)->delete(route('admin.clientes.destroy', $cliente->id));
    
        // Verificar que la redirección sea correcta
        $response->assertRedirect(route('admin.clientes.index'));
    
        // Verificar que el cliente se haya eliminado de la base de datos
        $this->assertDatabaseMissing('clientes', [
            'id' => $cliente->id,
        ]);
    }
    
    public function test_show_displays_a_single_cliente()
    {
        $user = User::factory()->create();
        // Crear un cliente usando el factory
        $cliente = Cliente::factory()->create();
    
        // Hacer la solicitud GET para ver los detalles del cliente
        $response = $this->actingAs($user)->get(route('admin.clientes.show', $cliente->id));
    
        // Verificar que la vista devuelta sea la correcta y contenga el cliente
        $response->assertStatus(200);
        $response->assertViewIs('admin.clientes.show');
        $response->assertViewHas('cliente', $cliente);
    }
    
    
}
