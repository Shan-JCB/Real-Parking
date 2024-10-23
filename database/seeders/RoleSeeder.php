<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Para los roles y permisos
        $admin = Role::create(['name'=>'admin']);
        $operador = Role::create(['name'=>'operador']);
        $usuario = Role::create(['name'=>'usuario']);

        //Rutas Admin: Usuario
        Permission::create(['name' => 'tasks.index']);
        
        Permission::create(['name' => 'usuarios.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.destroy'])->syncRoles([$admin]);

        //Rutas Admin: Operadores
        Permission::create(['name' => 'admin.operadores.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.operadores.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.operadores.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.operadores.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.operadores.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.operadores.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.operadores.destroy'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.clientes.index'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.clientes.create'])->syncRoles([$admin, $operador ]);
        Permission::create(['name' => 'admin.clientes.store'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.clientes.show'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.clientes.edit'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.clientes.updateBasica'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.clientes.updateRelevante'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.clientes.confirmDelete'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.clientes.destroy'])->syncRoles([$admin, $operador]);


        Permission::create(['name' => 'admin.parqueos.index'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.parqueos.create'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.parqueos.store'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.parqueos.edit'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.parqueos.update'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'buscar.cliente'])->syncRoles([$admin, $operador]);


        Permission::create(['name' => 'admin.eventos.create'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'eventos.destroy'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'eventos.print'])->syncRoles([$admin, $operador]);

        Permission::create(['name' => 'admin.pagos.index'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.pagos.create'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.pagos.store'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.pagos.show'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.pagos.edit'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.pagos.update'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.pagos.destroy'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'admin.pagos.imprimirFactura'])->syncRoles([$admin, $operador]);
        Permission::create(['name' => 'pagos.procesar'])->syncRoles([$admin, $operador]);


        Permission::create(['name' => 'admin.tarifas.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.tarifas.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.tarifas.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.tarifas.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.tarifas.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.tarifas.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.tarifas.destroy'])->syncRoles([$admin]);
    }
}
