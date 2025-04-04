<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\User;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function se_puede_crear_un_rol()
    {
        // Crear un rol
        $role = Role::create(['nombre' => 'Administrador']);

        // Verificar que se guardó en la base de datos
        $this->assertDatabaseHas('roles', ['nombre' => 'Administrador']);
    }

    /** @test */
    public function un_rol_puede_tener_multiples_usuarios()
    {
        // Crear un rol
        $role = Role::create(['nombre' => 'Usuario']);

        // Crear usuarios asignados a este rol
        $user1 = User::factory()->create(['role_id' => $role->id]);
        $user2 = User::factory()->create(['role_id' => $role->id]);

        // Verificar que los usuarios están asociados al rol
        $this->assertCount(2, $role->usuarios);
    }
}
