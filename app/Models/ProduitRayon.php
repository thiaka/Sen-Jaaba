<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitRayon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "produit_rayons";

    protected $fillable = [
        'produit_id',
        'rayon_id',
    ];
}
