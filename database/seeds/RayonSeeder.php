<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RayonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rayons = [
            [
                'libelle' => 'Chambre Froide',
                'quantite_stock' => 1500,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'libelle' => 'Bien être',
                'quantite_stock' => 500,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'libelle' => 'Electronique',
                'quantite_stock' => 740,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'libelle' => 'Boucherie',
                'quantite_stock' => 500,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        $ray_cat = [
            [
                'categorie_id' => 2,
                'rayon_id' => 1,
            ],
            [
                'categorie_id' => 3,
                'rayon_id' => 1,
            ],
            [
                'categorie_id' => 4,
                'rayon_id' => 1,
            ],
            [
                'categorie_id' => 9,
                'rayon_id' => 1,
            ],
            [
                'categorie_id' => 8,
                'rayon_id' => 2,
            ],
            [
                'categorie_id' => 1,
                'rayon_id' => 3,
            ],
            [
                'categorie_id' => 6,
                'rayon_id' => 3,
            ],
            [
                'categorie_id' => 3,
                'rayon_id' => 4,
            ],
            [
                'categorie_id' => 9,
                'rayon_id' => 4,
            ],
        ];

        DB::table('rayons')->insert($rayons);
        DB::table('categorie_rayon')->insert($ray_cat);
    }
}
