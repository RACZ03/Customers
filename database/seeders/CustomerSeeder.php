<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'Juan Ernesto',
            'lastName' => 'Lopez Tellez',
            'dni' => '001-171085-0009G',
            'phoneNumber' => '505 8730 5240',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('customers')->insert([
            'name' => 'Karla Carolina',
            'lastName' => 'Estrada Aguirre',
            'dni' => '001-200590-0004K',
            'phoneNumber' => '505 8842 6987',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('customers')->insert([
            'name' => 'Mario Antonio',
            'lastName' => 'Morales Corea',
            'dni' => '481-171085-0005B',
            'phoneNumber' => '505 5757 5240',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('customers')->insert([
            'name' => 'Ana Sofia',
            'lastName' => 'Aleman Sanchez',
            'dni' => '401-200590-0002C',
            'phoneNumber' => '505 7856 5656',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('customers')->insert([
            'name' => 'Mariano Antonio',
            'lastName' => 'Ruiz Tapia',
            'dni' => '005-120368-0001X',
            'phoneNumber' => '505 8757 5200',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('customers')->insert([
            'name' => 'Marcos Jose',
            'lastName' => 'Suarez Sanchez',
            'dni' => '401-030593-0002Z',
            'phoneNumber' => '505 7899 3256',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
