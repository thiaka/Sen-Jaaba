<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            [
                'nom' => 'Articles Ménagers',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Charcuterie',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Volaille',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Produits laitiers',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Fruits et légumes',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Bricolage & Outillage',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Boulangerie',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Parapharmacie & Cosmétique',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Poissonnerie',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Conserves',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Comptoir des fromages',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        $cat_ray = [
            [
                'rayon_id' => 1,
                'categorie_id' => 2,
            ],
            [
                'rayon_id' => 1,
                'categorie_id' => 3,
            ],
            [
                'rayon_id' => 1,
                'categorie_id' => 4,
            ],
            [
                'rayon_id' => 1,
                'categorie_id' => 9,
            ],
            [
                'rayon_id' => 2,
                'categorie_id' => 8,
            ],
            [
                'rayon_id' => 3,
                'categorie_id' => 1,
            ],
            [
                'rayon_id' => 3,
                'categorie_id' => 6,
            ],
            [
                'rayon_id' => 4,
                'categorie_id' => 3,
            ],
            [
                'rayon_id' => 4,
                'categorie_id' => 9,
            ],
        ];

        DB::table('categories')->insert($categories);
        DB::table('rayon_categorie')->insert($cat_ray);
    }
}
