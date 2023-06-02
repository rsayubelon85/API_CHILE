<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*User::insert([
            [
                'name' => 'Reynier Sayu',
                'email' => 'rsayu@nauta.cu',
                'password' => Hash::make('password')    
            ],
        ]);*/

        $rol1 = Role::create(['name' => 'Administrador']);
        $rol2 = Role::create(['name' => 'Diseñador']);
        $rol3 = Role::create(['name' => 'Invitado']);
        
        $user1 = User::create(['name' => 'Reynier Sayú Belón','email' => 'rsayu@nauta.cu','password' => '$2y$10$aT0b78sRjzR0nlqfW6OXw.AV6c25Aj40MO2sBAjCHKftlCDYgPu82'])->assignRole($rol1);
        $user2 = User::create(['name' => 'Andres Sayú Belón','email' => 'asayu@nauta.cu','password' => '$2y$10$aT0b78sRjzR0nlqfW6OXw.AV6c25Aj40MO2sBAjCHKftlCDYgPu82'])->assignRole($rol2);
        $user3 = User::create(['name' => 'Imara García Hernández','email' => 'imagimg@nauta.cu','password' => '$2y$10$aT0b78sRjzR0nlqfW6OXw.AV6c25Aj40MO2sBAjCHKftlCDYgPu82'])->assignRole($rol3);

        Permission::create(['name' => 'rol.admin','real_name' => 'Permiso de Administración'])->syncRoles($rol1);
        Permission::create(['name' => 'article.index','real_name' => 'Listar Articulos'])->syncRoles([$rol1,$rol2,$rol3]);
        Permission::create(['name' => 'article.save','real_name' => 'Salvar Articulos'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.edit','real_name' => 'Editar Articulos'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.update','real_name' => 'Actualizar Articulos'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.delete','real_name' => 'Eliminar Articulos'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.bycategoria','real_name' => 'Listar Articulos por Categoria'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.imgbyarticle','real_name' => 'Listar Imagenes por Articulos'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.findarticles','real_name' => 'Buscar Articulos'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.findcantarticles','real_name' => 'Buscar Cantidad de Articulos'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.notstock','real_name' => 'Articulos sin Stock'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name' => 'article.sellarticle','real_name' => 'Comprar articulo'])->syncRoles([$rol1,$rol2,$rol3]);
        Permission::create(['name' => 'article.totalprofit','real_name' => 'Total de Ganancia'])->syncRoles([$rol1,$rol2,$rol3]);
        Permission::create(['name' => 'article.articlevendido','real_name' => 'Listar Articulos Vendidos'])->syncRoles([$rol1,$rol2,$rol3]);

    }
}
