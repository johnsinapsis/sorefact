<?php

use Illuminate\Database\Seeder;

class RoleFuncionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RoleFuncion::class)->create(['id_funcion' => '1','role' => 'superadmin']);
        factory(App\RoleFuncion::class)->create(['id_funcion' => '2','role' => 'superadmin']);
        factory(App\RoleFuncion::class)->create(['id_funcion' => '3','role' => 'superadmin']);
        factory(App\RoleFuncion::class)->create(['id_funcion' => '4','role' => 'superadmin']);
        factory(App\RoleFuncion::class)->create(['id_funcion' => '5','role' => 'superadmin']);
        factory(App\RoleFuncion::class)->create(['id_funcion' => '6','role' => 'superadmin']);
        factory(App\RoleFuncion::class)->create(['id_funcion' => '7','role' => 'superadmin']);
        factory(App\RoleFuncion::class)->create(['id_funcion' => '8','role' => 'superadmin']);
    }
}
