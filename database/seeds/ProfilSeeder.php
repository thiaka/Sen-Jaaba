<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
// use DB;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $profils = [
            [
                'nom' => 'Administrateur',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Responsable',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        DB::table('profils')->insert($profils);
    }
}
