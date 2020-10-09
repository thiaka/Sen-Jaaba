<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRayonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rayons', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('quantite_stock');
            $table->timestamps();
        });

        Schema::create('rayon_categorie', function (Blueprint $table) {
            $table->integer('rayon_id');
            $table->integer('categorie_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rayons');
        Schema::dropIfExists('rayon_categorie');
    }
}
