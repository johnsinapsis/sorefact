<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'sinapsis',
            'email' => 'johnsinapsis@gmail.com',
            'role' => 'administrador',
            'password' => bcrypt('123456')
            ]);
        factory(App\User::class,10)->create();        
    }
}
