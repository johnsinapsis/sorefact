<?php

use Illuminate\Database\Seeder;

class FuncionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Funcion::class)->create(['nomfuncion' => 'Registrar Resolución']);
        factory(App\Funcion::class)->create(['nomfuncion' => 'Liquidar Factura']);
        factory(App\Funcion::class)->create(['nomfuncion' => 'Anular Facturas']);
        factory(App\Funcion::class)->create(['nomfuncion' => 'Consulta de Facturas']);
        factory(App\Funcion::class)->create(['nomfuncion' => 'Radicar Facturas']);
        factory(App\Funcion::class)->create(['nomfuncion' => 'Registrar Pagos']);
        factory(App\Funcion::class)->create(['nomfuncion' => 'Gestión de cartera']);
    }
}
