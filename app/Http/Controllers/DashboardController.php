<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Produit;
use App\Models\Rayon;
use App\Models\Categorie;

class DashboardController extends Controller
{
    public function index()
    {
        $auth = auth()->user();
        $user = User::count();
        $produit = Produit::count();
        $rayon = Rayon::count();
        $categorie = Categorie::count();
        $produits = Produit::orderBy('created_at', 'DESC')->take(5)->get();
        $rayons = Rayon::all();
        return view('admin.dashboard', compact('user', 'auth', 'produit', 'categorie', 'produits', 'rayon', 'rayons'));
    }

    public function user()
    {
        $auth = auth()->user();
        $user = User::count();
        $produit = Produit::count();
        $rayon = Rayon::count();
        $categorie = Categorie::count();
        $produits = Produit::orderBy('created_at', 'DESC')->take(5)->get();
        $rayons = Rayon::all();
        return view('resp.dashboard', compact('user', 'auth', 'produit', 'categorie', 'produits', 'rayon', 'rayons'));
    }
}
