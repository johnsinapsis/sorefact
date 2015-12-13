<?php

use Illuminate\Database\Seeder;

class MotivoAnuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MotivoAnu::class)->create(['nommotivo' => 'Error en digitación']);
        factory(App\MotivoAnu::class)->create(['nommotivo' => 'Error en las tarifas']);
        factory(App\MotivoAnu::class)->create(['nommotivo' => 'Error en la entidad']);
        factory(App\MotivoAnu::class)->create(['nommotivo' => 'Servicios Incorrectos']);
        factory(App\MotivoAnu::class)->create(['nommotivo' => 'Servicios Incompletos']);
    }
}
