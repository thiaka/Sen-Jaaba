<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'designation',
        'prix',
        'quantite',
        'code_barre',
        'categorie_id',
        'photo',
    ];

    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie', 'categorie_id');
    }
}
