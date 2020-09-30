<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rayon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
        'quantite_stock',
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Categorie');
    }
}
