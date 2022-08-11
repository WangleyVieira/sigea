<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PerfilsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PeriodoTableSeeder::class);
        $this->call(DisciplinaTableSeeder::class);
        $this->call(CurricularEletivaTableSeeder::class);
    }
}
