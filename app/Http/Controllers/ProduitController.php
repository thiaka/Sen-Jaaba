<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\ProduitRayon;
use App\Models\Categorie;
use App\Models\Rayon;
use DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();
        $produits = Produit::join('produit_rayons', 'produits.id', 'produit_rayons.produit_id')
            ->join('rayons', 'produit_rayons.rayon_id', 'rayons.id')
            ->select('produits.*', 'rayons.libelle as rayon_libelle')->paginate(10);
        $categories = Categorie::all();
        $rayons = Rayon::all();
        return view('admin.produit.index', compact('produits', 'categories', 'rayons', 'auth'));
    }

    public function indexResp()
    {
        $auth = auth()->user();
        $produits = Produit::join('produit_rayons', 'produits.id', 'produit_rayons.produit_id')
            ->join('rayons', 'produit_rayons.rayon_id', 'rayons.id')
            ->select('produits.*', 'rayons.libelle as rayon_libelle')->paginate(10);
        $categories = Categorie::all();
        $rayons = Rayon::all();
        return view('resp.produit.index', compact('produits', 'categories', 'rayons', 'auth'));
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $auth = auth()->user();
        $search_query = $request->search_query;
        $produits = Produit::where('designation', 'like', '%'.$search_query.'%')->paginate(5);
        $categories = Categorie::all();
        $rayons = Rayon::all();
        return view('admin.produit.result', compact('produits', 'categories', 'rayons', 'search_query', 'auth'));
    }

    public function c_search(Request $request)
    {
        $auth = auth()->user();
        $search_query = $request->search_query;
        $produits = Produit::where('designation', 'like', '%'.$search_query.'%')->paginate(5);
        $categories = Categorie::all();
        $rayons = Rayon::all();
        return view('resp.produit.result', compact('produits', 'categories', 'rayons', 'search_query', 'auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findRayon(Request $request)
    {
        $data = Rayon::join('categorie_rayon', 'rayons.id', 'categorie_rayon.rayon_id')
                        ->where('categorie_rayon.categorie_id',  $request->id)->get();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findRayon_r(Request $request)
    {
        $data = Rayon::join('categorie_rayon', 'rayons.id', 'categorie_rayon.rayon_id')
                        ->where('categories_rayon.categorie_id',  $request->id)->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'designation' => 'required',
            'prix' => 'required',
            'quantite' => 'required',
            'categorie_id' => 'required',
        ]);

        $produit = Produit::create([
            'designation' => $request->designation,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'code_barre' => sha1(time()),
            'categorie_id' => $request->categorie_id,
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/produits/', $image_new_name);
            $produit->photo = '/storage/produits/'.$image_new_name;
        }
        // $produit->rayons()->attach($request->rayons);

        ProduitRayon::create([
            'produit_id' => $produit->id,
            'rayon_id' => $request->rayon_id,
        ]);
        $produit->save();

        Session::flash('success', 'Un nouveau produit a été crée avec succès');
        return redirect()->route('produit.index');
    }

    public function storeResp(Request $request)
    {
        $this->validate($request, [
            'designation' => 'required',
            'prix' => 'required',
            'quantite' => 'required',
            // 'code_barre' => 'required',
            'categorie_id' => 'required',
            // 'rayon_id' => 'required',
        ]);

        $produit = Produit::create([
            'designation' => $request->designation,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'code_barre' => sha1(time()),
            'categorie_id' => $request->categorie_id,
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/produits/', $image_new_name);
            $produit->photo = '/storage/produits/'.$image_new_name;
        }

        ProduitRayon::create([
            'produit_id' => $produit->id,
            'rayon_id' => $request->rayon_id,
        ]);

        Session::flash('success', 'Un nouveau produit a été crée avec succès');
        return redirect()->route('prod');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        // dd($request->all());
        $this->validate($request, [
            'designation' => 'required|unique:produits,designation,'.$produit->id,
            'prix' => 'required',
            'quantite' => 'required',
            'categorie_id' => 'required',
        ]);

        $produit->designation = $request->designation;
        $produit->prix = $request->prix;
        $produit->quantite = $request->quantite;
        $produit->categorie_id = $request->categorie_id;

        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/produits/', $image_new_name);
            $produit->photo = '/storage/produits/'.$image_new_name;
        }

        $produit->save();

        Session::flash('success', 'Le produit a été modifié avec succès');
        return redirect()->route('produit.index');
    }

    public function updateResp(Request $request, Produit $produit)
    {
        // dd($request->all());
        $this->validate($request, [
            'designation' => 'required|unique:produits,designation,'.$produit->id,
            'prix' => 'required',
            'quantite' => 'required',
            'categorie_id' => 'required',
        ]);

        $produit->designation = $request->designation;
        $produit->prix = $request->prix;
        $produit->quantite = $request->quantite;
        $produit->categorie_id = $request->categorie_id;

        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/produits/', $image_new_name);
            $produit->photo = '/storage/produits/'.$image_new_name;
        }

        $produit->save();

        Session::flash('success', 'Le produit a été modifié avec succès');
        return redirect()->route('prod');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit = Produit::where('id',$id)->first();
        if ($produit != null) {
            $produit->delete();
            Session::flash('success', 'Le Produit a été supprimé avec succès');
            return redirect()->route('produit.index');
        }
    }

    public function destroyResp($id)
    {
        $produit = Produit::where('id',$id)->first();
        if ($produit != null) {
            $produit->delete();
            Session::flash('success', 'Le Produit a été supprimé avec succès');
            return redirect()->route('ray');
        }
    }
}
