<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indicators')->insert([
            'idType' => 1,
            'description' => 'Pantalón limpio y planchado',
            'score' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 1,
            'description' => 'Uñas (limpias, bien cuidadas y no tan largas',
            'score' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 1,
            'description' => 'Cabello (Peinado)',
            'score' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 1,
            'description' => 'Cubre Boca',
            'score' => 2,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 1,
            'description' => 'Gorro',
            'score' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 1,
            'description' => 'Piso Limpio',
            'score' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 1,
            'description' => 'Mesa de Trabajo Ordenada',
            'score' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 1,
            'description' => 'Uso de Telefono unicamente en el lugar de descanso',
            'score' => 5,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('indicators')->insert([
            'idType' => 2,
            'description' => 'Ausencias Injustificadas',
            'score' => 4,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 2,
            'description' => 'Llegadas tardes',
            'score' => 4,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'idType' => 2,
            'description' => 'Permisos Extraordinarios',
            'score' => 4,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
