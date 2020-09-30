<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('designation')->unique();
            $table->double('prix');
            $table->integer('quantite');
            $table->string('code_barre')->nullable();
            $table->integer('categorie_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('produit_rayons', function (Blueprint $table) {
            $table->integer('produit_id')->unsigned();
            $table->integer('rayon_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
        Schema::dropIfExists('produit_rayons');
    }
}
