<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
// use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Adja M. Sy',
                'email' => 'dajkimi@gmail.com',
                'password' => bcrypt('123456'),
                'profil_id' => 1,
                'photo' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Awa Diop',
                'email' => 'ediop297@gmail.com',
                'password' => bcrypt('123456'),
                'profil_id' => 1,
                'photo' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Ibrahima Gueye',
                'email' => 'respon-gueye@gmail.com',
                'password' => bcrypt('123456'),
                'profil_id' => 2,
                'photo' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        DB::table('users')->insert($users);
    }
}
