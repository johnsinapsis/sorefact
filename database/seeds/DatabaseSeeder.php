<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(UserTableSeeder::class);
         $this->call(ResolucionSeeder::class);
         $this->call(MotivoAnuSeeder::class);
         $this->call(FuncionesSeeder::class);
         $this->call(RoleFuncionSeeder::class);

        Model::reguard();
    }
}
