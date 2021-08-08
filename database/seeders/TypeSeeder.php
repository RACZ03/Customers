<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => 'Presentación Personal, Porte y Aspecto y Puesto de Trabajo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('types')->insert([
            'name' => 'Asistencia y Puntualidad',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
