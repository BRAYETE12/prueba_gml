<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([ 
            ['nombre' => 'Cliente'], 
            ['nombre' => 'Proveedor'], 
            ['nombre' => 'Funcionario Interno']
         ]);
    }
}
